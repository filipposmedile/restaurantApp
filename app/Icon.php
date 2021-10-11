<?php

namespace App;
use App\Category;

use Illuminate\Database\Eloquent\Model;

class Icon extends Model
{
    protected $fillable = [
        'name', 'slug', 'path',
    ];
    public function categories(){

        return $this->hasMany('App\Category');
    }
}
