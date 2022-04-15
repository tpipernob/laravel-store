<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.products', compact('products'));
    }

    // Mostrar a página editar
    public function edit()
    {
        return view('admin.product_edit');
    }

    // Recebe requisição para dar update PUT
    public function update()
    {
        return view('admin.product_edit');
    }

    // Mostra página de criar
    public function create()
    {
        return view('admin.product_create');
    }

    // REcebe a requisição de criar POST
    public function store()
    {
        return view('admin.product_edit');
    }
}
