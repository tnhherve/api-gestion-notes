<?php

namespace Database\Factories;

use App\Models\Evenement;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class EvenementFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Evenement::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => rand(1, 3),
            'nom_evenement' => $this->faker->numerify('Test final PROG##'),
            'date_debut' => now(),
            'date_fin' => Carbon::now()->addDays(10),
            'lieux' => $this->faker->city
        ];
    }
}
