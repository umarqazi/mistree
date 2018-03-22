<?php

use App\Car;
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
            'make'      => 'Honda',
            'model'     => 'Accord',
            'picture'   => '',
            'category_id' => '3',
        ]);


        Car::create([
            'make'      => 'Honda',
            'model'     => 'Civic',
            'picture'   => '',
            'category_id' => '2',
        ]);


        Car::create([
            'make'      => 'Honda',
            'model'     => 'City',
            'picture'   => '',
            'category_id' => '2',
        ]);

        Car::create([
            'make'      => 'Honda',
            'model'     => 'Vezel',
            'picture'   => '',
            'category_id' => '4',
        ]);
        Car::create([
            'make'      => 'Honda',
            'model'     => 'NWgn',
            'picture'   => '',
            'category_id' => '1',
        ]);


        Car::create([
            'make'      => 'Honda',
            'model'     => 'Fit Hybrid',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Honda',
            'model'     => 'Life',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Honda',
            'model'     => 'Crossroad',
            'picture'   => '',
            'category_id' => '4',
        ]);

        Car::create([
            'make'      => 'Honda',
            'model'     => 'BR-V',
            'picture'   => '',
            'category_id' => '4',
        ]);

        Car::create([
            'make'      => 'Honda',
            'model'     => 'CR-V',
            'picture'   => '',
            'category_id' => '4',
        ]);



        Car::create([
            'make'      => 'Honda',
            'model'     => 'Others',
            'picture'   => '',
            'category_id' => '1',
        ]);


        Car::create([
            'make'      => 'Toyota',
            'model'     => 'Corolla',
            'picture'   => '',
            'category_id' => '2',
        ]);

        Car::create([
            'make'      => 'Toyota',
            'model'     => 'Vitz',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Toyota',
            'model'     => 'Aqua',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Toyota',
            'model'     => 'Prius',
            'picture'   => '',
            'category_id' => '2',
        ]);

        Car::create([
            'make'      => 'Toyota',
            'model'     => 'Passo',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Toyota',
            'model'     => 'Land Cruiser',
            'picture'   => '',
            'category_id' => '4',
        ]);

        Car::create([
            'make'      => 'Toyota',
            'model'     => 'Prado',
            'picture'   => '',
            'category_id' => '4',
        ]);


        Car::create([
            'make'      => 'Toyota',
            'model'     => 'Crown',
            'picture'   => '',
            'category_id' => '3',
        ]);


        Car::create([
            'make'      => 'Toyota',
            'model'     => 'Mark X',
            'picture'   => '',
            'category_id' => '3',
        ]);



        Car::create([
            'make'      => 'Toyota',
            'model'     => 'Camry',
            'picture'   => '',
            'category_id' => '3',
        ]);

        Car::create([
            'make'      => 'Toyota',
            'model'     => 'Others',
            'picture'   => '',
            'category_id' => '1',
        ]);


        Car::create([
            'make'      => 'Suzuki',
            'model'     => 'Mehran',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Suzuki',
            'model'     => 'Cultus',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Suzuki',
            'model'     => 'Alto',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Suzuki',
            'model'     => 'Wagon R',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Suzuki',
            'model'     => 'Bolan',
            'picture'   => '',
            'category_id' => '1',
        ]);



        Car::create([
            'make'      => 'Suzuki',
            'model'     => 'Others',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Daihatsu',
            'model'     => 'Mira',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Daihatsu',
            'model'     => 'Cuore',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Daihatsu',
            'model'     => 'Move',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Daihatsu',
            'model'     => 'Hijet',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Daihatsu',
            'model'     => 'Charade',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Daihatsu',
            'model'     => 'Others',
            'picture'   => '',
            'category_id' => '1',
        ]);


        Car::create([
            'make'      => 'Nissan',
            'model'     => 'Dayz',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Nissan',
            'model'     => 'Sunny',
            'picture'   => '',
            'category_id' => '2',
        ]);

        Car::create([
            'make'      => 'Nissan',
            'model'     => 'Clipper',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Nissan',
            'model'     => 'Dayz Highway Star',
            'picture'   => '',
            'category_id' => '1',
        ]);



        Car::create([
            'make'      => 'Nissan',
            'model'     => 'Juke',
            'picture'   => '',
            'category_id' => '4',
        ]);

        Car::create([
            'make'      => 'Adam',
            'model'     => 'Boltoro',
            'picture'   => '',
            'category_id' => '4',
        ]);

        Car::create([
            'make'      => 'Adam',
            'model'     => 'Revo',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Adam',
            'model'     => 'Zabardast',
            'picture'   => '',
            'category_id' => '4',
        ]);

        Car::create([
            'make'      => 'Adam',
            'model'     => 'Others',
            'picture'   => '',
            'category_id' => '1',
        ]);


        Car::create([
            'make'      => 'Audi',
            'model'     => 'A4',
            'picture'   => '',
            'category_id' => '3',
        ]);

        Car::create([
            'make'      => 'Audi',
            'model'     => 'A5',
            'picture'   => '',
            'category_id' => '3',
        ]);

        Car::create([
            'make'      => 'Audi',
            'model'     => 'A6',
            'picture'   => '',
            'category_id' => '3',
        ]);

        Car::create([
            'make'      => 'Audi',
            'model'     => 'A3',
            'picture'   => '',
            'category_id' => '3',
        ]);

        Car::create([
            'make'      => 'Audi',
            'model'     => 'Others',
            'picture'   => '',
            'category_id' => '3',
        ]);


        Car::create([
            'make'      => 'Bentley',
            'model'     => 'Continental Gt',
            'picture'   => '',
            'category_id' => '3',
        ]);

        Car::create([
            'make'      => 'Bentley',
            'model'     => 'Others',
            'picture'   => '',
            'category_id' => '3',
        ]);

        Car::create([
            'make'      => 'Bentley',
            'model'     => 'Coupe',
            'picture'   => '',
            'category_id' => '3',
        ]);


        Car::create([
            'make'      => 'BMW',
            'model'     => '5 Series',
            'picture'   => '',
            'category_id' => '3',
        ]);

        Car::create([
            'make'      => 'BMW',
            'model'     => '7 Series',
            'picture'   => '',
            'category_id' => '3',
        ]);

        Car::create([
            'make'      => 'BMW',
            'model'     => '3 Series',
            'picture'   => '',
            'category_id' => '3',
        ]);

        Car::create([
            'make'      => 'BMW',
            'model'     => 'X5 Series',
            'picture'   => '',
            'category_id' => '4',
        ]);

        Car::create([
            'make'      => 'BMW',
            'model'     => 'X1',
            'picture'   => '',
            'category_id' => '4',



        ]);

        Car::create([
            'make'      => 'BMW',
            'model'     => 'Others',
            'picture'   => '',
            'category_id' => '3',
        ]);


        Car::create([
            'make'      => 'Buick',
            'model'     => 'Regal',
            'picture'   => '',
            'category_id' => '3',
        ]);

        Car::create([
            'make'      => 'Buick',
            'model'     => 'Others',
            'picture'   => '',
            'category_id' => '3',
        ]);


        Car::create([
            'make'      => 'Cadillac',
            'model'     => 'Cts Escalade',
            'picture'   => '',
            'category_id' => '3',
        ]);

        Car::create([
            'make'      => 'Cadillac',
            'model'     => 'Ext',
            'picture'   => '',
            'category_id' => '4',
        ]);

        Car::create([
            'make'      => 'Cadillac',
            'model'     => 'Fleetwood',
            'picture'   => '',
            'category_id' => '3',
        ]);

        Car::create([
            'make'      => 'Cadillac',
            'model'     => 'Others',
            'picture'   => '',
            'category_id' => '3',
        ]);

        Car::create([
            'make'      => 'Alfa Romeo',
            'model'     => 'Guilietta',
            'picture'   => '',
            'category_id' => '3',
        ]);

        Car::create([
            'make'      => 'Alfa Romeo',
            'model'     => 'Mitto',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Alfa Romeo',
            'model'     => 'Others',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Changan',
            'model'     => 'Kalash',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Changan',
            'model'     => 'Chitral',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Changan',
            'model'     => 'Kaghan xL',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Changan',
            'model'     => 'Kalam',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Changan',
            'model'     => 'Gilgit',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Changan',
            'model'     => 'Shahanshah',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Changan',
            'model'     => 'Others',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Cherry',
            'model'     => 'QQ',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Cherry',
            'model'     => 'Others',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Chevrolet',
            'model'     => 'Joy',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Chevrolet',
            'model'     => 'Exclusive',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Chevrolet',
            'model'     => 'Optra',
            'picture'   => '',
            'category_id' => '2',
        ]);

        Car::create([
            'make'      => 'Chevrolet',
            'model'     => 'Aveo',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Chevrolet',
            'model'     => 'Matiz',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Chevrolet',
            'model'     => 'Others',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Chrysler',
            'model'     => 'Plymouth Voyager',
            'picture'   => '',
            'category_id' => '3',
        ]);

        Car::create([
            'make'      => 'Chrysler',
            'model'     => 'Others',
            'picture'   => '',
            'category_id' => '3',
        ]);

        Car::create([
            'make'      => 'Citreon',
            'model'     => 'Others',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Daewoo',
            'model'     => 'Racer',
            'picture'   => '',
            'category_id' => '2',
        ]);

        Car::create([
            'make'      => 'Daewoo',
            'model'     => 'Cielo',
            'picture'   => '',
            'category_id' => '2',
        ]);

        Car::create([
            'make'      => 'Daewoo',
            'model'     => 'Matiz',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Daewoo',
            'model'     => 'Others',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Datsun',
            'model'     => '120Y',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Datsun',
            'model'     => '1000',
            'picture'   => '',
            'category_id' => '1',
        ]);


        Car::create([
            'make'      => 'Datsun',
            'model'     => 'Others',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'DFSK',
            'model'     => 'Rustom',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'DFSK',
            'model'     => 'C37',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'DFSK',
            'model'     => 'Convoy',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'DFSK',
            'model'     => 'Shahbaz',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'DFSK',
            'model'     => 'Others',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Dodge',
            'model'     => 'Brothers',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Dodge',
            'model'     => 'Dart',
            'picture'   => '',
            'category_id' => '3',
        ]);

        Car::create([
            'make'      => 'Dodge',
            'model'     => 'Nitro',
            'picture'   => '',
            'category_id' => '4',
        ]);

        Car::create([
            'make'      => 'Dodge',
            'model'     => 'Ram',
            'picture'   => '',
            'category_id' => '4',
        ]);

        Car::create([
            'make'      => 'Dodge',
            'model'     => 'Others',
            'picture'   => '',
            'category_id' => '4',
        ]);

        Car::create([
            'make'      => 'FAW',
            'model'     => 'X-PV',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'FAW',
            'model'     => 'V2',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'FAW',
            'model'     => 'Carrier',
            'picture'   => '',
            'category_id' => '1',
        ]);


        Car::create([
            'make'      => 'FAW',
            'model'     => 'Others',
            'picture'   => '',
            'category_id' => '1',
        ]);



        Car::create([
            'make'      => 'Ferrari',
            'model'     => 'Others',
            'picture'   => '',
            'category_id' => '3',
        ]);


        Car::create([
            'make'      => 'Fiat',
            'model'     => '124',
            'picture'   => '',
            'category_id' => '3',
        ]);

        Car::create([
            'make'      => 'Fiat',
            'model'     => 'Punto EVO',
            'picture'   => '',
            'category_id' => '1',
        ]);


        Car::create([
            'make'      => 'Fiat',
            'model'     => 'Uno',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Fiat',
            'model'     => 'Others',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Ford',
            'model'     => 'Mutt M 825',
            'picture'   => '',
            'category_id' => '4',
        ]);

        Car::create([
            'make'      => 'Ford',
            'model'     => 'Ranger',
            'picture'   => '',
            'category_id' => '4',
        ]);


        Car::create([
            'make'      => 'Ford',
            'model'     => 'Others',
            'picture'   => '',
            'category_id' => '3',
        ]);

        Car::create([
            'make'      => 'Geely',
            'model'     => 'Ck',
            'picture'   => '',
            'category_id' => '2',
        ]);

        Car::create([
            'make'      => 'Geely',
            'model'     => 'Others',
            'picture'   => '',
            'category_id' => '2',
        ]);

        Car::create([
            'make'      => 'GMC',
            'model'     => 'Others',
            'picture'   => '',
            'category_id' => '4',
        ]);


        Car::create([
            'make'      => 'Golf',
            'model'     => 'Convertible',
            'picture'   => '',
            'category_id' => '3',
        ]);

        Car::create([
            'make'      => 'Golf',
            'model'     => 'Others',
            'picture'   => '',
            'category_id' => '3',
        ]);


        Car::create([
            'make'      => 'Hillman',
            'model'     => 'Others',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Hummer',
            'model'     => 'H1',
            'picture'   => '',
            'category_id' => '4',
        ]);

        Car::create([
            'make'      => 'Hummer',
            'model'     => 'H2',
            'picture'   => '',
            'category_id' => '4',
        ]);

        Car::create([
            'make'      => 'Hummer',
            'model'     => 'H3',
            'picture'   => '',
            'category_id' => '4',
        ]);

        Car::create([
            'make'      => 'Hummer',
            'model'     => 'Others',
            'picture'   => '',
            'category_id' => '4',
        ]);

        Car::create([
            'make'      => 'Hyundai',
            'model'     => 'Santro',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Hyundai',
            'model'     => 'Shehzore',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Hyundai',
            'model'     => 'Coupe',
            'picture'   => '',
            'category_id' => '2',
        ]);

        Car::create([
            'make'      => 'Hyundai',
            'model'     => 'Terracan',
            'picture'   => '',
            'category_id' => '4',
        ]);
        Car::create([
            'make'      => 'Hyundai',
            'model'     => 'Tucson',
            'picture'   => '',
            'category_id' => '4',
        ]);


        Car::create([
            'make'      => 'Hyundai',
            'model'     => 'Others',
            'picture'   => '',
            'category_id' => '1',
        ]);


        Car::create([
            'make'      => 'Isuzu',
            'model'     => 'Como',
            'picture'   => '',
            'category_id' => '4',
        ]);

        Car::create([
            'make'      => 'Isuzu',
            'model'     => 'Rodeo',
            'picture'   => '',
            'category_id' => '4',
        ]);

        Car::create([
            'make'      => 'Isuzu',
            'model'     => 'Trooper',
            'picture'   => '',
            'category_id' => '4',
        ]);

        Car::create([
            'make'      => 'Isuzu',
            'model'     => 'Others',
            'picture'   => '',
            'category_id' => '4',
        ]);



        Car::create([
            'make'      => 'Jaguar',
            'model'     => 'S Type',
            'picture'   => '',
            'category_id' => '3',
        ]);

        Car::create([
            'make'      => 'Jaguar',
            'model'     => 'XF',
            'picture'   => '',
            'category_id' => '3',
        ]);

        Car::create([
            'make'      => 'Jaguar',
            'model'     => 'Xj6',
            'picture'   => '',
            'category_id' => '3',
        ]);

        Car::create([
            'make'      => 'Jaguar',
            'model'     => 'Xjs',
            'picture'   => '',
            'category_id' => '3',
        ]);

        Car::create([
            'make'      => 'Jaguar',
            'model'     => 'Others',
            'picture'   => '',
            'category_id' => '3',
        ]);

        Car::create([
            'make'      => 'Jeep',
            'model'     => 'CJ5',
            'picture'   => '',
            'category_id' => '4',
        ]);

        Car::create([
            'make'      => 'Jeep',
            'model'     => 'M 151',
            'picture'   => '',
            'category_id' => '4',
        ]);

        Car::create([
            'make'      => 'Jeep',
            'model'     => 'CJ 7',
            'picture'   => '',
            'category_id' => '4',
        ]);

        Car::create([
            'make'      => 'Jeep',
            'model'     => 'Cherokee',
            'picture'   => '',
            'category_id' => '4',
        ]);

        Car::create([
            'make'      => 'Jeep',
            'model'     => 'Others',
            'picture'   => '',
            'category_id' => '4',
        ]);

        Car::create([
            'make'      => 'Kaiser Jeep',
            'model'     => 'M715',
            'picture'   => '',
            'category_id' => '4',
        ]);

        Car::create([
            'make'      => 'Kaiser Jeep',
            'model'     => 'Others',
            'picture'   => '',
            'category_id' => '4',
        ]);

        Car::create([
            'make'      => 'KIA',
            'model'     => 'Classic',
            'picture'   => '',
            'category_id' => '2',
        ]);

        Car::create([
            'make'      => 'KIA',
            'model'     => 'Sportage',
            'picture'   => '',
            'category_id' => '4',
        ]);

        Car::create([
            'make'      => 'KIA',
            'model'     => 'Spectra',
            'picture'   => '',
            'category_id' => '2',
        ]);

        Car::create([
            'make'      => 'KIA',
            'model'     => 'Pride',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'KIA',
            'model'     => 'Others',
            'picture'   => '',
            'category_id' => '2',
        ]);

        Car::create([
            'make'      => 'Lamborghini',
            'model'     => 'Aventador',
            'picture'   => '',
            'category_id' => '3',
        ]);

        Car::create([
            'make'      => 'Lamborghini',
            'model'     => 'Cabrera',
            'picture'   => '',
            'category_id' => '3',
        ]);

        Car::create([
            'make'      => 'Lamborghini',
            'model'     => 'Countach',
            'picture'   => '',
            'category_id' => '3',
        ]);

        Car::create([
            'make'      => 'Lamborghini',
            'model'     => 'Diablo',
            'picture'   => '',
            'category_id' => '3',
        ]);

        Car::create([
            'make'      => 'Lamborghini',
            'model'     => 'Espada',
            'picture'   => '',
            'category_id' => '3',
        ]);

        Car::create([
            'make'      => 'Lamborghini',
            'model'     => 'Estoque',
            'picture'   => '',
            'category_id' => '3',
        ]);

        Car::create([
            'make'      => 'Lamborghini',
            'model'     => 'Others',
            'picture'   => '',
            'category_id' => '3',
        ]);

        Car::create([
            'make'      => 'Land Rover',
            'model'     => 'Defender',
            'picture'   => '',
            'category_id' => '4',
        ]);

        Car::create([
            'make'      => 'Land Rover',
            'model'     => 'Discovery',
            'picture'   => '',
            'category_id' => '4',
        ]);

        Car::create([
            'make'      => 'Land Rover',
            'model'     => 'Freelander',
            'picture'   => '',
            'category_id' => '4',
        ]);

        Car::create([
            'make'      => 'Land Rover',
            'model'     => 'Others',
            'picture'   => '',
            'category_id' => '4',
        ]);

        Car::create([
            'make'      => 'Lexus',
            'model'     => 'RX Series',
            'picture'   => '',
            'category_id' => '4',
        ]);

        Car::create([
            'make'      => 'Lexus',
            'model'     => 'CT200h',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Lexus',
            'model'     => 'LX Series',
            'picture'   => '',
            'category_id' => '4',
        ]);

        Car::create([
            'make'      => 'Lexus',
            'model'     => 'LS Series',
            'picture'   => '',
            'category_id' => '3',
        ]);

        Car::create([
            'make'      => 'Lexus',
            'model'     => 'SC 430',
            'picture'   => '',
            'category_id' => '3',
        ]);

        Car::create([
            'make'      => 'Lexus',
            'model'     => 'Others',
            'picture'   => '',
            'category_id' => '3',
        ]);

        Car::create([
            'make'      => 'Lincoln',
            'model'     => 'Other',
            'picture'   => '',
            'category_id' => '3',
        ]);

        Car::create([
            'make'      => 'Maserati',
            'model'     => 'Gran Turismo',
            'picture'   => '',
            'category_id' => '3',
        ]);

        Car::create([
            'make'      => 'Maserati',
            'model'     => 'Quattroporte',
            'picture'   => '',
            'category_id' => '3',
        ]);

        Car::create([
            'make'      => 'Maserati',
            'model'     => 'Others',
            'picture'   => '',
            'category_id' => '3',
        ]);

        Car::create([
            'make'      => 'Mazda',
            'model'     => 'Scrum',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Mazda',
            'model'     => 'Carol',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Mazda',
            'model'     => 'RX8',
            'picture'   => '',
            'category_id' => '3',
        ]);

        Car::create([
            'make'      => 'Mazda',
            'model'     => 'Flair',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Mazda',
            'model'     => 'Carol Eco',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Mazda',
            'model'     => 'Others',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Mercedes Benz',
            'model'     => 'C Class',
            'picture'   => '',
            'category_id' => '1',
            'category_id' => '3',
        ]);

        Car::create([
            'make'      => 'Mercedes Benz',
            'model'     => 'E Class',
            'picture'   => '',
            'category_id' => '3',
        ]);

        Car::create([
            'make'      => 'Mercedes Benz',
            'model'     => 'S Class',
            'picture'   => '',
            'category_id' => '3',
        ]);

        Car::create([
            'make'      => 'Mercedes Benz',
            'model'     => 'E series',
            'picture'   => '',
            'category_id' => '3',
        ]);

        Car::create([
            'make'      => 'Mercedes Benz',
            'model'     => 'CLA Class',
            'picture'   => '',
            'category_id' => '3',
        ]);

        Car::create([
            'make'      => 'Mercedes Benz',
            'model'     => 'Others',
            'picture'   => '',
            'category_id' => '3',
        ]);

        Car::create([
            'make'      => 'Mitsubishi',
            'model'     => 'EK Wagon',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Mitsubishi',
            'model'     => 'Lancer',
            'picture'   => '',
            'category_id' => '2',
        ]);

        Car::create([
            'make'      => 'Mitsubishi',
            'model'     => 'Pajero',
            'picture'   => '',
            'category_id' => '4',
        ]);

        Car::create([
            'make'      => 'Mitsubishi',
            'model'     => 'Mirage',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Mitsubishi',
            'model'     => 'Minicab Bravo',
            'picture'   => '',
            'category_id' => '1',
        ]);



        Car::create([
            'make'      => 'Mitsubishi',
            'model'     => 'Others',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Morris',
            'model'     => 'Mini Minor',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Morris',
            'model'     => 'Oxford',
            'picture'   => '',
            'category_id' => '1',

        ]);

        Car::create([
            'make'      => 'Morris',
            'model'     => 'Others',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Oldsmobile',
            'model'     => '442',
            'picture'   => '',
            'category_id' => '3',
        ]);

        Car::create([
            'make'      => 'Oldsmobile',
            'model'     => 'Ninety Eight',
            'picture'   => '',
            'category_id' => '3',
        ]);

        Car::create([
            'make'      => 'Oldsmobile',
            'model'     => 'Others',
            'picture'   => '',
            'category_id' => '3',
        ]);

        Car::create([
            'make'      => 'Opel',
            'model'     => 'Corsa',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Opel',
            'model'     => 'Rekord',
            'picture'   => '',
            'category_id' => '2',
        ]);

        Car::create([
            'make'      => 'Opel',
            'model'     => 'Others',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Peugot',
            'model'     => '205',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Peugot',
            'model'     => '309',
            'picture'   => '',
            'category_id' => '2',
        ]);

        Car::create([
            'make'      => 'Peugot',
            'model'     => 'Saga',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Peugot',
            'model'     => 'Others',
            'picture'   => '',
            'category_id' => '1',
        ]);


        Car::create([
            'make'      => 'Pontiac',
            'model'     => 'Bonneville',
            'picture'   => '',
            'category_id' => '2',
        ]);

        Car::create([
            'make'      => 'Porsche',
            'model'     => 'Cayenne',
            'picture'   => '',
            'category_id' => '4',
        ]);

        Car::create([
            'make'      => 'Porsche',
            'model'     => 'Panamera',
            'picture'   => '',
            'category_id' => '3',
        ]);

        Car::create([
            'make'      => 'Porsche',
            'model'     => '911',
            'picture'   => '',
            'category_id' => '3',
        ]);

        Car::create([
            'make'      => 'Porsche',
            'model'     => 'Boxster',
            'picture'   => '',
            'category_id' => '3',
        ]);

        Car::create([
            'make'      => 'Porsche',
            'model'     => 'Others',
            'picture'   => '',
            'category_id' => '3',
        ]);

        Car::create([
            'make'      => 'Proton',
            'model'     => 'Gen 2',
            'picture'   => '',
            'category_id' => '2',
        ]);

        Car::create([
            'make'      => 'Proton',
            'model'     => 'Saga',
            'picture'   => '',
            'category_id' => '2',
        ]);

        Car::create([
            'make'      => 'Proton',
            'model'     => 'Others',
            'picture'   => '',
            'category_id' => '2',
        ]);

        Car::create([
            'make'      => 'Range Rover',
            'model'     => 'Sport',
            'picture'   => '',
            'category_id' => '4',
        ]);

        Car::create([
            'make'      => 'Range Rover',
            'model'     => 'Vogue',
            'picture'   => '',
            'category_id' => '4',
        ]);

        Car::create([
            'make'      => 'Range Rover',
            'model'     => 'Se 4.0',
            'picture'   => '',
            'category_id' => '4',
        ]);

        Car::create([
            'make'      => 'Range Rover',
            'model'     => 'Others',
            'picture'   => '',
            'category_id' => '4',
        ]);

        Car::create([
            'make'      => 'Renault',
            'model'     => 'Others',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Rolls Royce',
            'model'     => 'Others',
            'picture'   => '',
            'category_id' => '3',
        ]);


        Car::create([
            'make'      => 'Rover',
            'model'     => 'Others',
            'picture'   => '',
            'category_id' => '2',
        ]);

        Car::create([
            'make'      => 'Saab',
            'model'     => 'Others',
            'picture'   => '',
            'category_id' => '2',
        ]);

        Car::create([
            'make'      => 'Scion',
            'model'     => 'TC',
            'picture'   => '',
            'category_id' => '2',
        ]);

        Car::create([
            'make'      => 'Scion',
            'model'     => 'XA',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Scion',
            'model'     => 'XB',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Scion',
            'model'     => 'Others',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Skoda',
            'model'     => 'Others',
            'picture'   => '',
            'category_id' => '2',
        ]);

        Car::create([
            'make'      => 'Smart',
            'model'     => 'Others',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Sogo',
            'model'     => 'Double Cabin',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Sogo',
            'model'     => 'Family Van',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Sogo',
            'model'     => 'Pick up',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Sogo',
            'model'     => 'Others',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Sokon',
            'model'     => 'Mpv',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Sokon',
            'model'     => 'Others',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Ssang Yong',
            'model'     => 'Chairman',
            'picture'   => '',
            'category_id' => '3',
        ]);

        Car::create([
            'make'      => 'Ssang Yong',
            'model'     => 'Korando',
            'picture'   => '',
            'category_id' => '4',
        ]);

        Car::create([
            'make'      => 'Ssang Yong',
            'model'     => 'Musso',
            'picture'   => '',
            'category_id' => '4',
        ]);

        Car::create([
            'make'      => 'Ssang Yong',
            'model'     => 'Rexton',
            'picture'   => '',
            'category_id' => '4',
        ]);

        Car::create([
            'make'      => 'Ssang Yong',
            'model'     => 'Stavic',
            'picture'   => '',
            'category_id' => '4',
        ]);

        Car::create([
            'make'      => 'Ssang Yong',
            'model'     => 'Others',
            'picture'   => '',
            'category_id' => '4',
        ]);

        Car::create([
            'make'      => 'Subaru',
            'model'     => 'Pleo',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Subaru',
            'model'     => 'Stella',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Subaru',
            'model'     => 'Sambar',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Subaru',
            'model'     => 'R2',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Subaru',
            'model'     => 'Others',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Triumph',
            'model'     => 'Others',
            'picture'   => '',
            'category_id' => '3',
        ]);

        Car::create([
            'make'      => 'Vauxhall',
            'model'     => 'Others',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Volkswagen',
            'model'     => 'Beetle',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Volkswagen',
            'model'     => 'Up',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Volkswagen',
            'model'     => 'Polo',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Volkswagen',
            'model'     => 'Double Cabin Amarok',
            'picture'   => '',
            'category_id' => '1',
        ]);

        Car::create([
            'make'      => 'Volkswagen',
            'model'     => 'Others',
            'picture'   => '',
            'category_id' => '1',

        ]);

        Car::create([
            'make'      => 'Volvo',
            'model'     => 'S40',
            'picture'   => '',
            'category_id' => '2',
        ]);

        Car::create([
            'make'      => 'Volvo',
            'model'     => 'S90',
            'picture'   => '',
            'category_id' => '3',
        ]);

        Car::create([
            'make'      => 'Volvo',
            'model'     => 'V40',
            'picture'   => '',
            'category_id' => '4',
        ]);

        Car::create([
            'make'      => 'Volvo',
            'model'     => 'Others',
            'picture'   => '',
            'category_id' => '3',
        ]);

        Car::create([
            'make'      => 'Willys',
            'model'     => 'Others',
            'picture'   => '',
            'category_id' => '4',
        ]);

        Model::reguard();
    }
}