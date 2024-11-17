<form action="{{ isset($product) ? route('products.update', $product) : route('products.store') }}" method="POST"
    enctype="multipart/form-data">
    @csrf
    @if (isset($product))
        @method('PUT')
    @endif
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
        <div class="mb-4">
            <label for="name" class="block mb-2 text-sm font-medium text-gray-600">Name</label>
            <input type="text" name="name" id="name"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-100 focus:border-blue-500"
                value="{{ old('name', $product->name ?? '') }}">
            @error('name')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="description" class="block mb-2 text-sm font-medium text-gray-600">Description</label>
            <textarea name="description" id="description"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-100 focus:border-blue-500">{{ old('description', $product->description ?? '') }}</textarea>
            @error('description')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="price" class="block mb-2 text-sm font-medium text-gray-600">Price</label>
            <input type="text" name="price" id="price"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-100 focus:border-blue-500"
                value="{{ old('price', $product->price ?? '') }}" pattern="^\d+(\.\d{1,2})?$"
                title="Please enter a valid price (e.g., 19.99)">
            @error('price')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="stock" class="block mb-2 text-sm font-medium text-gray-600">Stock</label>
            <input type="number" name="stock" id="stock"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-100 focus:border-blue-500"
                value="{{ old('stock', $product->stock ?? '') }}">
            @error('stock')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="image" class="block mb-2 text-sm font-medium text-gray-600">Image</label>
            @isset($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" class="object-cover w-full h-48"
                    alt="{{ $product->name }}">
            @endisset
            <input type="file" name="image" id="image"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-100 focus:border-blue-500">
            @error('image')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="category_id" class="block mb-2 text-sm font-medium text-gray-600">Category</label>
            <select name="category_id" id="category_id"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-100 focus:border-blue-500">
                <option value="">Select a category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ old('category_id', $product->category_id ?? '') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="brand_id" class="block mb-2 text-sm font-medium text-gray-600">Brand</label>
            <select name="brand_id" id="brand_id"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-100 focus:border-blue-500">
                <option value="">Select a brand</option>
                @foreach ($brands as $brand)
                    <option value="{{ $brand->id }}"
                        {{ old('brand_id', $product->brand_id ?? '') == $brand->id ? 'selected' : '' }}>
                        {{ $brand->name }}
                    </option>
                @endforeach
            </select>
            @error('brand_id')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="active" class="block mb-2 text-sm font-medium text-gray-600">Active</label>
            <input type="hidden" name="active" value="0">
            <input type="checkbox" name="active" id="active" value="1"
                class="w-4 h-4 text-blue-500 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-100 focus:border-blue-500"
                {{ old('active', $product->active ?? false) ? 'checked' : '' }}>
            @error('active')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>
    </div>
    <div class="mt-6">
        <button type="submit" class="px-4 py-2 text-white transition-colors bg-blue-600 rounded-lg hover:bg-blue-700">
            {{ isset($product) ? 'Update Product' : 'Create Product' }}
        </button>
    </div>
</form>
