<?php

namespace App\Http\Controllers\API;

use Midtrans\Config;
use Midtrans\Notification;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class MidtransController extends Controller
{
    public function callback()
    {
        // Midtrans configuration setting
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        // make Midtrans notification instance
        $notification = new Notification();

        // Assign to variable for make coding easier
        $status = $notification->transaction_status;
        $type = $notification->payment_type;
        $fraud = $notification->fraud_status;
        $order_id = $notification->order_id;

        // Get transaction id
        $order = explode('-', $order_id);

        // Find transaction based on id
        $transaction = Transaction::findOrFail($order[1]);

        // Midtrans notification handler status
        if($status == 'capture'){
            if($type == 'cerdit_card') {
                if($fraud == 'challenge') {
                    $transaction->status = 'PENDING';
                }
                else {
                    $transaction->status = 'SUCCESS';
                }
            }
        }

        else if($status == 'settlement')
        {
            $transaction->status = 'SUCCESS';
        }

        else if($status == 'pending')
        {
            $transaction->status = 'PENDING';
        }

        else if($status == 'deny')
        {
            $transaction->status = 'PENDING';
        }

        else if($status == 'expire')
        {
            $transaction->status = 'CANCELLED';
        }

        else if($status == 'cancel')
        {
            $transaction->status = 'CANCELLED';
        }

        // saving transaction
        $transaction->save();

        // returning response for midtrans
        return response()->json([
            'meta' => [
                'code' => 200,
                'message' => 'Midtrans Notification Success!'
            ]
        ]);
    }
}
