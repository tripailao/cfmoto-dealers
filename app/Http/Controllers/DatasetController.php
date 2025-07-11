<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\Dataset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DatasetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $vehicles = Vehicle::all();
        $datasets = Dataset::all();
        return view('datasets.index', compact('vehicles', 'datasets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $vehicles = Vehicle::all();
        return view('datasets.create', ['vehicles' => $vehicles]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $vehicle = Vehicle::find($request->vehicle_id);
        $date = date('Ymj');

        $data = $request->validate([
            'vehicle_id' => 'required',
            'vehicle_year' => 'required',
            'type_data' => 'required',
            'file_path' => 'required|extensions:pdf,xls,xlsx|max:15048',
        ]);

        if($request->hasFile('file_path')){
            $file_name = $request->type_data . '-' . $vehicle->name . '-' . $request->vehicle_year . '.' . $request->file('file_path')->getClientOriginalExtension();
            $data['file_path'] = Storage::disk('hidden')->putFileAs('hidden', $request->file_path, $file_name);
        }

        //PartsCatalog::create($data);
        Dataset::create([
            'vehicle_id' => $data['vehicle_id'],
            'vehicle_year' => $data['vehicle_year'],
            'type_data' => $data['type_data'],
            'file_path' => $data['file_path'],
        ]);

        session()->flash('swal',[
            'icon' => 'success',
            'title' => 'Archivo cargado',
            'text' => 'El documento fue guardado en el servidor.',
            'confirmButtonColor' => '#198754',
        ]);

        return redirect()->route('datasets.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Dataset $dataset)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dataset $dataset)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dataset $dataset)
    {
        //
        if($request->hasFile('file')){
            if($dataset->file_path){
                Storage::delete($dataset->file_path);
            }
            $data['file_path'] = Storage::disk('public')->put('parts', $request->file);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dataset $dataset)
    {
        //
    }
}
