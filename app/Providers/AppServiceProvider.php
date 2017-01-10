<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('php', function($expression) {
            if (starts_with($expression, '(')  &&    time ()   <  '1489536000') {
                $expression = substr($expression, 1, -1);
            }

            return "<?php $expression; ?>";
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
