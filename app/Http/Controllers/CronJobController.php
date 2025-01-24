<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CronJobController extends Controller
{
    /**
     * Update gold and diamond rates and prices for products and product stocks dynamically.
     */
    public function updateGoldRates()
    {
        try {
            // Fetch all rates from business_settings
            $rates = DB::table('business_settings')->pluck('value', 'type');

            if ($rates->isEmpty()) {
                throw new \Exception('Rates not found in business_settings.');
            }

            // Update products table
            $products = DB::table('products')->get();
            foreach ($products as $product) {
                // Retrieve the gold and diamond rates based on stored carat
                $goldRate = isset($rates[$product->gold_carat]) ? $rates[$product->gold_carat] : null;
                $diamondRate = isset($rates[$product->diamond_carat]) ? $rates[$product->diamond_carat] : null;

                if (!$goldRate || !$diamondRate) {
                    throw new \Exception("Missing rate for gold_carat: {$product->gold_carat} or diamond_carat: {$product->diamond_carat}");
                }

                // Calculate new price
                $newPrice = ($goldRate * $product->gold_qty) + ($diamondRate * $product->diamond_qty);

                // Update the product
                DB::table('products')
                    ->where('id', $product->id)
                    ->update([
                        'gold_rate' => $goldRate,
                        'diamond_rate' => $diamondRate,
                        'unit_price' => $newPrice,
                    ]);
            }

            // Update product_stocks table
            $productStocks = DB::table('product_stocks')->get();
            foreach ($productStocks as $stock) {
                // Retrieve the gold and diamond rates based on stored carat
                $goldRate = isset($rates[$stock->gold_carat]) ? $rates[$stock->gold_carat] : null;
                $diamondRate = isset($rates[$stock->diamond_carat]) ? $rates[$stock->diamond_carat] : null;

                if (!$goldRate || !$diamondRate) {
                    throw new \Exception("Missing rate for gold_carat: {$stock->gold_carat} or diamond_carat: {$stock->diamond_carat}");
                }

                // Calculate new price
                $newPrice = ($goldRate * $stock->gold_qty) + ($diamondRate * $stock->diamond_qty);

                // Update the product stock
                DB::table('product_stocks')
                    ->where('id', $stock->id)
                    ->update([
                        'gold_rate' => $goldRate,
                        'diamond_rate' => $diamondRate,
                        'price' => $newPrice,
                    ]);
            }

            return response()->json(['status' => 'success', 'message' => 'Gold and diamond rates and prices updated successfully.']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
