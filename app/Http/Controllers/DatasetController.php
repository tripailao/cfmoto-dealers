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
        $datasets = Dataset::orderBy('vehicle_year', 'desc')
            ->get();
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
        //$date = date('Ymj');

        $data = $request->validate([
            'vehicle_id' => 'required',
            'vehicle_year' => 'required',
            'type_data' => 'required',
            'file_path' => 'required|extensions:pdf,xls,xlsx|max:15048',
        ]);

        if($request->hasFile('file_path')){
            //$request_typedata = preg_replace('/\s+/', '', $request->type_data);
            //$file_name = $request_typedata . '-' . $vehicle->name . '-' . $request->vehicle_year . '.' . $request->file('file_path')->getClientOriginalExtension();
            //$data['file_path'] = Storage::disk('hidden')->putFileAs('hidden', $request->file_path, $file_name);
            $requestTypedata = preg_replace('/\s+/', '', $request->type_data);
            $extension = $request->file('file_path')->getClientOriginalExtension();
            $tempName = $requestTypedata . '-' . $vehicle->name . '-' . $request->vehicle_year . '.' . $extension;
            $storedPath = $request->file('file_path')
                ->storeAs('hidden', $tempName, 'hidden');
        }

        $dataset = Dataset::create([
            'vehicle_id' => $data['vehicle_id'],
            'vehicle_year' => $data['vehicle_year'],
            'type_data' => $data['type_data'],
            'file_path' => $storedPath,
        ]);

        $finalName = $requestTypedata . '-' . $vehicle->name . '-' . $data['vehicle_year'] . '-' . $dataset->id . '.' . $extension;
        $oldPath = $storedPath;
        $newPath = "hidden/$finalName";

        Storage::disk('hidden')->move($oldPath, $newPath);

        $dataset->update([ 'file_path' => $newPath ]);

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

    public function delete($id)
    {
        //
        Dataset::find($id)->delete();

        session()->flash('swal',[
            'icon' => 'success',
            'title' => 'Archivo eliminado',
            'text' => 'Se eliminó el archivo.',
            'confirmButtonColor' => '#198754',
        ]);

        return redirect()->route('datasets.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dataset $dataset)
    {
        //
        Dataset::find($id)->delete();

        session()->flash('swal',[
            'icon' => 'success',
            'title' => 'Archivo eliminado',
            'text' => 'Se eliminó el archivo.',
            'confirmButtonColor' => '#198754',
        ]);

        return redirect()->route('datasets.index');
    }
}
