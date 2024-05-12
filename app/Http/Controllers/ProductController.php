<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    function __construct()
    {
        $this->middleware(['permission:Products'], ['only' => ['index', 'store']]);
        $this->middleware(['permission:Add Product'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:Edit Product'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:Delete Product'], ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        $sections = Section::all();
        return view('products.products', compact('sections', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 'section_id'=>$id
        $this->validate($request, [
            "product_name" => 'required|unique:products',
            "description",
            "section_id"
        ]);

        Product::create([
            'product_name' => $request->product_name,
            'section_id' => $request->section_id,
            'description' => $request->description,
        ]);
        return  back()->with('success', 'Product Added successfully');
    }


    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {

        $products = Product::FindOrFail($request->pro_id);
        $id = Section::where('section_name', $request->section_name)->first()->id;
        // $data=$request->validate( [
        //     "product_name" => 'required|unique:products,product_name',
        // ]);
        $products->update([
            'product_name' => $request->product_name,
            'description' => $request->description,
            'section_id' => $id
        ]);
        return back()->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $products = Product::FindOrFail($request->pro_id);
        $products->delete();
        return back()->with('success1', 'Section Added successfully');
    }
}
