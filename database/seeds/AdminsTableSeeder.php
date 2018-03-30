<?php

use App\Admin;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        Admin::create([
            'name'      => 'Administrator',
            'email'     => 'admin@mystri.pk',
            'password'  => Hash::make('admin'),
            'con_number'=> '01234567890',
            'remember_token'    => str_random(10),
            'created_at'=> Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'=> Carbon::now()->format('Y-m-d H:i:s')
        ]);

        Model::reguard();
    }
}
