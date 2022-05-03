<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShowcaseRequest;
use App\Models\ProductCategory;
use App\Models\Showcase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ShowcaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Showcase::query();

            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                        <a class="inline-block border border-red-300 bg-purple-700 text-white rounded-md px-2 py-1 m-1 transition duration-500 ease select-none hover:bg-gray-800 focus:outline-none focus:shadow-outline"
                        href="' . route('dashboard.showcase.edit', $item->id) . '" >
                            Edit
                        </a>
                        <form class="inline-block" action="' . route('dashboard.showcase.destroy', $item->id) . '" method="POST">
                            <button class="border border-red-500 bg-red-500 text-white rounded-md px-2 py-1 m-2 transition duration-500 ease select-none hover:bg-red-600 focus:outline-none focus:shadow-outline">
                                Delete
                            </button>
                        ' . method_field('delete') . csrf_field() . '
                        </form>
                    ';
                })
                ->editColumn('url', function ($item) {
                    return '<img style="max-width: 150px" src="' . Storage::url($item->url) . '"/>';
                })
                ->editColumn('categories_id', function ($item) {
                    return $item->categories->name;
                })
                ->rawColumns(['action', 'url', 'categories_id'])
                ->make();
        }
        return view('pages.dashboard.showcase.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = ProductCategory::all();

        return view('pages.dashboard.showcase.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShowcaseRequest $request)
    {
        $data = $request->all();
        $file = $request->file('file');

        if ($request->hasFile('file')) {
            $path = $file->store('public/gallery');

            $data['url'] = $path;

            Showcase::create($data);
        }

        return redirect()->route('dashboard.showcase.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Showcase::findOrFail($id);
        $categories = ProductCategory::all();

        return view('pages.dashboard.showcase.edit', compact('item', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ShowcaseRequest $request, Showcase $showcase)
    {
        $data = $request->all();
        $file = $request->file('file');

        if ($request->hasFile('file')) {
            $path = $file->store('public/gallery');

            $data['url'] = $path;

            $showcase->update($data);
        }

        return redirect()->route('dashboard.showcase.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Showcase $showcase)
    {
        $showcase->delete();

        return redirect()->route('dashboard.showcase.index');
    }
}
