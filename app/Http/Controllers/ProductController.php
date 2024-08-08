<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductsImport;
use App\Exports\ExportProduct;
use App\Models\Product;

class ProductController extends Controller
{
    public function importView(){
        return view('importFile');
    }

    public function import(Request $request){
        Excel::import(new ProductsImport, $request->file('file')->store('files'));
        return redirect()->back();
    }

    public function exportProduct(){
        $date = date('Y-m-d_H-i-s');
        $fileName = "products_{$date}.xlsx";
        return Excel::download(new ExportProduct, $fileName);
    }

    public function index()
    {
        $products = Product::with('images')->get();
        return view('index', compact('products'));
    }

    public function show($id)
    {
        $product = Product::with(['extraFields', 'images'])->findOrFail($id);
        return view('show', compact('product'));
    }
}