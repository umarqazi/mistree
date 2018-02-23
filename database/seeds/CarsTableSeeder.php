<?php

use App\Cars;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class CarsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       	Model::unguard();

        factory(App\Car::class, 50)->create();

        Model::reguard();
    }
}
