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
            // Update products table
            $products = DB::table('products')->get();
            foreach ($products as $product) {
                // Skip if gold_carat or diamond_carat is null or empty
                if (empty($product->gold_carat) || empty($product->diamond_carat)) {
                    continue;
                }

                // Retrieve the gold and diamond rates based on stored carat
                $goldRate = get_setting($product->gold_carat);
                $diamondRate = get_setting($product->diamond_carat);

                // Skip if rates are missing
                if ($goldRate === null || $diamondRate === null) {
                    continue;
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
                // Skip if gold_carat or diamond_carat is null or empty
                if (empty($stock->gold_carat) || empty($stock->diamond_carat)) {
                    continue;
                }

                // Retrieve the gold and diamond rates based on stored carat
                $goldRate = get_setting($stock->gold_carat);
                $diamondRate = get_setting($stock->diamond_carat);

                // Skip if rates are missing
                if ($goldRate === null || $diamondRate === null) {
                    continue;
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
