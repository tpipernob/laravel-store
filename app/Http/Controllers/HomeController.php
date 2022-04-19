<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // $products = Product::all();

        // start query builder
        $products = Product::query();

        //$vl = $request->search
        $products->when($request->search, function($query, $vl) {
            $query->where('name', 'like', '%' . $vl . '%');
        });

        //final query builder
        $products = $products->get();

        return view('home', [
            'products' => $products
        ]);
    }
}
