<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Shops;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function update(Request $request, $id)
    {
        Shops::whereId($id)->update($request->all());
    }
}
