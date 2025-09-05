<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
    $this->call(CategoriesSeeder::class);
    \App\Models\Contact::factory(35)->create();
    }
}
