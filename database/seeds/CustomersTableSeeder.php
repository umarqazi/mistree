<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Model::unguard();

        factory(App\Customer::class, 5)->create([
            'password' => bcrypt('customer')
        ])->each(function($c){
            $c->addresses()->save(factory(App\CustomerAddress::class)->make());
            $c->cars()->attach(
                random_int(1,49), ['millage' => rand(1000, 99999), 'vehicle_no' => 'L'.strtoupper(str_random('2')).' '.rand(1,9999), 'year' => rand(1990, 2017)]
            );
        });

        Model::reguard();
       
    }
}
