<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Services\ProductService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreProductRequest;

class ProductController extends Controller
{
    public function __construct(protected ProductService $productService) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Gate::allows('viewAny', Product::class)
            ? Product::all()
            : Product::active()->get();

        return view('products.index', [
            'products' => $products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', Product::class);

        $categories = Category::all();
        $brands = Brand::all();

        return view('products.create', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $this->productService->saveProduct($request);

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        if (Gate::denies('view', $product)) {
            abort(404);
        }

        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        Gate::authorize('update', $product);

        $categories = Category::all();
        $brands = Brand::all();

        return view('products.edit', compact('product', 'categories', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreProductRequest $request, Product $product)
    {
        $this->productService->saveProduct($request, $product);

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        Gate::authorize('delete', $product);

        $product->delete();

        return redirect()->route('products.index');
    }
}
