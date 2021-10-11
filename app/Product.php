<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;

class Product extends Model
{
    protected $fillable = [
        'name', 'category_id', 'price',
    ];
    public function categories(){

        return $this->belongsTo('App\Category');
    }
}
