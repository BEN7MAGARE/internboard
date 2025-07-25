<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Corporate;

class MarketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::whereHas('corporate', function ($query) {
            $query->where('approved', true);
        })->latest()->paginate(16);
        $corporates = Corporate::where('approved', true)->get();
        return view('market.index', compact('products', 'corporates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function search(Request $request)
    {
        $products = Product::where('name', 'like', '%' . $request->search . '%')
            ->orWhere('description', 'like', '%' . $request->search . '%')
            ->orWhereHas('corporate', function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%');
            })->latest()->paginate(16);
        $corporates = Corporate::where('approved', true)->get();
        return view('market.index', compact('products', 'corporates'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
