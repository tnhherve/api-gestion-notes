<?php

namespace Database\Factories;

use App\Models\Cours;
use Illuminate\Database\Eloquent\Factories\Factory;

class CoursFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Cours::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'section_id' => rand(1, 3),
            'user_id' => rand(1, 5),
            'nom_cours' => $this->faker->numerify('PROG####'),
            'seuil_reussite' => rand(50, 80)
        ];
    }
}
