<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;
use App\Icon;

class Category extends Model
{
    protected $fillable = [
        'name', 'description', 'img_path','icon_id'
    ];
    public function products(){

        return $this->hasMany('App\Product');
    }
    public function icon(){

        return $this->belongsTo('App\Icon');
    }
}
