<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\BasketService;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(BasketService::class, function ($app) {
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
    
            return new BasketService($catalogue, $deliveryRules, $offers);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
