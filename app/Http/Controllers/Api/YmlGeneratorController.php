<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreYML;
use App\Jobs\GenerateYML;
use App\Product;
use App\ShopCategories;
use App\Shops;
use Illuminate\Http\Request;

class YmlGeneratorController extends Controller
{

    /**
     * generate yml file.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function generate(StoreYML $request)
    {
        $param = $request->input('shop');
        $shop = Shops::create($param['shop_detail']);
        foreach($param['categories'] as $item){
            $category = ShopCategories::create([
                'shop_id' => $shop->id,
               'in_id' => $item['id'],
               'name' => $item['name'],
            ]);

            foreach($param['offers'] as $offer){
                if($item['id'] == $offer['categoryId']){
                    $product  = Product::create([
                        'shop_id' => $shop->id,
                        'category_id' => $category->id,
                        'in_id' => $offer['id'],
                        'in_category_id' => $item['id'],
                        'name' => $offer['name'],
                        'price' => $offer['price'],
                        'picture' => $offer['picture']
                    ]);
                }
            }
        }
        GenerateYML::dispatch($shop)->onConnection('database');
        return json_encode(['status' => 'Product list add to generate yml file']);
    }

    public function get_url(){

    }
}
