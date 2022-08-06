<?php

namespace App\Http\Controllers;

use App\Models\Sensor;
use Illuminate\Http\Request;

class SensorController extends Controller
{
    // Creamos una nueva funcion para obtener 
    public function basesH(){
        $sensors =  Sensor::all();
        // creamos un objeto vacio para almacenar los datos en $dataH1
        $dataH1 = [];
        // Con un foreach, recorremos todos los registros de la tabla sensors
        foreach ($sensors as $sensor) {
            // teniendo de label la fecha y de data la humedad
            $dataH1['label'][] = $sensor->date;
            $dataH1['data'][] = $sensor->humedad;
        }
        //aplicamos json_encode para convertir el array en un string
        $dataH1['dataH1'] = json_encode($dataH1);
        // Para verificar, imprimimos el array para verificar que se haya convertido correctamente.
        // dd($dataH1);
        // Retornamos la función a la vista '/chart/basesH' con los datos en un array.
        return view('chart.basesH', $dataH1);
    }
}
