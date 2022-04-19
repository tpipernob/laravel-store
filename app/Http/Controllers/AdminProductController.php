<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.products', compact('products'));
    }

    // Mostrar a página editar
    public function edit(Product $product)
    {
        return view('admin.product_edit', [
            'product' => $product
        ]);
    }

    // Recebe requisição para dar update PUT
    public function update(Product $product, ProductStoreRequest $request)
    {
        $input = $request->validated();
        $input['slug'] = Str::slug($input['name']);

        if(!empty($input['cover']) and $input['cover']->isValid()){
            $file = $input['cover'];
            $path = $file->store('public/products');
            $input['cover'] = $path;
        }

        $product->fill($input);
        $product->save();

        // Product::create($input);

        return Redirect::route('admin.products');
    }

    // Mostra página de criar
    public function create()
    {
        return view('admin.product_create');
    }

    // REcebe a requisição de criar POST
    public function store(ProductStoreRequest $request)
    {
        $input = $request->validated();

        $input['slug'] = Str::slug($input['name']);

        if (!empty($input['cover']) && $input['cover']->isValid()) {
            $file = $input['cover'];
            $path = $file->store('products');
            $input['cover'] = $path;
        }

        Product::create($input);

        return Redirect::route('admin.products');

    }

    public function destroy(Product $product)
    {
        $product->delete();

        return Redirect::route('admin.products');
    }
}
