<?php

namespace App\Http\Controllers;

use App\Services\BasketService;
use Illuminate\Http\Request;

class BasketController extends Controller
{
    protected $basketService;

    // Inject the BasketService via the constructor
    public function __construct(BasketService $basketService)
    {
        $this->basketService = $basketService;
    }

    // Method to calculate the total and return it as a JSON response
    public function calculateTotal(Request $request)
    {
        $products = $request->input('products', []);

        // Clear the basket and add the new products
        foreach ($products as $productCode) {
            $this->basketService->add($productCode);
        }
    
        // Calculate the total
        $total = $this->basketService->total();
    
        // Return the total as a JSON response
        return response()->json(['total' => $total]);
    }
}
