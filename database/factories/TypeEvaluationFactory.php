<?php

namespace Database\Factories;

use App\Models\TypeEvaluation;
use Illuminate\Database\Eloquent\Factories\Factory;

class TypeEvaluationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TypeEvaluation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nom_type'=>$this->faker->creditCardType,
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s')
        ];
    }
}
