<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CronJobController extends Controller
{
    /**
     * Update gold rates and prices for products and product stocks.
     */
    public function updateGoldRates()
    {
        try {
            // Fetch the latest gold rate from business_settings
            $goldRate = DB::table('business_settings')
                ->where('type', 'gold_rate_18_carat')
                ->value('value');

            if (!$goldRate) {
                throw new \Exception('Gold rate not found in business_settings.');
            }

            // Update products table
            $products = DB::table('products')->get();
            foreach ($products as $product) {
                $newPrice = $goldRate * $product->gold_qty + $product->diamond_price;

                DB::table('products')
                    ->where('id', $product->id)
                    ->update([
                        'gold_rate' => $goldRate,
                        'unit_price' => $newPrice,
                    ]);
            }

            // Update product_stocks table
            $productStocks = DB::table('product_stocks')->get();
            foreach ($productStocks as $stock) {
                $newPrice = $goldRate * $stock->gold_qty + $stock->diamond_price;

                DB::table('product_stocks')
                    ->where('id', $stock->id)
                    ->update([
                        'gold_rate' => $goldRate,
                        'price' => $newPrice,
                    ]);
            }

            return response()->json(['status' => 'success', 'message' => 'Gold rates and prices updated successfully.']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
