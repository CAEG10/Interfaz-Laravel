<?php

namespace Database\Seeders;

use App\Models\Chart;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class ChartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //creamos la variable que va a contener los datos que vamos a insertar
        $data = [
            array('temperatura' => '17.41', 'date' => '2022-06-01 19:18:07'),
            array('temperatura' => '17.41', 'date' => '2022-06-01 19:18:25'),
            array('temperatura' => '17.41', 'date' => '2022-06-01 19:18:32'),
            array('temperatura' => '17.41', 'date' => '2022-06-01 19:18:25'),
            array('temperatura' => '17.41', 'date' => '2022-06-04 19:19:08'),
            array('temperatura' => '17.52', 'date' => '2022-06-01 19:19:27'),
            array('temperatura' => '17.52', 'date' => '2022-06-06 19:19:34'),
            array('temperatura' => '17.52', 'date' => '2022-06-07 19:19:41'),
            array('temperatura' => '17.52', 'date' => '2022-06-08 19:19:54'),
            array('temperatura' => '17.52', 'date' => '2022-06-09 19:20:06'),
            array('temperatura' => '17.52', 'date' => '2022-06-10 19:20:12'),
            array('temperatura' => '17.52', 'date' => '2022-06-11 19:20:18'),
            array('temperatura' => '17.52', 'date' => '2022-06-12 19:20:24'),
            array('temperatura' => '17.52', 'date' => '2022-06-13 19:20:30'),
            array('temperatura' => '17.52', 'date' => '2022-06-14 19:21:20'),
            array('temperatura' => '17.52', 'date' => '2022-06-15 19:21:26'),
            array('temperatura' => '17.52', 'date' => '2022-06-16 19:21:33'),
            array('temperatura' => '17.52', 'date' => '2022-06-17 19:21:39'),
        ];
        //utilizamos nuestro modelo Chart para insertar los datos
        Chart::insert($data);

    }
}
