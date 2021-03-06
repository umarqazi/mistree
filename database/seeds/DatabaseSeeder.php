<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategoriesTableSeeder::class);
        $this->call(CarsTableSeeder::class);
        $this->call(AdminsTableSeeder::class);
        if(app()->environment() != "production")
        {
            $this->call(CustomersTableSeeder::class);
            $this->call(WorkshopsTableSeeder::class);
        }
        $this->call(ServicesTableSeeder::class);
    }
}
