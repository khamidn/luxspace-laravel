<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductGalleryRequest;
use Yajra\DataTables\Facades\DataTables;
use App\Models\{ Product, ProductGallery };
use Illuminate\Support\Facades\Storage;

class ProductGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
        if (request()->ajax()) {
            $query = ProductGallery::query();

            return DataTables::of($query)
                            ->editColumn('url', function($item){
                                return '<img src="'. Storage::url($item->url).'" style="max-width: 150px; "/>';
                            })
                            ->editColumn('is_featured', function($item){
                                return $item->is_featured ? 'Yes' : 'No';
                            })
                            ->addColumn('action', function($item){
                                return '
                                    <form class="inline-block" action="'.route('dashboard.gallery.destroy', $item->id).'" method="POST">
                                    <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded shadow-lg m-2">
                                        Hapus
                                    </button>
                                    '.method_field('delete'). csrf_field() .'

                                    </form>
                                ';
                            })
                            ->rawColumns(['action', 'url'])
                            ->make();
        }

        return view('pages.dashboard.gallery.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Product $product)
    {
        return view('pages.dashboard.gallery.create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductGalleryRequest $request, Product $product)
    {
        $files = $request->file('files');

        if ($request->hasFile('files')) {
            foreach ($files as $file) {
                $path = $file->store('public/gallery');

                ProductGallery::create([
                        'products_id' => $product->id,
                        'url' => $path
                    ]);
            }
        }

        return redirect()->route('dashboard.product.gallery.index', $product->id);
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductGallery $gallery)
    {
        $gallery->delete();

        return redirect()->route('dashboard.product.gallery.index', $gallery->products_id);
    }
}
