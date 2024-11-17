<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductService
{
    public function saveProduct(Request $request, ?Product $product = null)
    {
        if (is_null($product)) {
            $product = new Product;
        }

        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        if ($request->hasFile('image')) {
            $product->image = $request->file('image')->store('products', 'public');
        }
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->active = $request->has('active');
        $product->save();

        return $product;
    }
}
