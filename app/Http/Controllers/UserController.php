<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dealer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $role = User::with('roles')->get();
        $data = User::with('dealer')->orderBy('id', 'DESC')->get();
        return view('users.index', ['users' => $data], ['role' => $role]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $roles = Role::all();
        $dealers = Dealer::all();
        return view('users.create', compact('roles', 'dealers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->validate([
            'name'      => 'required|max:255',
            'lastname'  => 'required|max:255',
            'email'     => 'required|email:rfc',
            'password'  => 'required|max:255',
            'dealer'    => ['required', Rule::exists('dealers', 'id')->whereNull('deleted_at')],
            'role'      => 'required|exists:roles,name',
        ]);

        // Protect POST from outside for soft deleted dealers
        $dealer = Dealer::where('id', $request->dealer)->whereNull('deleted_at')->firstOrFail();

        $user = User::create([
            'name' => $data['name'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'dealer_id' => $dealer->id,

        ]);

        $user->assignRole($data['role']);

        session()->flash('swal',[
            'icon' => 'success',
            'title' => 'Usuario creado',
            'text' => 'El usuario se ha registrado correctamente.',
            'confirmButtonColor' => '#198754',
        ]);

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
        $roles = Role::all();
        $dealers = Dealer::all();
        return view('users.edit', compact('user', 'roles', 'dealers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user, Role $role)
    {
        //
        $data = $request->validate([
            'name'      => 'required|max:255',
            'lastname'  => 'required|max:255',
            'email'     => 'required|email:rfc',
            'password'  => 'required|max:255',
            'dealer_id' => 'required',
            'role'      => 'required|exists:roles,name',
        ]);

        $user->syncRoles($data['role']);

        $user->update($data);

        session()->flash('swal',[
            'icon' => 'success',
            'title' => 'Usuario actualizado',
            'text' => 'Se ha actualizado la información del usuario.',
            'confirmButtonColor' => '#198754',
        ]);

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //

        User::findOrFail($user->id)->forceDelete();

        session()->flash('swal',[
            'icon' => 'success',
            'title' => 'Usuario eliminado',
            'text' => 'La información del usuario ha sido eliminada de la base de datos',
            'confirmButtonColor' => '#198754',
        ]);

        return redirect()->route('users.index');
    }
}
