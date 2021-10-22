<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Category;
use App\Product;
use App\Image;
use App\Icon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $setup = DB::table('setup')->where('id','1')->first();
        return view('home',[
            'setup'=>$setup
        ]);
    }

    public function categories(){

        $categories = Category::orderBy('ordine','asc')->get();
        
        $icons = Icon::all();

        $setup = DB::table('setup')->where('id','1')->first();

        return view('categories',[
            'categories' => $categories,
            'setup'=>$setup,
            'icons'=>$icons
        ]);
    }
    public function products(){

        $categories = Category::orderBy('ordine','asc')->get();

        $setup = DB::table('setup')->where('id','1')->first();

        return view('products',[
            'categories' => $categories,
            'setup'=>$setup,
        ]);
    }

    public function pictures(){

        $images = Image::paginate(6);

        $icons = Icon::all();

        $setup = DB::table('setup')->where('id','1')->first();

        return view('pictures',[
            'images' => $images,
            'setup'=>$setup,
            'icons'=>$icons
        ]);
    }

    public function setup(){

        $setup = DB::table('setup')->where('id','1')->first();

        return view('setup',[
            'setup'=>$setup,
        ]);
    }
    public function setupSave(Request $request){

        $setup = DB::table('setup')->where('id','1')->first();

        if($request->logoUrl){

            if($setup->logoUrl){

                Storage::delete('public/'.$setup->logoUrl);
    
            }

            $path = $request->logoUrl->store('public/images');
    
            $path = str_replace('public/','',$path);

            DB::table('setup')->where('id','1')->update(['logoUrl'=>$path]);

        }

        if($request->backgroundUrl){

            if($setup->backgroundUrl){

                Storage::delete('public/'.$setup->backgroundUrl);
    
            }

            $path = $request->backgroundUrl->store('public/images');
    
            $path = str_replace('public/','',$path);

            DB::table('setup')->where('id','1')->update(['backgroundUrl'=>$path]);

        }


        DB::table('setup')->where('id','1')->update(['name'=>$request->name,'header' =>$request->header,'subHeader' => $request->subHeader,'columns'=>$request->columns,
        'layoutMenu'=>$request->layoutMenu,'css'=>$request->css,'font'=>$request->font,'websiteUrl'=>$request->websiteUrl,'openingTime'=>$request->openingTime]);
      
        session()->flash('green-message','Setup Saved');

        return back();


    }
    public function deleteLogoBackground(Request $request){

        $message = '';

        if($request->logo == 'on'){

            $setup = DB::table('setup')->where('id','1')->first();

            if($setup->logoUrl){


                Storage::delete('public/'.$setup->logoUrl);

                DB::table('setup')->where('id','1')->update(['logoUrl'=>null]);

                $message .= 'Logo Deleted. ';

            }
        }

        if($request->background == 'on'){

            $setup = DB::table('setup')->where('id','1')->first();

            if($setup->backgroundUrl){

            Storage::delete('public/'.$setup->backgroundUrl);

            DB::table('setup')->where('id','1')->update(['backgroundUrl'=>null]);

            $message .= 'Background Deleted. ';

            }

        }

        session()->flash('red-message',$message);

        return back();
    }
}
