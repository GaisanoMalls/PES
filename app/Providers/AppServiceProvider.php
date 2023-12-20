<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        Paginator::useBootstrap();
        Validator::extend('descending_order', function ($attribute, $value, $parameters, $validator) {
            // Custom validation logic to check if the array is in descending order
            $sortedArray = array_values($value);
            $descendingOrder = true;

            for ($i = 1; $i < count($sortedArray); $i++) {
                if ($sortedArray[$i - 1] < $sortedArray[$i]) {
                    $descendingOrder = false;
                    break;
                }
            }

            return $descendingOrder;
        });
    }
}
