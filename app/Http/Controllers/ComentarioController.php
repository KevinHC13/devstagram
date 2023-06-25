<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    /**
     * Almacena un nuevo comentario en un post.
     *
     * @param Request $request
     * @param User $user
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, User $user, Post $post) 
    {
        // Validar los datos de entrada
        $this->validate($request, [
            'comentario' => 'required|max:255'
        ]);

        // Crear un nuevo comentario
        Comentario::create([
            'user_id' => auth()->user()->id,
            'post_id' => $post->id,
            'comentario' => $request->comentario
        ]);

        // Redireccionar de vuelta a la página anterior con un mensaje de éxito
        return back()->with('mensaje', 'Comentario realizado correctamente');
    }
}
