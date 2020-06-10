<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['shop_id', 'category_id', 'in_id', 'in_category_id', 'name', 'price', 'picture'];
}
