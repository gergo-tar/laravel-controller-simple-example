<x-app-layout>
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex items-center justify-between py-6">
            <h1 class="text-3xl font-bold">Product Details</h1>
            <a href="{{ route('products.index') }}"
                class="inline-block px-4 py-2 text-white transition-colors bg-blue-600 rounded-lg hover:bg-blue-700">
                Back to Products
            </a>
        </div>
        <div class="mb-4">
            <div class="overflow-hidden bg-white rounded-lg shadow-md">
                @isset($product->image)
                    <img src="{{ $product->image_link }}" class="object-cover w-full h-96" alt="{{ $product->name }}">
                @else
                    <div class="flex items-center justify-center w-full h-48 bg-gray-200">
                        <span class="text-gray-500">No image available</span>
                    </div>
                @endisset
                <div class="p-4">
                    <h5 class="mb-2 text-xl font-semibold">
                        {{ $product->name }}
                    </h5>
                    <p class="mb-3 text-gray-600">
                        {!! nl2br(e($product->description)) !!}
                    </p>
                    <p class="mb-4 text-lg font-bold text-gray-900">
                        ${{ number_format($product->price, 2) }}
                    </p>
                    <p class="mb-4 text-gray-600">
                        Stock: {{ $product->stock }}
                    </p>
                    <p class="mb-4 text-gray-600">
                        Category: {{ $product->category->name ?? 'Uncategorized' }}
                    </p>
                    <p class="mb-4 text-gray-600">
                        Brand: {{ $product->brand->name ?? 'Uncategorized' }}
                    </p>
                </div>
            </div>
        </div>
        @can('update', $product)
            <div class="flex justify-end mt-6">
                <a href="{{ route('products.edit', $product) }}"
                    class="inline-block px-4 py-2 text-white transition-colors bg-green-600 rounded-lg hover:bg-green-700">
                    Edit Product
                </a>
            </div>
        @endcan
        @can('delete', $product)
            <form action="{{ route('products.destroy', $product) }}" method="POST"
                onsubmit="return confirm('Are you sure you want to delete this product?');">
                @csrf
                @method('DELETE')
                <div class="flex justify-end mt-6">
                    <button type="submit"
                        class="inline-block px-4 py-2 text-white transition-colors bg-red-600 rounded-lg hover:bg-red-700">
                        Delete Product
                    </button>
                </div>
            </form>
        @endcan
    </div>
</x-app-layout>
