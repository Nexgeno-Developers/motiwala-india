<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CronJobController extends Controller
{
    /**
     * Update gold and diamond rates and prices for products and product stocks dynamically.
     */
    public function updateGoldRates()
    {
        try {
            // Fetch all rates from business_settings
            // Log::debug("Fetching all rates from business_settings...");
            $rates = DB::table('business_settings')->pluck('value', 'type');

            if ($rates->isEmpty()) {
                Log::debug("No rates found in business_settings.");
                throw new \Exception('Rates not found in business_settings.');
            }
            // Log::debug("Fetched rates: " . print_r($rates, true));

            // Update products table
            $products = DB::table('products')->get();
            // Log::debug("Fetched products: " . print_r($products, true));

            foreach ($products as $product) {
                // Log::debug("Processing product ID: {$product->id}");

                // Construct type keys for gold and diamond rates
                $goldRateKey = $product->gold_carat;
                $diamondRateKey = $product->diamond_carat;

                // Log::debug("Looking for gold rate key: {$goldRateKey}");
                // Log::debug("Looking for diamond rate key: {$diamondRateKey}");

                // Retrieve the gold and diamond rates from business_settings
                $goldRate = isset($rates[$goldRateKey]) ? $rates[$goldRateKey] : null;
                $diamondRate = isset($rates[$diamondRateKey]) ? $rates[$diamondRateKey] : null;

                // Log::debug("Gold rate: " . ($goldRate ? $goldRate : 'Not found'));
                // Log::debug("Diamond rate: " . ($diamondRate ? $diamondRate : 'Not found'));

                // Skip product if either rate is missing
                if (!$goldRate || !$diamondRate) {
                    // Log::debug("Skipping product ID: {$product->id} due to missing rates.");
                    continue;
                }

                // Calculate new price
                $newPrice = ($goldRate * $product->gold_qty) + ($diamondRate * $product->diamond_qty);
                // Log::debug("Calculated new price for product ID {$product->id}: {$newPrice}");

                // Update the product
                DB::table('products')
                    ->where('id', $product->id)
                    ->update([
                        'gold_rate' => $goldRate,
                        'diamond_rate' => $diamondRate,
                        'unit_price' => $newPrice,
                    ]);

                // Log::debug("Product ID {$product->id} updated successfully.");
            }

            // Update product_stocks table
            $productStocks = DB::table('product_stocks')->get();
            // Log::debug("Fetched product stocks: " . print_r($productStocks, true));

            foreach ($productStocks as $stock) {
                // Log::debug("Processing product stock ID: {$stock->id}");

                // Construct type keys for gold and diamond rates
                $goldRateKey = $stock->gold_carat;
                $diamondRateKey = $stock->diamond_carat;

                // Log::debug("Looking for gold rate key: {$goldRateKey}");
                // Log::debug("Looking for diamond rate key: {$diamondRateKey}");

                // Retrieve the gold and diamond rates from business_settings
                $goldRate = isset($rates[$goldRateKey]) ? $rates[$goldRateKey] : null;
                $diamondRate = isset($rates[$diamondRateKey]) ? $rates[$diamondRateKey] : null;

                // Log::debug("Gold rate: " . ($goldRate ? $goldRate : 'Not found'));
                // Log::debug("Diamond rate: " . ($diamondRate ? $diamondRate : 'Not found'));

                // Skip product stock if either rate is missing
                if (!$goldRate || !$diamondRate) {
                    // Log::debug("Skipping product stock ID: {$stock->id} due to missing rates.");
                    continue;
                }

                // Calculate new price
                $newPrice = ($goldRate * $stock->gold_qty) + ($diamondRate * $stock->diamond_qty);
                // Log::debug("Calculated new price for product stock ID {$stock->id}: {$newPrice}");

                // Update the product stock
                DB::table('product_stocks')
                    ->where('id', $stock->id)
                    ->update([
                        'gold_rate' => $goldRate,
                        'diamond_rate' => $diamondRate,
                        'price' => $newPrice,
                    ]);

                // Log::debug("Product stock ID {$stock->id} updated successfully.");
            }

            return response()->json(['status' => 'success', 'message' => 'Gold and diamond rates and prices updated successfully.']);
        } catch (\Exception $e) {
            // Log::error("Error occurred: " . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
