<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Migrations\Migrator;

class DelayedMigrationProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->extend(Migrator::class, function ($migrator, $app) {
            return new class($migrator) extends Migrator {
                public function run($paths = [], array $options = [])
                {
                    parent::run($paths, $options);

                    // PAUSA para que MySQL registre bien las tablas
                    sleep(2); // Puedes aumentar a 2 si sigue fallando
                }
            };
        });
    }

    public function boot(): void
    {
        //
    }
}
