<?php

namespace App\Http\Controllers;

use App\Models\Dealer;
use App\Models\User;
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
            'phone' => 'required|max:50',
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
            'phone' => 'required|max:50',
        ]);

        $dealer->update($data);

        session()->flash('swal',[
            'icon' => 'success',
            'title' => 'Actualizado',
            'text' => 'Los datos se han modificado correctamente.',
            'confirmButtonColor' => '#198754',
        ]);

        return redirect()->route('dealers.index', $dealer);
    }

    /**
     * Soft delete.
     */
    public function trash(Dealer $dealer)
    {
        //
        $dealer->delete();

        session()->flash('swal',[
            'icon' => 'success',
            'title' => 'Enviado a la papelera',
            'text' => 'El dealer o servicio fue movido a la papelera.',
            'confirmButtonColor' => '#198754',
        ]);

        return redirect()->route('dealers.index');
    }
    /**
     * Restore a trashed dealer.
     */

    public function trashed(Dealer $dealer)
    {
        $dealers = Dealer::onlyTrashed()->get();
        return view('dealers.trashed', compact('dealers'));
    }

    /**
     * Restore a trashed dealer.
     */
    public function restore($id)
    {
        Dealer::withTrashed()->find($id)->restore();

        session()->flash('swal',[
            'icon' => 'success',
            'title' => 'Dealer o servicio recuperado',
            'text' => 'La información del dealer o servicio fue publicada nuevamente',
            'confirmButtonColor' => '#198754',
        ]);

        return redirect()->route('dealers.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dealer $dealer, $id)
    {
        //Check if there are users associated with the dealer
        $dealer = Dealer::withTrashed()->findOrFail($id);
        $dealer->loadCount('users');

        if ($dealer->users_count > 0) {
            session()->flash('swal',[
                'icon' => 'error',
                'title' => 'Error',
                'text' => 'No se puede eliminar el registro porque tiene a lo menos un usuario asociado. Primero debe eliminar el usuario o traspasarlo a otro Dealer o Servicio.',
                'confirmButtonColor' => '#198754',
            ]);
            return redirect()->back();
        }

        Dealer::onlyTrashed()->find($id)->forceDelete();

        session()->flash('swal',[
            'icon' => 'success',
            'title' => 'Información eliminada',
            'text' => 'El registro ha sido removido totalmente de la base de datos',
            'confirmButtonColor' => '#198754',
        ]);

        return redirect()->route('dealers.trashed');
    }
}
