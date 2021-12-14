<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return ProductResource::collection(
            Product::latest()->get()
        );
    }

    public function show(Product $product)
    {
        return ProductResource::make($product);
    }

    public function search($name)
    {
        $products = Product::query()
            ->where('name', 'LIKE', "%{$name}%")
            ->get();

        return ProductResource::collection($products);
    }

    public function store(Request $request)
    {
        $request->validate([
          'name' => 'required',
          'slug' => 'required|unique:products',
          'price' => 'required|integer'
        ]);
       $product = Product::create($request->all());

       return ProductResource::make($product);
    }

    public function update(Request $request, Product $product)
    {
        $product->update(request()->all());

        return ProductResource::make($product);
    }

    public function delete(Product $product)
    {
        $product->delete();

        return response()->json(['message' => "$product->name successfully deleted."]);
    }
}
