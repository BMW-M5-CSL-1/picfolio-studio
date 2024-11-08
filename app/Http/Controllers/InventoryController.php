<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index()
    {
        $data = [
            'products' => Product::where('stock', '>', 0)->with('media')->get()
        ];
        return view('app.gallery.index', $data);
    }

    public function details(Request $request)
    {
        try {
            $product = Product::find($request->id);

            if ($product) {
                $images = $product->getMedia('imgs')->map(function ($image) {
                    return $image->getUrl();
                });

                $data = [
                    'id' => $product->id,
                    'description' => $product->description,
                    'price' => $product->price,
                    'stock' => $product->stock,
                    'images' => $images,
                ];

                $view = view('app.gallery.product-view', $data)->render();

                return response()->json([
                    'success' => true,
                    'view' => $view,
                ]);
            } else {
                return response()->json(['success' => false, 'message' => 'Product not found']);
            }
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
