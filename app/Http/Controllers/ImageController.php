<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Category;
use App\Product;
use App\Image;

class ImageController extends Controller
{

    public function store(Request $request){

        $image = new Image;

        $path = $request->images->store('public/images');

        $path = str_replace('public/','',$path);

        $image->name = $request->name;

        $image->path = $path;

        $image->description = $request->description;

        $image->purpose = $request->purpose;

        $image->save();

        session()->flash('green-message','Image Uploaded');

        return back();
            
        

            
    }
    public function update(Request $request, $id){

        $image = Image::findOrFail($id);

        if($request->images){

            Storage::delete('public/'.$image->path);

            $path = $request->images->store('public/images');
    
            $path = str_replace('public/','',$path);

            $image->path = $path;

        }

        $image->name = $request->name;

        $image->description = $request->description;

        $image->purpose = $request->purpose;

        $image->save();

        session()->flash('green-message','Image Updated');

        return back();
            
        

            
    }

    public function delete($id){

        $image = Image::findOrFail($id);

        Storage::delete('public/'.$image->path);

        $image->forceDelete();

        session()->flash('red-message','Image Deleted');

        return back();
    }
}
