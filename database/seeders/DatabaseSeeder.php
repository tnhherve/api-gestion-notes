<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Section;
use \App\Models\Ecole;
use App\Models\TypeEvaluation;
use App\Models\User;


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
        User::factory(5)->create();
        Ecole::factory(3)->create();
        //$this->call(SectionSeeder::class)
        Section::factory()->count(5)->create();
    }
}
