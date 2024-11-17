<?php

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;

uses(RefreshDatabase::class);

// Helper to create an admin user
function createAdminUser()
{
    return User::factory()->create(['role' => 'admin']); // Assuming 'role' is the attribute for user roles
}

// Helper to create a non-admin user
function createRegularUser()
{
    return User::factory()->create(['role' => 'user']); // Non-admin role
}

// Test the create method
it('allows admin users to view the product creation form', function () {
    $admin = createAdminUser();

    $categories = Category::factory()->count(3)->create();
    $brands = Brand::factory()->count(2)->create();

    $this->actingAs($admin)
        ->get(route('products.create'))
        ->assertOk()
        ->assertViewIs('products.create')
        ->assertViewHasAll(compact('categories', 'brands'));
});

it('forbids non-admin users from accessing the creation form', function () {
    $user = createRegularUser();

    $this->actingAs($user)
        ->get(route('products.create'))
        ->assertForbidden();
});

// Test the store method
it('allows admin users to store a new product', function () {
    $admin = createAdminUser();

    $this->actingAs($admin)
        ->post(route('products.store'), [
            'name' => 'New Product',
            'description' => 'Product description',
            'price' => 100,
            'stock' => 10,
            'image' => UploadedFile::fake()->image('product.jpg'),
            'category_id' => Category::factory()->create()->id,
            'brand_id' => Brand::factory()->create()->id,
        ])
        ->assertRedirect(route('products.index'));
});

it('forbids non-admin users from storing a new product', function () {
    $user = createRegularUser();

    $this->actingAs($user)
        ->post(route('products.store'), [
            'name' => 'New Product',
            'description' => 'Product description',
            'price' => 100,
            'stock' => 10,
            'image' => UploadedFile::fake()->image('product.jpg'),
            'category_id' => Category::factory()->create()->id,
            'brand_id' => Brand::factory()->create()->id,
        ])
        ->assertForbidden();
});

// Test the edit method
it('allows admin users to edit a product', function () {
    $admin = createAdminUser();
    $product = Product::factory()->create();
    $categories = Category::factory()->count(3)->create();
    $brands = Brand::factory()->count(2)->create();

    $this->actingAs($admin)
        ->get(route('products.edit', $product))
        ->assertOk()
        ->assertViewIs('products.edit')
        ->assertViewHas(['product', 'categories', 'brands']);
});

it('forbids non-admin users from editing a product', function () {
    $user = createRegularUser();
    $product = Product::factory()->create();

    $this->actingAs($user)
        ->get(route('products.edit', $product))
        ->assertForbidden();
});

// Test the update method
it('allows admin users to update a product', function () {
    $admin = createAdminUser();
    $product = Product::factory()->create();

    $this->actingAs($admin)
        ->put(route('products.update', $product), [
            'name' => 'Updated Product',
            'description' => 'Updated product description',
            'price' => 150,
            'stock' => 10,
            'category_id' => $product->category_id,
            'brand_id' => $product->brand_id,
        ])
        ->assertRedirect(route('products.index'));
});

it('forbids non-admin users from updating a product', function () {
    $user = createRegularUser();
    $product = Product::factory()->create();

    $this->actingAs($user)
        ->put(route('products.update', $product), [
            'name' => 'Updated Product',
            'description' => 'Updated product description',
            'price' => 150,
            'stock' => 10,
            'category_id' => $product->category_id,
            'brand_id' => $product->brand_id,
        ])
        ->assertForbidden();
});

// Test the destroy method
it('allows admin users to delete a product', function () {
    $admin = createAdminUser();
    $product = Product::factory()->create();

    $this->actingAs($admin)
        ->delete(route('products.destroy', $product))
        ->assertRedirect(route('products.index'));

    $this->assertDatabaseMissing('products', ['id' => $product->id]);
});

it('forbids non-admin users from deleting a product', function () {
    $user = createRegularUser();
    $product = Product::factory()->create();

    $this->actingAs($user)
        ->delete(route('products.destroy', $product))
        ->assertForbidden();

    $this->assertDatabaseHas('products', ['id' => $product->id]);
});
