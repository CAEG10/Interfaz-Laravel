<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Analog;

class AnalogController extends Controller
{
     // Creamos una nueva funcion para obtener 
     public function basesA(){
        $analogs =  Analog::all();
        // creamos un objeto vacio para almacenar los datos en $dataA0
        $dataA0 = [];
        // Con un foreach, recorremos todos los registros de la tabla sensors
        foreach ($analogs as $analog) {
            // teniendo de label la fecha y de data la humedad
            $dataA0['label'][] = $analog->date;
            $dataA0['data'][] = $analog->CO2;
        }
        //aplicamos json_encode para convertir el array en un string
        $dataA0['dataA0'] = json_encode($dataA0);
        // Para verificar, imprimimos el array para verificar que se haya convertido correctamente.
        // dd($dataA0);
        // Retornamos la función a la vista '/chart/basesH' con los datos en un array.
        return view('chart.basesA', $dataA0);
    }
}
