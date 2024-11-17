<x-app-layout>
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <h1 class="py-6 text-3xl font-bold">Edit Product</h1>
        @include('products.form', [
            'product' => $product,
            'categories' => $categories,
            'brands' => $brands,
        ])
    </div>
</x-app-layout>
