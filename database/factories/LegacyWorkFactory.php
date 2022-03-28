<?php

namespace Database\Factories;

use App\Models\LegacyWork;
use Illuminate\Database\Eloquent\Factories\Factory;

class LegacyWorkFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LegacyWork::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'account_id' => $this->faker->randomNumber(6),
            'account_start_time' => $this->faker->time('H:i:s'),
            'action_code' => $this->faker->randomNumber(3),
            'user_initials' => strtoupper($this->faker->randomLetter() . $this->faker->randomLetter() . $this->faker->randomLetter()),
        ];
    }
}
