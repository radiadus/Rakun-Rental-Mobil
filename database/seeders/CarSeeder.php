<?php

namespace Database\Seeders;

use App\Models\Car;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Car::create(['image'=>"Avanza.png", 'car_name'=>"Toyota Avanza", 'price'=>"300000", 'available'=>1]);
        Car::create(['image'=>"Innova.png", 'car_name'=>"Toyota Kijang Innova", 'price'=>"400000", 'available'=>1]);
        Car::create(['image'=>"Brio.png", 'car_name'=>"Honda Brio", 'price'=>"200000", 'available'=>1]);

    }
}
