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
        });

        Model::reguard();
       
    }
}
