<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Car;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@rentalmobil.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'phone' => '081234567890',
        ]);

        User::factory()->create([
            'name' => 'Customer',
            'email' => 'customer@rentalmobil.com',
            'password' => bcrypt('password'),
            'role' => 'customer',
            'phone' => '081234567891',
        ]);

        User::factory(10)->create(['role' => 'customer']);

        $carBrands = [
            'Toyota' => ['Avanza', 'Innova Zenix', 'Camry', 'Fortuner', 'Alphard'],
            'Honda' => ['Civic', 'CR-V', 'HR-V', 'Brio', 'Accord'],
            'Mitsubishi' => ['Xpander', 'Pajero Sport', 'Outlander'],
            'Daihatsu' => ['Terios', 'Sigra', 'Xenia', 'Gran Max'],
            'Suzuki' => ['Ertiga', 'XL7', 'Jimny'],
            'BMW' => ['320i', 'X5', 'X3'],
            'Mercedes-Benz' => ['C-Class', 'E-Class', 'GLC'],
        ];

        foreach ($carBrands as $brand => $models) {
            foreach ($models as $model) {
                $transmission = fake()->randomElement(['manual', 'automatic']);
                $basePrice = match ($brand) {
                    'BMW', 'Mercedes-Benz' => fake()->numberBetween(1500000, 3500000),
                    'Toyota' => $model === 'Alphard' ? fake()->numberBetween(3000000, 5000000) : fake()->numberBetween(250000, 800000),
                    default => fake()->numberBetween(200000, 600000),
                };

                Car::create([
                    'name' => $brand.' '.$model,
                    'brand' => $brand,
                    'year' => fake()->numberBetween(2020, 2024),
                    'price_per_day' => $basePrice,
                    'transmission' => $transmission,
                    'passenger_capacity' => fake()->randomElement([4, 5, 6, 7, 8]),
                    'description' => fake()->paragraph(4),
                    'status' => 'available',
                    'main_image' => null,
                ]);
            }
        }

        Booking::factory(30)->create();
    }
}
