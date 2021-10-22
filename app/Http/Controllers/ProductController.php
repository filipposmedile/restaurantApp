<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Storage;

use App\Category;
use App\Product;

class ProductController extends Controller
{
    //
    public function addProduct($category){

        $category = Category::findOrFail($category);

        $categories = Category::all();

        $setup = DB::table('setup')->where('id','1')->first();

        return view('add-product',[
            'category' => $category,
            'categories' => $categories,
            'setup'=>$setup
        ]);
    }

    public function store(Request $request, $id){

        $request->validate([
            'name'=>'required|min:2|max:255',
        ]);

        $product = new Product;

        $product->name = $request->name;

        if($request->images){

            $path = $request->images->store('public/images/products');

            $path = str_replace('public/','',$path);
            $product->img_path = $path;
        }

        $product->message = $request->message;

        $product->homeUse = $request->homeUse;

        $product->price = $request->price;

        $product->description = $request->description;

        $product->category_id = $id;

        $maxOrdine = DB::table('products')->max('ordine');

        if(is_null($maxOrdine)){

            $product->ordine = 1;

        } else {

            $maxOrdine++;

            $product->ordine = $maxOrdine;

        }

        $product->save();

        session()->flash('green-message','Product Added');

        return back();

    }

    public function update(Request $request, $id){

        $request->validate([
            'name'=>'required|min:2|max:255',
        ]);

        $product = Product::findOrFail($id);

        if($request->images){

            Storage::delete('public/'.$product->img_path);

            $path = $request->images->store('public/images/products');

            $path = str_replace('public/','',$path);

            $product->img_path = $path;

        }
        if($request->no_img){

            Storage::delete('public/'.$product->img_path);

            $product->img_path = '';
        }
        $product->message = $request->message;

        $product->homeUse = $request->homeUse;

        $product->name = $request->name;

        $product->price = $request->price;
        
        $product->description = $request->description;
        
        if($request->category_id){

            $product->category_id = $request->category_id;
        
        }


        $product->save();

        session()->flash('green-message','Product Updated');

        return back();

    }
    public function delete($id){

        $product = Product::findOrFail($id);

        Storage::delete('public/'.$product->img_path);

        $product->forceDelete();

        session()->flash('red-message','Product Deleted');

        return back();
    }
}
