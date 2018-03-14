<?php

use App\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        Category::create(['name' => 'Hatchback']);
        Category::create(['name' => 'Sedan/Saloon']);
        Category::create(['name' => 'Luxury Car']);
        Category::create(['name' => 'SUV/4X4']);

        Model::reguard();
    }
}
