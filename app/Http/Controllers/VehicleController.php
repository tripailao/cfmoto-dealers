<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\Dataset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $vehicles = Vehicle::orderBy('id', 'DESC')->get();
        return view('vehicles.index', compact('vehicles'));
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
            /*'year' => 'required|integer|max_digits:4',*/
            'image' => 'required|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
        ]);

        $serieId = $data['serie_id'];
        $serieName = DB::table('series')->where('id', $serieId)->first();

        if($request->hasFile('image')){
            $file_name = $data['name'] . '-' . $data['code'] . '.' . $request->file('image')->getClientOriginalExtension();
            $data['image'] = Storage::disk('hidden')->putFileAs('hidden', $request->image, $file_name);
        }

        Vehicle::create([
            'name' => $data['name'],
            'code' => $data['code'],
            'serie_name' => $serieName->name,
            'serie_id' => $data['serie_id'],
            /*'year' => $data['year'],*/
            'image_path' => $data['image'],
        ]);

        // crear el registro en la tabla de "catalog"

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
        $datasets = Dataset::where('vehicle_id', $vehicle->id)->whereNot('type_data', 'Service Manual')->get();
        $collected_engineData = $datasets->groupBy('vehicle_year');

        $service_manuals = Dataset::where('vehicle_id', $vehicle->id)->where('type_data', 'Service Manual')->get();

        return view('vehicles.show', compact('vehicle', 'collected_engineData', 'service_manuals'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehicle $vehicle)
    {
        //
        $series = DB::table('series')->get();
        return view('vehicles.edit', compact('vehicle','series') );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        //
        $data = $request->validate([
            'name' => 'required|max:255',
            'code' => 'required|max:255',
            'serie_id' => 'required|max:255',
            //'year' => 'required|integer|max_digits:4',
        ]);

        $vehicle->update($data);

        session()->flash('swal',[
            'icon' => 'success',
            'title' => 'Actualizado',
            'text' => 'Los datos se han modificado correctamente.',
            'confirmButtonColor' => '#198754',
        ]);

        return redirect()->route('vehicles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicle $vehicle)
    {
        //
    }

    public function search(){
        $search_text = $_GET['vehicle'];
        $vehicles = Vehicle::where('name', 'LIKE', '%' . $search_text . '%')
                            ->orWhere('code', 'LIKE', '%' . $search_text . '%')
                            ->orWhere('serie_name', 'LIKE', '%' . $search_text . '%')->get();

        return view('vehicles.search', compact('vehicles'));
    }
}
