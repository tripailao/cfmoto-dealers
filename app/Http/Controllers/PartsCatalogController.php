<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\PartsCatalog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PartsCatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = PartsCatalog::all();
        return view('parts-catalogs.index', ['catalogs' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $vehicles = Vehicle::all();
        return view('parts-catalogs.create', ['vehicles' => $vehicles]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'vehicle' => 'required',
            'file' => 'required|extensions:pdf,xlsx',
        ]);

        if($request->hasFile('file')){
            $data['file_path'] = Storage::disk('hidden')->put('hidden', $request->file);
        }

        PartsCatalog::create($data);

        session()->flash('swal',[
            'icon' => 'success',
            'title' => 'Archivo cargado',
            'text' => 'El documento fue guardado en el servidor.',
            'confirmButtonColor' => '#198754',
        ]);

        return redirect()->route('parts-catalogs.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(PartsCatalog $partsCatalog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PartsCatalog $partsCatalog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PartsCatalog $partsCatalog)
    {
        //

        if($request->hasFile('file')){
            if($partsCatalog->file_path){
                Storage::delete($partsCatalog->file_path);
            }
            $data['file_path'] = Storage::disk('public')->put('parts', $request->file);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PartsCatalog $partsCatalog)
    {
        //
    }

}
