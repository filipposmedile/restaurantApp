<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\DB;
use App\Category;
use App\Product;

class CategoryController extends Controller
{
    public function add(Request $request){

        $request->validate([
            'name'=>'required|min:2|max:255',
            'description'=>'max:255',
        ]);
        $category = new Category;

        $category->name = $request->name;

        $category->description = $request->description;

        if($request->images){

            $path = $request->images->store('public/images');

            $path = str_replace('public/','',$path);
            $category->img_path = $path;
        }
        if($request->icon){

            $category->icon_id = $request->icon;
        }
        $category->save();

        session()->flash('green-message','Category Saved');

        return back();
    }



    public function edit(Request $request, $id){

        $category = Category::findOrFail($id);

        $category->name = $request->name;

        $category->description = $request->description;

        if($request->images){

            Storage::delete('public/'.$category->img_path);

            $path = $request->images->store('public/images');

            $path = str_replace('public/','',$path);

            $category->img_path = $path;

        }
        if($request->no_img){

            Storage::delete('public/'.$category->img_path);

            $category->img_path = '';
        }
        if($request->path){

            $category->icon_id = $request->path;
        }
        $category->save();

        session()->flash('green-message','Category Edited');

        return back();
    }



    public function delete($id){

        $category = Category::findOrFail($id);

        Storage::delete('public/'.$category->img_path);

        $category->forceDelete();

        session()->flash('red-message','Category Deleted');

        return back();
    }
}
