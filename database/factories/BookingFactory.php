<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\Car;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingFactory extends Factory
{
    protected $model = Booking::class;

    public function definition(): array
    {
        $startDate = Carbon::today()->subDays(fake()->numberBetween(0, 30));
        $endDate = $startDate->copy()->addDays(fake()->numberBetween(1, 7));
        $totalDays = $startDate->diffInDays($endDate) + 1;
        $car = Car::inRandomOrder()->first() ?? Car::factory()->create();
        $pricePerDay = $car->price_per_day;
        $driverService = fake()->boolean(30);
        $totalPrice = $totalDays * $pricePerDay;
        if ($driverService) {
            $totalPrice += $totalDays * 150000;
        }

        return [
            'booking_code' => Booking::generateBookingCode(),
            'user_id' => User::where('role', 'customer')->inRandomOrder()->first()?->id ?? User::factory(),
            'car_id' => $car->id,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'total_days' => $totalDays,
            'driver_service' => $driverService,
            'pickup_location' => fake()->address(),
            'total_price' => $totalPrice,
            'booking_status' => fake()->randomElement(['pending', 'confirmed', 'in_progress', 'completed']),
        ];
    }
}
