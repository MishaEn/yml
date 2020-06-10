<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function update(Request $request, $id)
    {
        Product::whereId($id)->update($request->all());
    }
}
