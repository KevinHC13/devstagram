<?php

use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Models\Comentario;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Muestra la pagina principal
Route::get('/', function () {
    return view('principal');
});

//Muestra el formulario para crear una cuenta
Route::get('/crearCuenta', [RegisterController::class,'index'])->name('register');
// Crea el registro de la cuenta
Route::post('/crearCuenta', [RegisterController::class,'store']);

// Muestra el formulario para iniciar sesion
Route::get('/login',[LoginController::class,'index'])->name('login');
// Realiza la consulta para iniciar sesion
Route::post('/login',[LoginController::class,'store']);

// Cierra la sesion actual
Route::post('/logout',[LogoutController::class,'store'])->name('logout');

// Muestra el muro del usuario
Route::get('/{user:username}',[PostController::class,'index'])->name('posts.index');
// Muestra el formuario para crear un nuevo post
Route::get('/posts/create',[PostController::class,'create'])->name('posts.create');
// Guarda el nuevo post
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

// Almacena la imagen subida
Route::post('/imagenes',[ImagenController::class, 'store'])->name('imagenes.store');
// Muestra un post en especifico
Route::get('/{user:username}/posts/{post}',[PostController::class,'show'])->name('posts.show');

// Elimina el post selecionado
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

// Crea un nuevo comentario
Route::post('/{user:username}/posts/{post}', [ComentarioController::class, 'store'])->name('comentarios.store');