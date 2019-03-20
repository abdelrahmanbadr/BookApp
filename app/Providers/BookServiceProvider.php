<?php
/**
 * Created by PhpStorm.
 * User: abdelrahmanbadr
 * Date: 3/20/19
 * Time: 1:22 PM
 */

namespace App\Providers;

use App\Domain\Contracts\BookServiceInterface;
use App\Domain\Services\BookService;
use App\Domain\Services\Factory\BookServiceFactory;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class BookServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $bookService = (new BookServiceFactory())->make();
        $this->app->instance(BookService::class, $bookService);
        $this->app->singleton(BookServiceInterface::class, BookService::class);

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    }
}