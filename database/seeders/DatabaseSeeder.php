<?php

namespace Database\Seeders;

use Database\Seeders\PofSeeder;
use Illuminate\Database\Seeder;
use Database\Seeders\RomansSeeder;
use Database\Seeders\PortfolioSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RomansSeeder::class,
            PortfolioSeeder::class,
            StarmapSeeder::class,
            PofSeeder::class,
        ]);
    }
}
