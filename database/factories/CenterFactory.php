<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Center>
 */
class CenterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $hospital=[
            'Dhaka Medical College',
            'Salimullah Medical College',
            'Barishal Medical College',
            'Mymensing Medical College',
            'Cox Bazar Medical College',
            'Chandpur Medical College',
            'Khulna Medical College',
            'Sylhet Medical College',
            'Rajshahi Medical College',
            'Delta Medical College',

        ];


        return [
            'name'=>$this->faker->randomElement($hospital),
            'limit'=>$this->faker->numberBetween(1,5),
        ];
    }
}
