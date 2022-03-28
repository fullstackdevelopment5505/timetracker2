<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'guid' => $this->faker->uuid(),
            'email' => $this->faker->unique()->safeEmail(),
            'fullname' => $this->faker->name(),
            'initials' => strtoupper($this->faker->randomLetter() . $this->faker->randomLetter() . $this->faker->randomLetter()),
            'manager' => $this->faker->safeEmail(),
            'manager_guid' => $this->faker->uuid(),
            'department' => $this->faker->randomElement(['Claims Onboarding', 'Data Onboarding', 'Portal Support', 'Insurance Support']),
            'roles' => [],
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
