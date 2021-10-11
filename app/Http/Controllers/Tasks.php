<?php

namespace App\Http\Controllers;
use App\Product;
use App\Category;
use App\User;
use App\Image;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class Tasks extends Controller
{

    protected $prodottos;


    public function prices(){

        $categories = Category::all();

        $setup = DB::table('setup')->where('id','1')->first();

        return view('prices',[
            'categories' => $categories,
            'setup'=>$setup,
        ]);
    }


    public function caricamentoPublic(){
        $setup = DB::table('setup')->where('id','1')->first();
        return view('home',[
            'setup'=>$setup,
        ]);
    }
    public function email(Request $request){
        if(isset($_COOKIE['IP'])){
            return back()->with('alert', 'Puoi inviare una email solo ogni 10 Minuti.');
        }
        
        if(mail('filipposmedile@live.it','Email Da sito','Nome: '.$request->name.' Email: '.$request->email.' <br> '.$request->content)){
            $name = "IP";
			$ip = $_SERVER['REMOTE_ADDR'];
			setcookie($name,$ip,time()+60*10);
            $message = 'Messaggio inviato';
            return back()->with('alert', 'Email Inviata!');
        } else {
            return back()->with('alert', 'Errore!');
        }
    }
    
}
