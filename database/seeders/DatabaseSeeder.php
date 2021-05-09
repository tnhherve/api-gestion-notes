<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Section;
use \App\Models\Ecole;
use App\Models\TypeEvaluation;
use App\Models\User;
use App\Models\Cours;
use App\Models\Evaluation;
use App\Models\Evenement;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Ecole::factory(3)->create();
        Section::factory()->count(3)->create();
        TypeEvaluation::factory(7)->create();
        User::factory(3)->create();
        Cours::factory()->count(15)->create();
        Evaluation::factory()->count(30)->create();
        Evenement::factory()->count(25)->create();
    }
}
