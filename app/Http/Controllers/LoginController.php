<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Muestra el formulario de inicio de sesión.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * Inicia sesión con las credenciales proporcionadas.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Intentar iniciar sesión con las credenciales proporcionadas
        if (!auth()->attempt($request->only('email', 'password'), $request->remember)) {
            // Si las credenciales son incorrectas, redireccionar de vuelta con un mensaje de error
            return back()->with('mensaje', 'Credenciales incorrectas');
        }

        // Si las credenciales son válidas, redireccionar al inicio con el nombre de usuario del usuario autenticado
        return redirect()->route('posts.index', auth()->user()->username);
    }
}
