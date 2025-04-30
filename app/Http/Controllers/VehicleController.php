<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        //$find = Vehicle::find(1);
        //return $find->serie;

        $data = Vehicle::all();
        //$serie = DB::table('series')->
        return view('vehicles.index', ['vehicles' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $series = DB::table('series')->get();
        return view('vehicles.create', ['series' => $series]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->validate([
            'name' => 'required|max:255',
            'code' => 'required|max:255',
            'serie_id' => 'required|max:255',
            'year' => 'required|integer|max_digits:4',
        ]);

        $serieId = $data['serie_id'];
        $serieName = DB::table('series')->where('id', $serieId)->first();

        Vehicle::create([
            'name' => $data['name'],
            'code' => $data['code'],
            'serie_name' => $serieName->name,
            'serie_id' => $data['serie_id'],
            'year' => $data['year'],
        ]);

        session()->flash('swal',[
            'icon' => 'success',
            'title' => 'Vehículo creado',
            'text' => 'El vehículo ha sido agregado.',
            'confirmButtonColor' => '#198754',
        ]);

        return redirect()->route('vehicles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Vehicle $vehicle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehicle $vehicle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicle $vehicle)
    {
        //
    }
}
