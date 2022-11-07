<?php

namespace App\Providers;

use App\Repositories\Hotel\HotelRepository;
use App\Repositories\Hotel\HotelRepositoryEloquent;
use App\Repositories\Room\RoomRepository;
use App\Repositories\Room\RoomRepositoryEloquent;
use App\Repositories\Room\RoomTypeRepository;
use App\Repositories\Room\RoomTypeRepositoryEloquent;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(UserRepository::class,
            UserRepositoryEloquent::class);

        $this->app->bind(HotelRepository::class,
            HotelRepositoryEloquent::class);

        $this->app->bind(RoomRepository::class,
            RoomRepositoryEloquent::class);

        $this->app->bind(RoomTypeRepository::class,
            RoomTypeRepositoryEloquent::class);
        //:end-bindings:
    }
}
