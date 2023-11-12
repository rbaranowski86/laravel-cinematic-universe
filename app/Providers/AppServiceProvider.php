<?php

namespace App\Providers;

use App\Contracts\ActorContract;
use App\Contracts\CharacterContract;
use App\Contracts\CinematicUniverseContract;
use App\Contracts\MovieContract;
use App\Services\ActorService;
use App\Services\CharacterService;
use App\Services\CinematicUniverseService;
use App\Services\MovieService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CinematicUniverseContract::class, CinematicUniverseService::class);
        $this->app->bind(MovieContract::class, MovieService::class);
        $this->app->bind(CharacterContract::class, CharacterService::class);
        $this->app->bind(ActorContract::class, ActorService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
