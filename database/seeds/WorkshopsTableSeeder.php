<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class WorkshopsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        factory(App\Workshop::class, 10)->create([
            'password'  => bcrypt('workshop')
        ])->each(function($w){
            $w->address()->save(factory(App\WorkshopAddress::class)->make());
            $w->balance()->save(factory(App\WorkshopBalance::class)->make());
        });

        Model::reguard();
    }
}
