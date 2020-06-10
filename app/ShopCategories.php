<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShopCategories extends Model
{
    public $fillable = ['shop_id', 'in_id', 'name'];

    public function shop(){
        return $this->belongsTo('App\Shops');
    }
}
