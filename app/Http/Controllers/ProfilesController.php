<?php

namespace App\Http\Controllers;

use App\Carrera;
use App\Http\Requests\UpdateProfile;
use App\Inscripcion;
use App\InscripcionCiclo;
use App\Mail\UserRegistered;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Mail;

class ProfilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($user)
    {
        $user = User::findOrFail($user);
        $inscripcion = $user->inscripciones()->first();
        $careers = Carrera::all()->pluck('descripcion', 'id')->prepend('Seleccione...', '');

        if($inscripcion instanceof Inscripcion)
            $pensums = $inscripcion->carrera->pensums->pluck('descripcion', 'id')->prepend('Seleccione...', '');
        else
            $pensums = collect(['' => 'Seleccione...']);

        return view('profiles.edit', [
            'user' => $user,
            'inscripcion' => $inscripcion,
            'careers' => $careers,
            'pensums' => $pensums,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfile $request, $user)
    {
        $user = User::findOrFail($user);
        $user->update($request->all());

        if($user->activate == false)
            Mail::to($user)->send(new UserRegistered($user));

        $message = "Perfil actualizados exitosamente.";
        if((bool)$user->activate == false)
            $message .= ' Se le ha enviado un correo para activar su cuenta en la apliación.';

        return redirect()->back()->withMessage($message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function activate($code)
    {

        $user = Auth::user();
        if ((bool) $user->activate == false) {
            $activationCode = decrypt($code);
            $user->update(['activate' => 1, 'activate_code' => null]);
        }

        return redirect()->to('/');
    }
}
