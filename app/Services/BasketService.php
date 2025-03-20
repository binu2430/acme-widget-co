<?php

namespace App\Services;

class BasketService
{
    // Properties to store the product catalogue, delivery rules, and offers
    protected $catalogue;
    protected $deliveryRules;
    protected $offers;

    // Array to store the product codes added to the basket
    protected $products = [];

    // Constructor to initialize the catalogue, delivery rules, and offers
    public function __construct(array $catalogue, array $deliveryRules, array $offers)
    {
        $this->catalogue = $catalogue;
        $this->deliveryRules = $deliveryRules;
        $this->offers = $offers;
    }

    // Method to add a product to the basket
    public function add(string $productCode)
    {
        $this->products[] = $productCode;
    }

    // Method to calculate the total cost of the basket
    public function total(): float
    {
        $total = 0;
        $productCounts = array_count_values($this->products); // Count occurrences of each product

        // Loop through each product in the basket
        foreach ($productCounts as $code => $count) {
            $product = $this->catalogue[$code]; // Get product details from the catalogue
            $total += $product['price'] * $count; // Add the product price to the total

            // Apply any applicable offers
            if (isset($this->offers[$code])) {
                $total -= $this->applyOffer($code, $count, $product['price']);
            }
        }

        // Add delivery cost based on the total
        $total += $this->calculateDelivery($total);

        return $total;
    }

    // Method to apply special offers
    protected function applyOffer(string $code, int $count, float $price): float
    {
        // Example: "Buy one red widget, get the second half price"
        if ($code === 'R01') {
            $discountCount = intdiv($count, 2); // Calculate how many items qualify for the discount
            return $discountCount * ($price / 2); // Return the total discount
        }

        return 0; // No discount for other products
    }

    // Method to calculate delivery cost based on the total order value
    protected function calculateDelivery(float $total): float
    {
        if ($total >= 90) {
            return 0; // Free delivery for orders >= $90
        } elseif ($total >= 50) {
            return 2.95; // $2.95 delivery for orders >= $50
        } else {
            return 4.95; // $4.95 delivery for orders < $50
        }
    }
}