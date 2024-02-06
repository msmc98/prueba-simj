<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DiaFestivo;

class DiaFestivoController extends Controller
{
    //
    public function index()
    {
        $diasFestivos = DiaFestivo::all();
        return view('dias-festivos.dias-festivos-table', compact('diasFestivos'));
    }

    public function store()
    {
        $data = request()->validate([
            'nombre' => 'required',
            'color' => 'required',
            'dia' => 'required',
            'mes' => 'required',
            'año' => 'required',
            'recurrente' => 'nullable',

        ]);
        DiaFestivo::create([
            'nombre' => $data['nombre'],
            'color' => $data['color'],
            'dia' => $data['dia'],
            'mes' => $data['mes'],
            'año' => $data['año'],
            'recurrente' => $data['recurrente'] == '1' ? true : false
        ]);
        $diasFestivos = DiaFestivo::all();
        return view('dias-festivos.dias-festivos-table', compact('diasFestivos'));
    }

    public function update(Request $request, $id)
    {
        $diaFestivo = DiaFestivo::find($id);
        $diaFestivo->nombre = $request->nombre;
        $diaFestivo->color = $request->color;
        $diaFestivo->dia = $request->dia;
        $diaFestivo->mes = $request->mes;
        $diaFestivo->año = $request->año;
        $diaFestivo->recurrente = $request->recurrente == 1 ? true : false;
        $diaFestivo->save();
        return back();
    }

    public function destroy($id)
    {
        $diaFestivo = DiaFestivo::find($id);
        $diaFestivo->delete();
        return back();
    }

    // api
    public function apiGet()
    {
        $params = request()->all();

        $fest = DiaFestivo::where($params)->get();
        $recurrents = DiaFestivo::where('recurrente', true)->get();

        //combinar elementos sin repetir

        $combined = $fest->merge($recurrents)->unique('id');

        return response()->json($combined);
    }
}
