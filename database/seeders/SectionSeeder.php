<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Section;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(SectionSeeder::class);
        Section::factory()->count(5)->create();
    }
}
