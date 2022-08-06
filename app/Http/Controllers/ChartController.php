<?php

namespace App\Http\Controllers;

use App\Models\Chart;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    //
    // public function index()
    // {
    //     $data = 'this is a test';
    //     dd($data);
    //     return view('chart.index', $data);
    // }

    // Creamos una nueva funcion para obtener 
    public function basesT(){
        $charts =  Chart::all();
        // $s1_temp = Chart::all();
        // creamos un objeto vacio para almacenar los datos en $dataT
        $dataT = [];
        
        // Con un foreach, recorremos todos los registros de la tabla charts
        foreach ($charts as $chart) {
            $dataT['label'][] = $chart->date;
            $dataT['data'][] = $chart->temperatura;
        }
        //aplicamos el json_encode para convertir el array en un string
        $dataT['dataT'] = json_encode($dataT);
        // Para verificar, imprimimos el array para verificar que se haya convertido correctamente.
        // dd($dataT);
        // Retornamos la función a la vista '/chart/basesT' con los datos en un array.
        return view('chart.basesT', $dataT);
    }

    // public function basesH(){
    //     $s1_hum =  Chart::all();

    //     $dataH1 = [];
        
    //     foreach ($s1_hum as $chart) {
    //         $dataH1['label'][] = $chart->date;
    //         $dataH1['data'][] = $chart->humedad;
    //     }
    //     $dataH1['dataH1'] = json_encode($dataH1);
    //     // dd($dataH1);
    //     return view('chart.basesH', $dataH1);
    // }
    //Si dd($data) => presenta un dato NULL, ejecutar:
    //SELECT * FROM `s1_hum` WHERE humedad IS NOT NULL;
    
}
