<?php

namespace App\Services;

use AizPackages\CombinationGenerate\Services\CombinationService;
use App\Models\ProductStock;
use App\Utility\ProductUtility;

class ProductStockService
{
    public function store(array $data, $product)
    {
        $collection = collect($data);

        $options = ProductUtility::get_attribute_options($collection);

        //Generates the combinations of customer choice options
        $combinations = (new CombinationService())->generate_combination($options);

        $variant = '';
        if (count($combinations) > 0) {
            $product->variant_product = 1;
            $product->save();
            foreach ($combinations as $key => $combination) {
                $str = ProductUtility::get_combination_string($combination, $collection);
                $product_stock = new ProductStock();
                $product_stock->product_id = $product->id;
                $product_stock->variant = $str;
                $product_stock->price = request()['price_' . str_replace('.', '_', $str)];
                $product_stock->sku = request()['sku_' . str_replace('.', '_', $str)];
                $product_stock->qty = request()['qty_' . str_replace('.', '_', $str)];
                $product_stock->image = request()['img_' . str_replace('.', '_', $str)];

                // Handle the new fields (gold_rate, gold_qty, diamond_price)
                $product_stock->gold_carat = request()->get('gold_carat_' . str_replace('.', '_', $str), null);
                $product_stock->gold_rate = request()->get('gold_rate_' . str_replace('.', '_', $str), null);
                $product_stock->gold_qty = request()->get('gold_qty_' . str_replace('.', '_', $str), null);
                $product_stock->diamond_carat = request()->get('diamond_carat_' . str_replace('.', '_', $str), null);
                $product_stock->diamond_rate = request()->get('diamond_rate_' . str_replace('.', '_', $str), null);
                $product_stock->diamond_qty = request()->get('gold_qty_' . str_replace('.', '_', $str), null);

                $product_stock->save();
            }
        } else {
            unset($collection['colors_active'], $collection['colors'], $collection['choice_no']);
            $qty = $collection['current_stock'];
            $price = $collection['unit_price'];

            // Use default values for fields when not provided
            $gold_carat = $collection->get('gold_carat', $product->gold_carat);
            $gold_rate = $collection->get('gold_rate', $product->gold_rate);
            $gold_qty = $collection->get('gold_qty', $product->gold_qty);
            $diamond_carat = $collection->get('diamond_carat', $product->diamond_carat);
            $diamond_rate = $collection->get('diamond_rate', $product->diamond_rate);
            $diamond_qty = $collection->get('diamond_qty', $product->diamond_qty);

            unset($collection['current_stock']);

            $data = $collection->merge(compact('variant', 'qty', 'price', 'gold_carat', 'gold_rate', 'gold_qty', 'diamond_carat', 'diamond_rate', 'diamond_qty'))->toArray();

            ProductStock::create($data);
        }
    }

    public function product_duplicate_store($product_stocks , $product_new)
    {
        foreach ($product_stocks as $key => $stock) {
            $product_stock              = new ProductStock;
            $product_stock->product_id  = $product_new->id;
            $product_stock->variant     = $stock->variant;
            $product_stock->price       = $stock->price;
            $product_stock->sku         = $stock->sku;
            $product_stock->qty         = $stock->qty;
            $product_stock->save();
        }
    }
}
