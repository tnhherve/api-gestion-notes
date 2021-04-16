<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ecole;

class EcoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ecole::factory()->count(3)->create();
    }
}
