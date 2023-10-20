<?php

namespace Database\Seeders;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        if ($this->app->environment() !== 'production') {
            Factory::guessFactoryNamesUsing(function (string $modelClass) {
                return 'Database\\Factories\\' . class_basename($modelClass) . 'Factory';
            });
        }

        $this->call([
            UserSeeder::class,
            TaskSeeder::class,
        ]);
    }
}
