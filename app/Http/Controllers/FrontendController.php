<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Models\Cart;
use App\Models\Custom;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Showcase;
use App\Models\ShowcaseCategory;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\ActivityLogger;

class FrontendController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::with(['galleries'])->latest()->get();
        $categories = ProductCategory::with(['product'])->get();

        //event log code
        $request->subject = 'A';
        $request->description = 'home';

        /*activity($request->subject)
            ->causedBy($request->user)
            ->log($request->description);*/

        insertActivity($request);

        return view('pages.frontend.index', compact('products', 'categories'));
    }

    public function details(Request $request, $slug)
    {
        $product = Product::with(['galleries'])->where('slug', $slug)->firstOrFail();
        $recommendations = Product::with(['galleries'])->inRandomOrder()->limit(4)->get();

        //event log
        $request->subject = 'C';
        $request->description = 'melihat barang';

        /*activity($request->subject)
            ->causedBy($request->user)
            ->log($request->description);*/
        insertActivity($request);

        return view('pages.frontend.details', compact('product', 'recommendations'));
    }

    public function cartAdd(Request $request, $id)
    {
        Cart::create([
            "users_id" => Auth::user()->id,
            "products_id" => $id
        ]);

        //event log
        $request->subject = 'D';
        $request->description = 'memasukan barang ke keranjang';

        /*activity($request->subject)
            ->causedBy($request->user)
            ->log($request->description);*/
        insertActivity($request);

        return redirect('cart');
    }

    public function cartDelete(Request $request, $id)
    {
        $item = Cart::findOrFail($id);

        $item->delete();

        //event log
        $request->subject = 'F';
        $request->description = 'menghapus barang dalam keranjang';

        /*activity($request->subject)
            ->causedBy($request->user)
            ->log($request->description);*/
        insertActivity($request);

        return redirect('cart');
    }

    public function cart(Request $request)
    {
        $carts = Cart::with(['product.galleries'])->where('users_id', Auth::user()->id)->get();

        //event log
        $request->subject = 'E';
        $request->description = 'melihat keranjang';

        /*activity($request->subject)
            ->causedBy($request->user)
            ->log($request->description);*/
        insertActivity($request);

        return view('pages.frontend.cart', compact('carts'));
    }

    public function checkout(CheckoutRequest $request)
    {
        $data = $request->all();

        // Get carts data
        $carts = Cart::with(['product'])->where('users_id', Auth::user()->id)->get();

        // Add to transaction data
        $data['users_id'] = Auth::user()->id;
        $data['total_price'] = $carts->sum('product.price');

        // Create transaction
        $transaction = Transaction::create($data);

        // Create transaction item
        foreach ($carts as $cart) {
            $items[] = TransactionItem::create([
                'transactions_id' => $transaction->id,
                'users_id' => $cart->users_id,
                'products_id' => $cart->products_id
            ]);
        }

        // Delete cart after transaction
        Cart::where('users_id', Auth::user()->id)->delete();

        // Midtrans Configuration
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        // Setup Midtrans variable
        $midtrans = [
            'transaction_details' => [
                'order_id' => 'NIQ-' . $transaction->id,
                'gross_amount' => (int) $transaction->total_price,
            ],
            'customer_details' => [
                'first_name' => $transaction->name,
                'email' => $transaction->email,
            ],
            'enabled_payments' => ['gopay', 'bank_transfer'],
            'vtweb' => [],
        ];

        // Payment process
        try {
            // Get snap payment page URL
            $paymentUrl = Snap::createTransaction($midtrans)->redirect_url;

            $transaction->payment_url = $paymentUrl;
            $transaction->save();

            // Redirect to Snap Payment Page
            return redirect($paymentUrl);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function success(Request $request)
    {
        //event log
        $request->subject = 'G';
        $request->description = 'checkout sukses';

        /*activity($request->subject)
            ->causedBy($request->user)
            ->log($request->description);*/
        insertActivity($request);

        return view('pages.frontend.success');
    }

    public function pending(Request $request)
    {
        //event log
        $request->subject = 'H';
        $request->description = 'checkout pending';

        /*activity($request->subject)
            ->causedBy($request->user)
            ->log($request->description);*/
        insertActivity($request);

        return view('pages.frontend.pending');
    }

    public function failed(Request $request)
    {
        //event log
        $request->subject = 'I';
        $request->description = 'checkout gagal';

        /*activity($request->subject)
            ->causedBy($request->user)
            ->log($request->description);*/
        insertActivity($request);

        return view('pages.frontend.failed');
    }

    public function catalog(Request $request)
    {
        $categories = ProductCategory::all();
        $title = "All Catalog";
        if ($request->category) {
            $category = ProductCategory::find($request->category);
            $title = $category->name;
            $products = Product::with(['galleries'])->where('categories_id', $request->category)
                ->latest()->paginate(10);
        } else {
            $products = Product::with(['galleries'])->latest()->paginate(10);
        }

        //event log
        $request->subject = 'B';
        $request->description = 'catalog';

        /*activity($request->subject)
            ->causedBy($request->user)
            ->log($request->description);*/
        insertActivity($request);

        return view('pages.frontend.catalog', compact('categories', 'products', 'title'));
    }

    public function showcase(Request $request)
    {
        $categories = ShowcaseCategory::all();
        $showcases = Showcase::all();

        //event log
        $request->subject = 'L';
        $request->description = 'melihat showcase';

        /*activity($request->subject)
            ->causedBy($request->user)
            ->log($request->description);*/
        insertActivity($request);

        return view('pages.frontend.showcase', compact('categories', 'showcases'));
    }

    public function custom(Request $request)
    {
        return view('pages.frontend.custom');
    }

    public function customStore(Request $request)
    {
        $data = $request->all();
        $file = $request->file('file');

        if ($request->hasFile('file')) {
            $path = $file->store('public/gallery');

            $data['reference_photo'] = $path;

            Custom::create($data);
        }

        //event log
        $request->subject = 'M';
        $request->description = 'memesan custom';

        /*activity($request->subject)
            ->causedBy($request->user)
            ->log($request->description);*/
        insertActivity($request);

        return redirect()->route('custom')->with('success', "success");
    }
}
