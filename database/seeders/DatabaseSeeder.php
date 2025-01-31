<?php

namespace Database\Seeders;

use App\Models\Citizen;
use App\Models\Violation;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $citizens = Citizen::factory(10)->create();

        $citizens->each(function ($citizen) {
            $citizen->licenses()->createMany([
                ['type' => 'Driver License'],
                ['type' => 'Business License'],
            ]);

            Violation::factory(2)->create(['license_id' => $citizen->licenses()->inRandomOrder()->first()->id]);
        });
    }
}
