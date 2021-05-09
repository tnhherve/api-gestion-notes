<?php

namespace Database\Factories;

use App\Models\Evaluation;
use Illuminate\Database\Eloquent\Factories\Factory;

class EvaluationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Evaluation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type_evaluation_id' => rand(1, 7),
            'cours_id' => rand(1, 15),
            'titre' => $this->faker->numerify('Test#'),
            'note' => rand(50, 99),
            'ponderation'=>rand(20, 40),
            'date_evaluation' => now()
        ];
    }
}
