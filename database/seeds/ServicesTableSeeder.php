<?php

use App\Service;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        Service::create([
            'name'              => 'Maintenance Services',
            'loyalty_points'    => 10,
            'image'             => url('img/thumbnail.png')
        ])->workshops()->attach([1,3,7,8]);

        Service::create([
            'name'              => 'Car Detailing',
            'loyalty_points'    => 10,
            'image'             => url('img/thumbnail.png')
        ])->workshops()->attach([1,2,6,7]);

        Service::create([
            'name'              => 'Oil Change',
            'service_parent'    => 1,
            'image'             => url('img/thumbnail.png')
        ])->workshops()->attach([1,7,8],['service_rate' => 500.00, 'service_time' => 0.50 ]);

        Service::create([
            'name'              => 'Tuning',
            'loyalty_points'    => 5,
            'service_parent'    => 1,
            'image'             => url('img/thumbnail.png')
        ])->workshops()->attach([1,3,8],['service_rate' => 1400.00, 'service_time' => 1.00]);

        Model::reguard();
    }
}
