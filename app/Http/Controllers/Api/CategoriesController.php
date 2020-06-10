<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\ShopCategories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function update(Request $request, $id)
    {
        ShopCategories::whereId($id)->update($request->all());
    }
}
