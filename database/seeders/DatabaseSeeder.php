<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\Role::factory()
        ->count(3)
        ->state(new Sequence(
            ['role' => 'Bidder'],
            ['role' => 'Seller'],
            ['role' => 'Admin'],
        ))
        ->create();
    }
}