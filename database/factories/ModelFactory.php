<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Customer::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name'          => $faker->name,
        'email'         => preg_replace('/@example\..*/', '@wmp.com', $faker->unique()->safeEmail),
        'password'      => $password ?: $password = bcrypt('secret'),
        'con_number'    => '03'.$faker->randomElement(['00','01','02','03','04','05','06','07',10,11,12,13,14,15,16,20,21,22,23,24,25,26,31,32,33,34,35,41,42,43,44,45,46,47]).$faker->numberBetween(4,9).$faker->randomNumber(6, true),
        'remember_token'=> str_random(10),
        'created_at'    => $faker->dateTimeBetween('-5 days', 'now', 'Asia/Karachi'),
        'updated_at'    => $faker->dateTimeBetween('-3 days', 'now', 'Asia/Karachi'),
        'is_verified'   => 1,
    ];
});

$factory->define(App\CustomerAddress::class, function(Faker\Generator $faker){
    return [
        'type'          => $faker->randomElement(['Office', 'Residence']),
        'house_no'      => $faker->buildingNumber,
        'street_no'     => random_int(1, 16),
        'block'         => ucwords($faker->randomLetter),
        'town'          => $faker->randomElement(['Johar', 'Muslim', 'Faisal', 'Model', 'Bahria', 'Nishtar']).' Town',
        'city'          => 'Lahore',
        'created_at'    => $faker->dateTimeBetween('-5 days', 'now', 'Asia/Karachi'),
        'updated_at'    => $faker->dateTimeBetween('-3 days', 'now', 'Asia/Karachi'),
    ];
});

$factory->define(App\Workshop::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name'          => $faker->company,
        'owner_name'    => $faker->name('male'),
        'email'         => preg_replace('/@example\..*/', '@wmp.com', $faker->unique()->safeEmail),
        'password'      => $password ?: $password = bcrypt('secret'),
        'cnic'          => $faker->numberBetween(35201, 35205).$faker->randomNumber(8, true),
        'mobile'        => '03'.$faker->randomElement(['00','01','02','03','04','05','06','07',10,11,12,13,14,15,16,20,21,22,23,24,25,26,31,32,33,34,35,41,42,43,44,45,46,47]).$faker->numberBetween(4,9).$faker->randomNumber(6, true),
        'landline'      => '0423'.$faker->numberBetween(4,6).$faker->randomNumber(6, true),
        'type'          => $faker->randomElement(['Authorized', 'Unauthorized']),
        'profile_pic'   => $faker->imageUrl(640,480,'business',true),
        'open_time'     => $faker->numberBetween(10,11).':00am',
        'close_time'    => $faker->numberBetween(10,11).':00pm',
        'is_approved'   => 1,
        'remember_token'=> str_random(10),
        'created_at'    => $faker->dateTimeBetween('-5 days', 'now', 'Asia/Karachi'),
        'updated_at'    => $faker->dateTimeBetween('-3 days', 'now', 'Asia/Karachi'),
        'is_verified'   => 1,
    ];
});

$factory->define(App\WorkshopAddress::class, function(Faker\Generator $faker){
    return [
        'shop'          => $faker->buildingNumber,
        'building'      => $faker->numerify('Building ###'),
        'street'        => random_int(1, 16),
        'block'         => ucwords($faker->randomLetter),
        'town'          => $faker->randomElement(['Johar', 'Muslim', 'Faisal', 'Model', 'Bahria', 'Nishtar']).' Town',
        'city'          => 'Lahore',
        'created_at'    => $faker->dateTimeBetween('-5 days', 'now', 'Asia/Karachi'),
        'updated_at'    => $faker->dateTimeBetween('-3 days', 'now', 'Asia/Karachi'),
    ];
});

$factory->define(App\Car::class, function (Faker\Generator $faker) {
    return [
        'type'      => $faker->randomElement(['Honda', 'Toyota', 'Suzuki', 'Daihatsu', 'Nissan', 'Adam']),
        'model'     => $faker->randomElement(['Accord', 'Civic', 'City', 'Vezel', 'Corolla', 'Mehran']),
        'picture'   => '',
        'status'    => 1,
    ];
});