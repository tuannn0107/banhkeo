<?php

namespace App\Providers;

use App\Listeners\AuthenticationListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\File;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    protected $subscribe = [
        AuthenticationListener::class,
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        $this->autoDiscoverObserver();
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }

    private function autoDiscoverObserver(): void
    {
        $observerFileList = File::files(app_path('Observers'));
        foreach ($observerFileList as $observerFile) {
            $model = 'App\\Models\\' . str($observerFile->getFilename())->before('Observer');
            $observer = 'App\\Observers\\' . $observerFile->getFilenameWithoutExtension();
            $model::observe($observer);
        }
    }
}
