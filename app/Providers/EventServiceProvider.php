<?php

namespace App\Providers;

use App\Events\CompteCreated;
use App\Jobs\SendSmsJob;
use App\Listeners\SendCompteCreatedNotification;
use App\Models\Admin;
use App\Models\Client;
use App\Models\Compte;
use App\Models\User;
use App\Observers\AdminObserver;
use App\Observers\ClientObserver;
use App\Observers\CompteObserver;
use App\Observers\UserObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    // protected $listen = [
    //     Registered::class => [
    //         SendEmailVerificationNotification::class,
    //         // CompteCreated::class=> [SendSmsJob::class]
    //         // CompteCreated::class => [
    //         //     SendCompteCreatedNotification::class,
    //         // ],
    //         egistered::class => [
    //     SendEmailVerificationNotification::class,
    //     CompteCreated::class => [
    //         SendCompteCreatedNotification::class,
    //     ],
    // ],
    //     ],
    // ];

//     protected $listen = [
//     Registered::class => [
//         SendEmailVerificationNotification::class,
//         CompteCreated::class => [
//             SendCompteCreatedNotification::class,
//         ],
//     ],
// ];

protected $listen = [
    Registered::class => [
        SendEmailVerificationNotification::class,
    ],
    CompteCreated::class => [
        SendCompteCreatedNotification::class,
    ],
];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        Compte::observe(CompteObserver::class);
        Admin::observe(AdminObserver::class);
        Client::observe(ClientObserver::class);
        User::observe(UserObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
