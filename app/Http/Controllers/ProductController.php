<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return Product::all();
    }

    public function getProductById($id)
    {
        return Product::find($id);
    }

    public function createProduct(Request $request)
    {
        $request->validate([
            'name'=> 'required',
            'slug'=> 'required',
            'description'=> 'required',
            'price'=> 'required',
        ]);
        return Product::create($request->all());

    }

    public function update(Request $request, $id){
        $data = Product::find($id);
        $data->update($request->all());
        return $data;
    }

    public function destroy($id){
        return Product::destroy($id);
    }

    public function search($name){
        return Product::where('name', 'like', '%'.$name.'%')
                        ->orWhere('slug', 'like', '%'.$name.'%')
                        ->orWhere('description', 'like', '%'.$name.'%')
                        ->orWhere('price', 'like', '%'.$name.'%')
                        ->get();
    }
}
