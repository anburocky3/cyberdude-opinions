<?php

namespace App\Providers;

use App\Events\SuggestionCreated;
use App\Listeners\SendSuggestionConfirmation;
use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected array $listen = [
        SuggestionCreated::class => [
            SendSuggestionConfirmation::class
        ],
    ];

    public function register(): void
    {

    }

    public function boot(): void
    {
    }
}
