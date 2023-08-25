<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\EloquentVendasRepository;
use App\Repositories\VendasRepository;

class VendasRepositoryProvider extends ServiceProvider
{
    public array $bindings = [
        VendasRepository::class => EloquentVendasRepository::class,
    ];
}
