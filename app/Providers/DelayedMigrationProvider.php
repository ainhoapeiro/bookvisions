<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Migrations\Migrator;

class DelayedMigrationProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->app->afterResolving(Migrator::class, function (Migrator $migrator) {
            $originalRun = \Closure::fromCallable([$migrator, 'run']);

            $migrator->macro('run', function (...$args) use ($originalRun) {
                $result = $originalRun(...$args);
                sleep(2); // retrasa 1 segundo después de cada ejecución de migración
                return $result;
            });
        });
    }

}
