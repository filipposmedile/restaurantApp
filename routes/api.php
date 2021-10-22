<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Category;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
    
});


Route::post('changeId/{id}/{table}',function(Request $request, $id, $table){

        $actual = DB::table($table)->where('id',$id)->first();

        $counter = 1;

        $maxId = DB::table($table)->max('ordine');
       
        $minId = DB::table($table)->min('ordine');

        $previous = DB::table($table)->where('ordine',$request->ordine - $counter)->first();

        $maxId++;

        while(is_null($previous) and !($request->move == 'up')) {

            $counter++;

            $previous = DB::table($table)->where('ordine',$request->ordine - $counter)->first();

            if($actual->ordine == $minId){
                return back();
            }
        }

        $counter = 1;

        $next = DB::table($table)->where('ordine',$request->ordine + $counter)->first();
    
        while(is_null($next) and ($request->move == 'up')) {
            
            $counter++;

            $next = DB::table($table)->where('ordine',$request->ordine + $counter)->first();

            if($actual->ordine == ($maxId -1)){
                return back();
            }

        }

       if($request->move == 'up'){
           
    
            DB::table($table)->where('ordine','=',$next->ordine)->update(['ordine'=>$maxId]);
        
            DB::table($table)->where('ordine','=',$request->ordine)->update(['ordine'=>$next->ordine]);

            DB::table($table)->where('ordine','=',$maxId)->update(['ordine'=>$request->ordine]);
    
       } else {
    
            DB::table($table)->where('ordine','=',$previous->ordine)->update(['ordine'=>$maxId]);
        
            DB::table($table)->where('ordine','=',$actual->ordine)->update(['ordine'=>$previous->ordine]);
        
            DB::table($table)->where('ordine','=',$maxId)->update(['ordine'=>$request->ordine]);
       }
       return back();
    
    })->name('changeId');


Route::get('test',function(){
    $x = Category::find(9);
    return 'asuhdaus';
});
