<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $days = fake()->randomDigitNotNull();
        $time = fake()->dateTimeThisMonth();
        return [
            'car_id' => 'required',
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'date_begin' => $time->format('Y-m-d'),
            'date_end' => $time->modify('+'.$days.' days')->format('Y-m-d'),
            'days_reserved' => $days,
            'total_price' => fake()->randomNumber(4, true),
        ];
    }
}
