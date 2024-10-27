<?php

namespace App\Http\Controllers;

use App\DataTables\ProductDataTable;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProductDataTable $table)
    {
        return $table->render('app.product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [];
        return view('app.product.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        try {
            $request->validate([
                'product_repeater.*.name' => 'required|string|max:255',
                'product_repeater.*.price' => 'required|numeric|min:0',
                'product_repeater.*.stock' => 'required|integer|min:0',
                'product_repeater.*.description' => 'nullable|string',
            ]);

            DB::transaction(function () use ($request) {
                $product = Product::create([
                    'name' => $request->name ?? '',
                    'price' => $request->price ?? '',
                    'stock' => $request->stock ?? '',
                    'description' => $request->description ?? '',
                ]);

                if (isset($request->attachments) && count($request->attachments) > 0) {
                    foreach ($request->attachments as $key => $media) {
                        $product->addMedia($media)->toMediaCollection('imgs');
                    }
                }

                // Loop through each product in product_repeater array
                // foreach ($request->product_repeater as $productData) {
                //     // Create a new product record for each entry
                //     $product = Product::create([
                //         'name' => $productData['name'],
                //         'price' => $productData['price'],
                //         'stock' => $productData['stock'],
                //         'description' => $productData['description'],
                //     ]);

                //     if (isset($productData['attachment']) && count($productData['attachment']) > 0) {
                //         foreach ($productData['attachment'] as $key => $media) {
                //             $product->addMedia($media)->toMediaCollection('attachments');
                //         }
                //     }
                // }
            });

            return redirect()->route('product.index')->with('success', 'Products Saved Successfully !');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage() ?? 'An Error Occured !');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
