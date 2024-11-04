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
}
