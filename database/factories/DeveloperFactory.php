<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DeveloperFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $positions = ['Front-End Developer','Back-End Developer','QA analyst','Mobile Developer'];
        $skills = [
            'Angular, JavaScript, GitHub',
            'PHP, Java, Android, GitHub',
            'Jest, Jira, JavaScript, SQL',
            'React native, Android'
        ];

        $rand = rand(0, 3);

        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'position' => $positions[$rand],
            'salary' => $this->faker->numberBetween(3500000,20000000),
            'skills' => $skills[$rand],
        ];
    }
}
