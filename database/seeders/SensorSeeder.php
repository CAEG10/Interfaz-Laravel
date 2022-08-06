<?php

namespace Database\Seeders;

use App\Models\Sensor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SensorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //creamos la variable que va a contener los datos que vamos a insertar
        $data = [
            array('humedad' => '47.00', 'date' => '2022-06-01 23:18:07'),
            array ('humedad'=> '47.00', 'date' => '2022-06-01 23:18:26'),
            array ('humedad'=> '47.00', 'date' => '2022-06-01 23:18:33'),
            array ('humedad'=> '47.00', 'date' => '2022-06-01 23:19:08'),
            array ('humedad'=> '47.00', 'date' => '2022-06-01 23:19:27'),
            array ('humedad'=> '48.00', 'date' => '2022-06-06 23:19:34'),
            array ('humedad'=> '48.00', 'date' => '2022-06-07 23:19:41'),
            array ('humedad'=> '48.00', 'date' => '2022-06-08 23:19:54'),
            array ('humedad'=> '48.00', 'date' => '2022-06-09 23:20:06'),
            array ('humedad'=> '48.00', 'date' => '2022-06-10 23:20:12'),
            array ('humedad'=> '48.00', 'date' => '2022-06-11 23:20:18'),
            array ('humedad'=> '57.00', 'date' => '2022-06-12 23:20:24'),
            array ('humedad'=> '57.00', 'date' => '2022-06-13 23:20:30'),
            array ('humedad'=> '57.00', 'date' => '2022-06-14 23:21:20'),
            array ('humedad'=> '57.00', 'date' => '2022-06-15 23:21:26'),
            array ('humedad'=> '57.00', 'date' => '2022-06-16 23:21:33'),
            array ('humedad'=> '57.00', 'date' => '2022-06-17 23:21:39'),
        ];
        Sensor::insert($data);
        // ejecutamos el seeder.
        // php artisan db:seed --class=SensorSeeder
    }
}
