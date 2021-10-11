<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Icon;

class IconController extends Controller
{
    public function store(Request $request){

        $icon = new Icon;

        $path = $request->path->store('public/images/icons');

        $path = str_replace('public/','',$path);

        $icon->name = $request->name;

        $icon->path = $path;

        $icon->slug = $request->slug;

        $icon->save();

        session()->flash('green-message','Icon Uploaded');

        return back();
            
    }
    public function update(Request $request, $id){

        $icon = Icon::findOrFail($id);

        if($request->path){

            Storage::delete('public/'.$icon->path);

            $path = $request->path->store('public/images/icons');
    
            $path = str_replace('public/','',$path);

            $icon->path = $path;

        }

        $icon->name = $request->name;

        $icon->slug = $request->slug;

        $icon->save();

        session()->flash('green-message','Icon Updated');

        return back();
            
        

            
    }

    public function delete($id){

        $icon = Icon::findOrFail($id);

        Storage::delete('public/'.$icon->path);

        $icon->forceDelete();

        session()->flash('red-message','Icon Deleted');

        return back();
    }
}
