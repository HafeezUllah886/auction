<?php

namespace App\Http\Controllers;

use App\Models\export;
use App\Http\Controllers\Controller;
use App\Models\parts;
use App\Models\purchase;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $exports = export::all();
        return view('export.index', compact('exports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = purchase::where('status', 'Available')->get();
        $parts = parts::all();
        return view('export.create', compact('products', 'parts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $export = new export();
        $export->product_id = $request->product_id;
        $export->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(export $export)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(export $export)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, export $export)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(export $export)
    {
        //
    }

    public function getProduct($id)
    {
        $product = purchase::find($id);
        return response()->json($product);
    }
}
