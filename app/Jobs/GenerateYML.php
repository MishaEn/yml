<?php

namespace App\Jobs;

use App\Product;
use App\ShopCategories;
use App\Shops;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class GenerateYML implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $shop;

    /**
     * Create a new job instance.
     *
     * @param Shops $shop
     */
    public function __construct(Shops $shop)
    {
        $this->shop = $shop;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $categories = $this->shop->categories();
        $category_list = '';
        $product_list = '';
        $categories = ShopCategories::where('shop_id', $this->shop->id)->get();
        $products = Product::where('shop_id', $this->shop->id)->get();
        foreach($categories as $category){
            $category_list .= '<category id="'.$category->in_id.'">'.$category->name.'</category>';
        }
        foreach($products as $product){
            $product_list .= '
            <offer id="'.$product->id.'">
                <name>'.$product->name.'</name>
                <url>'.$product->url.'</url>
                <price>'.$product->price.'</price>
                <currencyId>RUR</currencyId>
                <categoryId>'.$product->in_category_id.'</categoryId>
                <picture>'.$product->picture.'</picture>
                <delivery>false</delivery>
                </offer>
            ';
        }
        $contents = '
<?xml version="1.0" encoding="UTF-8"?>
<yml_catalog date="'.Carbon::now().'">
    <shop>
        <name>'.$this->shop->name.'</name>
        <company>'.$this->shop->company.'</company>
        <url>'.$this->shop->url.'</url>
        <currencies>
            <currency id="RUR" rate="1"/>
        </currencies>
        <categories>
            '.$category_list.'
        </categories>
        <delivery-options>
            <option cost="200" days="1"/>
        </delivery-options>
        <offers>
            '.$product_list.'
        </offers>
        <gifts>
            <!-- подарки не из прайс‑листа -->
        </gifts>
        <promos>
            <!-- промоакции -->
        </promos>
    </shop>
</yml_catalog>
';
        Storage::put($this->shop->name.'.yml', $contents);
    }
}
