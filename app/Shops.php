<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shops extends Model
{
    public $fillable = ['name', 'company', 'url'];

    public function categories(){
        return $this->hasMany('App\ShopCategories');
    }
}
