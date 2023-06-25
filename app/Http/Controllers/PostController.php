<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    /**
     * Crea una nueva instancia del controlador.
     */
    public function __construct()
    {
        // Aplica el middleware 'auth' a todos los métodos excepto 'show' e 'index'
        $this->middleware('auth')->except(['show','index']);
    }

    /**
     * Muestra los posts de un usuario.
     *
     * @param User $user
     * @return \Illuminate\Contracts\View\View
     */
    public function index(User $user)
    {
        // Obtiene los posts del usuario paginados (3 por página)
        $posts = Post::where('user_id', $user->id)->paginate(3);

        return view('dashboard', [
            'user' => $user,
            'posts' => $posts
        ]);
    }

    /**
     * Muestra el formulario para crear un nuevo post.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Almacena un nuevo post.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Valida los datos de entrada
        $this->validate($request, [
            'title' => 'required|max:255',
            'descripcion' => 'required',
            'imagen' => 'required'
        ]);

        // Crea un nuevo post asociado al usuario autenticado
        $request->user()->posts()->create([
            'title' => $request->title,
            'description' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id
        ]);

        return redirect()->route('posts.index', auth()->user()->username);
    }

    /**
     * Muestra un post específico.
     *
     * @param User $user
     * @param Post $post
     * @return \Illuminate\Contracts\View\View
     */
    public function show(User $user, Post $post)
    {
        return view('posts.show', [
            'user' => $user,
            'post' => $post
        ]);
    }

    /**
     * Elimina un post.
     *
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Post $post)
    {
        // Verifica la autorización para eliminar el post
        $this->authorize('delete', $post);

        // Elimina el post
        $post->delete();

        // Elimina la imagen asociada al post
        $imagen_path = public_path('uploads/' . $post->imagen);

        if(File::exists($imagen_path)){
            unlink($imagen_path);
        }

        return redirect()->route('posts.index', auth()->user()->username);
    }
}
