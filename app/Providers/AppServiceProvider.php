<?php

namespace App\Providers;

use App\Core\Base\Service\CacheServiceInterface;
use App\Core\Base\Service\QueueServiceInterface;
use App\Core\Illuminate\Repository\IlluminateReservationRepository;
use App\Core\Illuminate\Repository\IlluminateShowtimeRepository;
use App\Core\Illuminate\Service\QueueService;
use App\Core\Illuminate\Service\RedisCacheService;
use App\Core\Provider\CacheMovieProvider;
use App\Core\Provider\MovieProvider;
use App\Core\Repository\ReservationRepository;
use App\Core\Repository\ShowtimeRepository;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ClientInterface::class, Client::class);

        // movie
        $this->app->when(CacheMovieProvider::class)
            ->needs('$configuration')
            ->giveConfig('omdb');
        $this->app->bind(MovieProvider::class, CacheMovieProvider::class);

        // showtime
        $this->app->bind(ShowtimeRepository::class, IlluminateShowtimeRepository::class);
        $this->app->bind(QueueServiceInterface::class, QueueService::class);
        $this->app->bind(CacheServiceInterface::class, RedisCacheService::class);

        // reservation
        $this->app->bind(ReservationRepository::class, IlluminateReservationRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
