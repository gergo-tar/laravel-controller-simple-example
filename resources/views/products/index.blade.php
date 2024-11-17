<x-app-layout>
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <h1 class="py-6 text-3xl font-bold">Our Products</h1>
        @can('create', App\Models\Product::class)
            <div class="mx-auto mt-6 mb-4 max-w-7xl">
                <a href="{{ route('products.create') }}"
                    class="inline-block px-4 py-2 text-white transition-colors bg-green-600 rounded-lg hover:bg-green-700">
                    Add New Product
                </a>
            </div>
        @endcan
        <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
            @forelse ($products as $product)
                <div class="mb-4">
                    <div class="overflow-hidden bg-white rounded-lg shadow-md">
                        @if ($product->image)
                            <img src="{{ $product->image_link }}" class="object-cover w-full h-48"
                                alt="{{ $product->name }}">
                        @endif
                        <div class="p-4">
                            <h5 class="mb-2 text-xl font-semibold">
                                {{ $product->name }}
                                @if (!$product->active)
                                    <span class="ml-2 text-sm text-red-500">(Inactive)</span>
                                @endif
                            </h5>
                            <p class="mb-3 text-gray-600">
                                {{ Str::limit($product->description, 100) }}
                            </p>
                            <p class="mb-4 text-lg font-bold text-gray-900">
                                ${{ number_format($product->price, 2) }}
                            </p>
                            <a href="{{ route('products.show', $product) }}"
                                class="inline-block px-4 py-2 text-white transition-colors bg-blue-600 rounded-lg hover:bg-blue-700">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-3">
                    <p class="text-center text-gray-500">No products available at the moment.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
