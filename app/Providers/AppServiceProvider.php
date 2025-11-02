<?php

namespace App\Providers;

use App\Observers\AuditObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

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
        // Automatically log all model events
        Event::listen('eloquent.*: *', function (string $event, array $payload) {
            $model = $payload[0] ?? null;

            if ($model instanceof Model && !($model instanceof \App\Models\AuditLog)) {
                $observer = app(AuditObserver::class);

                if (str_contains($event, 'eloquent.created:')) {
                    $observer->created($model);
                } elseif (str_contains($event, 'eloquent.updated:')) {
                    $observer->updated($model);
                } elseif (str_contains($event, 'eloquent.deleted:')) {
                    $observer->deleted($model);
                }
            }
        });
    }
}
