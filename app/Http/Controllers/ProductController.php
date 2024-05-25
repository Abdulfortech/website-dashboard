<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Department;
use Illuminate\Http\Request;
use PDF;

class ProductController extends Controller
{
    //
    public function index()
    {
        $products = Product::whereNotNull('status')->orderBy('id', 'desc')->get();
        $allProducts = Product::whereNotNull('status')->get()->count();
        $activeProducts = Product::where('status', 'Active')->get()->count();
        $outstockProducts = Product::where('status', 'Inactive')->get()->count();
        return view('app.products.index', compact('products', 'allProducts', 'activeProducts', 'outstockProducts'));
    }

    public function create()
    {
        $departments = Department::whereNotNull('status')->get();
        $categories = Category::whereNotNull('status')->get();
        $lastProduct= Product::orderBy('id', 'desc')->first();
        $lastProductId = isset($lastProduct->id)?$lastProduct->id: 0;
        $nextID =  $lastProductId + 1;
        // dd($nextID);
        $code = 'PRD' . "/" . date('Y'). '/'. $nextID;
        return view('app.products.add', compact('departments', 'categories', 'code'));
    }

    public function add(Request $request)
    {
        // Store a new product
        
        $credentials = $request->validate([
            'title' => 'required|string|max:255',
            'code' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'brand' => 'nullable|string|max:255',
            'department' => 'required|string|max:255',
            // 'quantity' => 'required|integer',
            // 'cost' => 'required|numeric',
            // 'wholesalePrice' => 'required|numeric',
            'retailPrice' => 'required|numeric',
            // 'receivedDate' => 'nullable|date',
            // 'soldoutDate' => 'nullable|date',
            'image1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'nullable|string',
        ]);

        $credentials['user_id'] = auth()->user()->id;
        $credentials['business_id'] = auth()->user()->business->id;
        $credentials['status'] = 'Active';
        
        // dd($credentials);
        if($request->hasFile('image1')){
            $credentials['image1'] = $request->file('image1')->store('products', 'public');
        }

        $product = Product::create($credentials);
        if($product)
        {
            return redirect()->route('products')->with('message', 'You successfully add an product');
        }
        return redirect()->back()->with('message', 'There is an error.Try again');

    }

    public function view(Product $product)
    {
        // Show a specific product
        return view('app.products.view',['product'=> $product]);
    }
    
    public function pdf(Product $product)
    {
        // $content = file_get_contents('output.php');
        $pdf = PDF::setOptions(['defaultFont' => 'dejavu serif'])->loadView('app.products.pdf', ['product'=> $product]);

        return $pdf->download('AUCO-Product-'.$product->code.'.pdf');
    }

    public function pdfAll()
    {
        $products = Product::whereNotNull('status')->orderBy('id', 'desc')->get();
        $allProducts = Product::whereNotNull('status')->get()->count();
        $pdf = PDF::setOptions(['defaultFont' => 'dejavu serif'])->setPaper('A4', 'landscape')->loadView('app.products.pdfAll', ['products'=> $products, 'allProducts'=> $allProducts]);

        return $pdf->download('AUCO-Products.pdf');
    }

    public function edit(Product $product)
    {
        // Show the form to edit a product
        $departments = Department::whereNotNull('status')->get();
        $categories = Category::whereNotNull('status')->get();
        return view('app.products.edit', compact('departments', 'categories', 'product'));
    }

    public function update(Request $request, Product $product)
    {
        $credentials = $request->validate([
            'title' => 'required|string|max:255',
            'code' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'brand' => 'nullable|string|max:255',
            'department' => 'required|string|max:255',
            // 'quantity' => 'required|integer',
            // 'cost' => 'required|numeric',
            'wholesalePrice' => 'required|numeric',
            'retailPrice' => 'required|numeric',
            'receivedDate' => 'nullable|date',
            'soldoutDate' => 'nullable|date',
            'image1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'nullable|string',
        ]);

        if($request->hasFile('image1')){
            $credentials['image1'] = $request->file('image1')->store('products', 'public');
        }
        $credentials['updated_by'] = auth()->user()->id;

        $product->update($credentials);
        if($product)
        {
            return redirect()->route('products')->with('message', 'You successfully update a product');
        }
        return redirect()->back()->with('message', 'There is an error.Try again');

    }

    public function delete(Product $product)
    {
        // Delete a product
        $product->update([
            'status'=> null,
            'updated_by' => auth()->user()->id
        ]);

        if($product)
        {
            return redirect()->route('products')->with('message', 'You successfully delete a product');
        }
    }

    // Additional Methods for Activation and Deactivation

    public function activate(Product $product)
    {
        // Activate the product
        $product->update([
            'status' => 'Active',
            'updated_by' => auth()->user()->id
        ]);

        if($product)
        {
            return redirect()->route('products')->with('message', 'You successfully activate a product');
        }
    }

    public function deactivate(Product $product)
    {
        // Deactivate the product
        $product->update([
            'status' => 'Inactive',
            'updated_by' => auth()->user()->id
        ]);

        if($product)
        {
            return redirect()->route('products')->with('message', 'You successfully deactivate a product');
        }
    }

    public function searchProducts(Request $request)
    {
        // $searchTerm = $request->input('searchTerm');
        $products = Product::whereNotNull('status')->get();
        return response()->json(['products' => $products]);
    }
}
