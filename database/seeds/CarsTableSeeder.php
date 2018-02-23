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

        Car::create([
            'type'      => 'Honda',
            'model'     => 'Accord',
            'picture'   => '',
            'status'    => 1,
        ]);


        Car::create([
            'type'      => 'Honda',
            'model'     => 'Civic',
            'picture'   => '',
            'status'    => 1,
        ]);


        Car::create([
            'type'      => 'Honda',
            'model'     => 'City',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Honda',
            'model'     => 'Vezel',
            'picture'   => '',
            'status'    => 1,
        ]);
        Car::create([
            'type'      => 'Honda',
            'model'     => 'NWgn',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Honda',
            'model'     => 'NOne',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Honda',
            'model'     => 'Fit Hybrid',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Honda',
            'model'     => 'Life',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Honda',
            'model'     => 'Crossroad',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Honda',
            'model'     => 'BR-V',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Honda',
            'model'     => 'CR-V',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Honda',
            'model'     => 'Civic Hybrid',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Honda',
            'model'     => 'Insight',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Honda',
            'model'     => 'Zest',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Honda',
            'model'     => 'Airwave',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Honda',
            'model'     => 'Others',
            'picture'   => '',
            'status'    => 1,
        ]);


        Car::create([
            'type'      => 'Toyota',
            'model'     => 'Corolla',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Toyota',
            'model'     => 'Vitz',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Toyota',
            'model'     => 'Aqua',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Toyota',
            'model'     => 'Prius',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Toyota',
            'model'     => 'Passo',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Toyota',
            'model'     => 'Land Cruiser',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Toyota',
            'model'     => 'Prado',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Toyota',
            'model'     => 'Belta',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Toyota',
            'model'     => 'Aygo',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Toyota',
            'model'     => 'Corolla Fielder',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Toyota',
            'model'     => 'Crown',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Toyota',
            'model'     => 'Fortuner',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Toyota',
            'model'     => 'Hiace',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Toyota',
            'model'     => 'Mark X',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Toyota',
            'model'     => 'Rav4',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Toyota',
            'model'     => 'Ractis',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Toyota',
            'model'     => 'Auris',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Toyota',
            'model'     => 'Camry',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Toyota',
            'model'     => 'Corolla Axio',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Toyota',
            'model'     => 'Mark 2',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Toyota',
            'model'     => 'Surf',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Toyota',
            'model'     => 'IQ',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Toyota',
            'model'     => 'Rush',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Toyota',
            'model'     => 'Others',
            'picture'   => '',
            'status'    => 1,
        ]);


        Car::create([
            'type'      => 'Suzuki',
            'model'     => 'Mehran',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Suzuki',
            'model'     => 'Cultus',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Suzuki',
            'model'     => 'Alto',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Suzuki',
            'model'     => 'Wagon R',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Suzuki',
            'model'     => 'Bolan',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Suzuki',
            'model'     => 'APV',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Suzuki',
            'model'     => 'Ciaz',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Suzuki',
            'model'     => 'Hustler',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Suzuki',
            'model'     => 'Jimny',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Suzuki',
            'model'     => 'Kei',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Suzuki',
            'model'     => 'Potohar',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Suzuki',
            'model'     => 'Vitara',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Suzuki',
            'model'     => 'Ravi',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Suzuki',
            'model'     => 'Liana',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Suzuki',
            'model'     => 'Margalla',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Suzuki',
            'model'     => 'Baleno',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Suzuki',
            'model'     => 'Alto Eco',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Suzuki',
            'model'     => 'Every',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Suzuki',
            'model'     => 'Swift',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Suzuki',
            'model'     => 'Others',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Daihatsu',
            'model'     => 'Mira',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Daihatsu',
            'model'     => 'Cuore',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Daihatsu',
            'model'     => 'Move',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Daihatsu',
            'model'     => 'Hijet',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Daihatsu',
            'model'     => 'Charade',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Daihatsu',
            'model'     => 'Tanto',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Daihatsu',
            'model'     => 'Terios',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Daihatsu',
            'model'     => 'Terios Kid',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Daihatsu',
            'model'     => 'Copen',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Daihatsu',
            'model'     => 'Cast',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Daihatsu',
            'model'     => 'Bego',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Daihatsu',
            'model'     => 'Esse',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Daihatsu',
            'model'     => 'Others',
            'picture'   => '',
            'status'    => 1,
        ]);


        Car::create([
            'type'      => 'Nissan',
            'model'     => 'Dayz',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Nissan',
            'model'     => 'Sunny',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Nissan',
            'model'     => 'Clipper',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Nissan',
            'model'     => 'Dayz Highway',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Nissan',
            'model'     => 'Star',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Nissan',
            'model'     => 'Juke',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Nissan',
            'model'     => 'Patrol',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Adam',
            'model'     => 'Boltoro',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Adam',
            'model'     => 'Revo',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Adam',
            'model'     => 'Zabardast',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Adam',
            'model'     => 'Others',
            'picture'   => '',
            'status'    => 1,
        ]);


        Car::create([
            'type'      => 'Audi',
            'model'     => 'A4',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Audi',
            'model'     => 'A5',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Audi',
            'model'     => 'A6',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Audi',
            'model'     => 'A3',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Audi',
            'model'     => 'Others',
            'picture'   => '',
            'status'    => 1,
        ]);


        Car::create([
            'type'      => 'Austin',
            'model'     => '10',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Austin',
            'model'     => 'Fx4',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Austin',
            'model'     => 'Maxi',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Austin',
            'model'     => 'Mini',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Austin',
            'model'     => 'Others',
            'picture'   => '',
            'status'    => 1,
        ]);


        Car::create([
            'type'      => 'Bentley',
            'model'     => 'Continental Gt',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Bentley',
            'model'     => 'Others',
            'picture'   => '',
            'status'    => 1,
        ]);


        Car::create([
            'type'      => 'BMW',
            'model'     => '1 Series',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'BMW',
            'model'     => '5 Series',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'BMW',
            'model'     => '7 Series',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'BMW',
            'model'     => '3 Series',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'BMW',
            'model'     => 'X5 Series',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'BMW',
            'model'     => 'X1',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'BMW',
            'model'     => 'Others',
            'picture'   => '',
            'status'    => 1,
        ]);


        Car::create([
            'type'      => 'Buick',
            'model'     => 'Century',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Buick',
            'model'     => 'Lesabre',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Buick',
            'model'     => 'Regal',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Buick',
            'model'     => 'Road Master',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Buick',
            'model'     => 'Special',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Buick',
            'model'     => 'Others',
            'picture'   => '',
            'status'    => 1,
        ]);


        Car::create([
            'type'      => 'Cadillac',
            'model'     => 'Cts Escalade',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Cadillac',
            'model'     => 'Ext',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Cadillac',
            'model'     => 'Fleetwood',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Cadillac',
            'model'     => 'Others',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Alfa Romeo',
            'model'     => 'Guilietta',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Alfa Romeo',
            'model'     => 'Mitto',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Alfa Romeo',
            'model'     => 'Others',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Changan',
            'model'     => 'Kalash',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Changan',
            'model'     => 'Chitral',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Changan',
            'model'     => 'Kaghan xL',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Changan',
            'model'     => 'Kalam',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Changan',
            'model'     => 'Gilgit',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Changan',
            'model'     => 'Shahanshah',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Changan',
            'model'     => 'Others',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Cherry',
            'model'     => 'QQ',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Cherry',
            'model'     => 'Others',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Chevrolet',
            'model'     => 'Joy',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Chevrolet',
            'model'     => 'Exclusive',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Chevrolet',
            'model'     => 'Optra',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Chevrolet',
            'model'     => 'Aveo',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Chevrolet',
            'model'     => 'Matiz',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Chevrolet',
            'model'     => 'Others',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Chrysler',
            'model'     => '300C',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Chrysler',
            'model'     => 'Plymouth',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Chrysler',
            'model'     => 'Voyager',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Chrysler',
            'model'     => 'Pt Cruiser',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Chrysler',
            'model'     => 'Others',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Citreon',
            'model'     => 'Others',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Daewoo',
            'model'     => 'Racer',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Daewoo',
            'model'     => 'Cielo',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Daewoo',
            'model'     => 'Matiz',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Daewoo',
            'model'     => 'Others',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Daimler',
            'model'     => 'Xj6',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Daimler',
            'model'     => 'Others',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Datsun',
            'model'     => '120Y',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Datsun',
            'model'     => '1000',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Datsun',
            'model'     => 'Cherry',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Datsun',
            'model'     => 'Others',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'DFSK',
            'model'     => 'Rustom',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'DFSK',
            'model'     => 'C37',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'DFSK',
            'model'     => 'Convoy',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'DFSK',
            'model'     => 'Shahbaz',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'DFSK',
            'model'     => 'Others',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Dodge',
            'model'     => 'Brothers',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Dodge',
            'model'     => 'Dart',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Dodge',
            'model'     => 'Nitro',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Dodge',
            'model'     => 'Ram',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Dodge',
            'model'     => 'Others',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'FAW',
            'model'     => 'X-PV',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'FAW',
            'model'     => 'V2',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'FAW',
            'model'     => 'Carrier',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'FAW',
            'model'     => 'Sirius',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'FAW',
            'model'     => 'Others',
            'picture'   => '',
            'status'    => 1,
        ]);



        Car::create([
            'type'      => 'Ferrari',
            'model'     => 'Others',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Fiat',
            'model'     => '1100',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Fiat',
            'model'     => '124',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Fiat',
            'model'     => '126',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Fiat',
            'model'     => 'Iveco',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Fiat',
            'model'     => 'Punto',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Fiat',
            'model'     => 'EVO',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Fiat',
            'model'     => 'Uno',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Fiat',
            'model'     => 'Others',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Ford',
            'model'     => 'Mutt M 825',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Ford',
            'model'     => 'Ranger',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Ford',
            'model'     => 'Escort',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Ford',
            'model'     => 'Others',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Geely',
            'model'     => 'Ck',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Geely',
            'model'     => 'Others',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'GMC',
            'model'     => 'Others',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Golden Dragon',
            'model'     => 'Xml6532',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Golden Dragon',
            'model'     => 'Others',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Golf',
            'model'     => 'Convertible',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Golf',
            'model'     => 'Others',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Hillman',
            'model'     => 'Avenger',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Hillman',
            'model'     => 'Others',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Hino',
            'model'     => 'Other',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Hummer',
            'model'     => 'H1',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Hummer',
            'model'     => 'H2',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Hummer',
            'model'     => 'H3',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Hummer',
            'model'     => 'Others',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Hyundai',
            'model'     => 'Santro',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Hyundai',
            'model'     => 'Excel',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Hyundai',
            'model'     => 'Shehzore',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Hyundai',
            'model'     => 'Coupe',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Hyundai',
            'model'     => 'Terracan',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Hyundai',
            'model'     => 'Others',
            'picture'   => '',
            'status'    => 1,
        ]);


        Car::create([
            'type'      => 'Isuzu',
            'model'     => 'Como',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Isuzu',
            'model'     => 'Rodeo',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Isuzu',
            'model'     => 'Trooper',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Isuzu',
            'model'     => 'Others',
            'picture'   => '',
            'status'    => 1,
        ]);


        Car::create([
            'type'      => 'JAC',
            'model'     => 'X200',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'JAC',
            'model'     => 'Others',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Jaguar',
            'model'     => 'S Type',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Jaguar',
            'model'     => 'XF',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Jaguar',
            'model'     => 'Xj6',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Jaguar',
            'model'     => 'Xjs',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Jaguar',
            'model'     => 'Others',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Jeep',
            'model'     => 'CJ5',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Jeep',
            'model'     => 'M 151',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Jeep',
            'model'     => 'CJ 7',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Jeep',
            'model'     => 'Cherokee',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Jeep',
            'model'     => 'Others',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Kaiser Jeep',
            'model'     => 'M715',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Kaiser Jeep',
            'model'     => 'Others',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'KIA',
            'model'     => 'Classic',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'KIA',
            'model'     => 'Sportage',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'KIA',
            'model'     => 'Spectra',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'KIA',
            'model'     => 'Pride',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'KIA',
            'model'     => 'Others',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Lada',
            'model'     => 'Riva',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Lada',
            'model'     => 'Others',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Lamborghini',
            'model'     => 'Aventador',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Lamborghini',
            'model'     => 'Cabrera',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Lamborghini',
            'model'     => 'Countach',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Lamborghini',
            'model'     => 'Diablo',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Lamborghini',
            'model'     => 'Espada',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Lamborghini',
            'model'     => 'Estoque',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Lamborghini',
            'model'     => 'Others',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Land Rover',
            'model'     => 'Defender',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Land Rover',
            'model'     => 'Discovery',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Land Rover',
            'model'     => 'Freelander',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Land Rover',
            'model'     => 'Others',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Lexus',
            'model'     => 'RX Series',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Lexus',
            'model'     => 'CT200h',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Lexus',
            'model'     => 'LX Series',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Lexus',
            'model'     => 'LS Series',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Lexus',
            'model'     => 'SC 430',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Lexus',
            'model'     => 'Others',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Lincoln',
            'model'     => 'Other',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Maserati',
            'model'     => 'Gran Turismo',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Maserati',
            'model'     => 'Quattroporte',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Maserati',
            'model'     => 'Others',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Master',
            'model'     => 'Rocket',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Master',
            'model'     => 'Others',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Mazda',
            'model'     => 'Scrum',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Mazda',
            'model'     => 'Carol',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Mazda',
            'model'     => 'RX8',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Mazda',
            'model'     => 'Flair',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Mazda',
            'model'     => 'Carol Eco',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Mazda',
            'model'     => 'Others',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Mercedes Benz',
            'model'     => 'C Class',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Mercedes Benz',
            'model'     => 'E Class',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Mercedes Benz',
            'model'     => 'S Class',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Mercedes Benz',
            'model'     => 'E series',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Mercedes Benz',
            'model'     => 'CLA Class',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Mercedes Benz',
            'model'     => 'Others',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'MG',
            'model'     => 'Midget',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'MG',
            'model'     => 'Others',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'MINI',
            'model'     => 'Cooper',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'MINI',
            'model'     => 'Others',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Mitsubishi',
            'model'     => 'EK Wagon',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Mitsubishi',
            'model'     => 'Lancer',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Mitsubishi',
            'model'     => 'Pajero',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Mitsubishi',
            'model'     => 'Mirage',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Mitsubishi',
            'model'     => 'Minicab',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Mitsubishi',
            'model'     => 'Bravo',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Mitsubishi',
            'model'     => 'Galant',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Mitsubishi',
            'model'     => 'Pajero Mini',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Mitsubishi',
            'model'     => 'Others',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Morris',
            'model'     => 'Mini Minor',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Morris',
            'model'     => 'Oxford',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Morris',
            'model'     => 'Others',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Oldsmobile',
            'model'     => '442',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Oldsmobile',
            'model'     => 'Ninety Eight',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Oldsmobile',
            'model'     => 'Others',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Opel',
            'model'     => 'Corsa',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Opel',
            'model'     => 'Kadet',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Opel',
            'model'     => 'Rekord',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Opel',
            'model'     => 'Others',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Peugot',
            'model'     => '205',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Peugot',
            'model'     => '309',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Peugot',
            'model'     => 'Saga',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Peugot',
            'model'     => 'Others',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Plymouth',
            'model'     => 'Duster',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Plymouth',
            'model'     => 'Valiant',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Plymouth',
            'model'     => 'Others',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Pontiac',
            'model'     => 'Bonneville',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Plymouth',
            'model'     => 'Catalina',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Plymouth',
            'model'     => 'Le Mans',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Plymouth',
            'model'     => 'Transam',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Plymouth',
            'model'     => 'Others',
            'picture'   => '',
            'status'    => 1,
        ]);


        Car::create([
            'type'      => 'Porsche',
            'model'     => 'Cayenne',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Porsche',
            'model'     => 'Panamera',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Porsche',
            'model'     => '911',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Porsche',
            'model'     => 'Boxster',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Porsche',
            'model'     => 'Others',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Proton',
            'model'     => 'Gen 2',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Proton',
            'model'     => 'Saga',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Proton',
            'model'     => 'Others',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Range Rover',
            'model'     => 'Sport',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Range Rover',
            'model'     => 'Vogue',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Range Rover',
            'model'     => 'Se 4.0',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Range Rover',
            'model'     => 'Others',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Renault',
            'model'     => 'Others',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Rolls Royce',
            'model'     => 'Others',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Roma',
            'model'     => 'Family Van',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Roma',
            'model'     => 'Family Van Deluxe',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Roma',
            'model'     => 'Mini Truck',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Roma',
            'model'     => 'Others',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Rover',
            'model'     => 'Metro',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Rover',
            'model'     => 'Others',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Royal Enfield',
            'model'     => 'Others',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Saab',
            'model'     => 'Others',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Scion',
            'model'     => 'TC',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Scion',
            'model'     => 'XA',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Scion',
            'model'     => 'XB',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Scion',
            'model'     => 'Others',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Skoda',
            'model'     => 'Others',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Smart',
            'model'     => 'Others',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Sogo',
            'model'     => 'Double Cabin',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Sogo',
            'model'     => 'Family Van',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Sogo',
            'model'     => 'Pick up',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Sogo',
            'model'     => 'Others',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Sokon',
            'model'     => 'Mpv',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Sokon',
            'model'     => 'Others',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Ssang Yong',
            'model'     => 'Chairman',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Ssang Yong',
            'model'     => 'Korando',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Ssang Yong',
            'model'     => 'Musso',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Ssang Yong',
            'model'     => 'Rexton',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Ssang Yong',
            'model'     => 'Stavic',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Ssang Yong',
            'model'     => 'Others',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Subaru',
            'model'     => 'Pleo',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Subaru',
            'model'     => 'Stella',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Subaru',
            'model'     => 'Sambar',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Subaru',
            'model'     => 'R2',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Subaru',
            'model'     => 'Others',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Triumph',
            'model'     => 'Herald',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Triumph',
            'model'     => 'Spitfire',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Triumph',
            'model'     => 'Others',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Vauxhall',
            'model'     => 'Others',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Volkswagen',
            'model'     => 'Beetle',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Volkswagen',
            'model'     => 'Up',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Volkswagen',
            'model'     => 'Polo',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Volkswagen',
            'model'     => 'Double Cabin Amarok',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Volkswagen',
            'model'     => 'Others',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Volvo',
            'model'     => 'S40',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Volvo',
            'model'     => 'S90',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Volvo',
            'model'     => 'V40',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Volvo',
            'model'     => 'Others',
            'picture'   => '',
            'status'    => 1,
        ]);

        Car::create([
            'type'      => 'Willys',
            'model'     => 'Others',
            'picture'   => '',
            'status'    => 1,
        ]);

        Model::reguard();
    }
}
