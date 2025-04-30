<?php

namespace App\Http\Controllers;

use App\Models\Dealer;
use Illuminate\Http\Request;

class DealerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Dealer::get();
        return view('dealers.index', ['dealers' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('dealers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->validate([
            'name' => 'required|min:3|max:255',
            'city' => 'required|min:3|max:255',
            'address' => 'required|min:5|max:255',
            'phone' => 'required|integer|max_digits:20',
        ]);

        Dealer::create($data);

        session()->flash('swal',[
            'icon' => 'success',
            'title' => 'Dealer creado',
            'text' => 'El distribuidor ha sido agregado.',
            'confirmButtonColor' => '#198754',
        ]);

        return redirect()->route('dealers.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Dealer $dealer)
    {
        //
        return('dealer');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dealer $dealer)
    {
        return view('dealers.edit', compact('dealer') );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dealer $dealer)
    {
        //
        $data = $request->validate([
            'name' => 'required|min:3|max:255',
            'city' => 'required|min:3|max:255',
            'address' => 'required|min:5|max:255',
            'phone' => 'required|integer|max_digits:20',
        ]);

        $dealer->update($data);

        session()->flash('swal',[
            'icon' => 'success',
            'title' => 'Actualizado',
            'text' => 'Los datos se han modificado correctamente.',
            'confirmButtonColor' => '#198754',
        ]);

        return redirect()->route('dealers.edit', $dealer);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dealer $dealer)
    {
        //
    }
}
