<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TypeEvaluation;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        TypeEvaluation::factory(10)->create();
        // \App\Models\User::factory(10)->create();
    }
}
