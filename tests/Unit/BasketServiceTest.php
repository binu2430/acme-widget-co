
<?php
namespace Tests\Unit;

use App\Services\BasketService;
use Tests\TestCase;

class BasketServiceTest extends TestCase
{
    protected $basketService;

    // Set up the test environment
    protected function setUp(): void
    {
        parent::setUp();

        // Initialize the BasketService with test data
        $catalogue = [
            'R01' => ['price' => 32.95],
            'G01' => ['price' => 24.95],
            'B01' => ['price' => 7.95],
        ];

        $deliveryRules = [
            ['threshold' => 50, 'cost' => 4.95],
            ['threshold' => 90, 'cost' => 2.95],
            ['threshold' => PHP_FLOAT_MAX, 'cost' => 0],
        ];

        $offers = ['R01' => 'buy_one_get_one_half_price'];

        $this->basketService = new BasketService($catalogue, $deliveryRules, $offers);
    }

    // Test the total calculation with delivery and offers
    public function testTotalWithDeliveryAndOffers()
    {
        // Add products to the basket
        $this->basketService->add('B01');
        $this->basketService->add('G01');

        // Check the total
        $this->assertEquals(37.85, $this->basketService->total());

        // Add more products and check the total again
        $this->basketService->add('R01');
        $this->basketService->add('R01');
        $this->assertEquals(54.37, $this->basketService->total());
    }

    // Test the "buy one red widget, get the second half price" offer
    public function testRedWidgetOffer()
    {
        // Add two red widgets
        $this->basketService->add('R01');
        $this->basketService->add('R01');

        // Check the total with the offer applied
        $this->assertEquals(54.37, $this->basketService->total());
    }

    // Test free delivery for orders >= $90
    public function testFreeDelivery()
    {
        // Add products to reach $90
        $this->basketService->add('R01');
        $this->basketService->add('R01');
        $this->basketService->add('G01');
        $this->basketService->add('G01');

        // Check the total with free delivery
        $this->assertEquals(98.27, $this->basketService->total());
    }
}
