@extends('layouts.app')

@section('titulo')
    Perfil: {{ $user->username }}
@endsection

@section('contenido')
    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
        <div class="w-8/12 lg:w-6/12 px-5">
            <img src="{{ asset('images/usuario.svg') }}" alt="Imagen usuario">
        </div>
        <div class="md:w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:justify-center py-10 md:items-start md:py-10">
            <p class="text-gray-700 text-2xl">{{ $user->username }}</p>
            <p class="text-gray-800 text-sm mb-3 font-bold mt-5">
                0
                <span class="font-normal">Seguidores</span>
            </p>
            <p class="text-gray-800 text-sm mb-3 font-bold">
                0
                <span class="font-normal">Siguiendo</span>
            </p>
            <p class="text-gray-800 text-sm mb-3 font-bold">
                0
                <span class="font-normal">Posts</span>
            </p>
        </div>
    </div>
    </div>

    <div class="m-7 flex justify-center mx-auto">

<section>
    <h2 class="text-4xl text-center font-black mt-10">Publicaciones</h2>
<div class="flex justify-center">


<div class="relative overflow-x-auto w-5/6 shadow-md sm:rounded-lg">
    <div class="container mx-auto px-5 py-2 lg:px-32 lg:pt-12">
        <div class="-m-1 flex flex-wrap md:-m-2">
            @if ($posts->count())
            @foreach ($posts as $post)
                <div class="flex w-1/3 flex-wrap p-2">
                    <div class="w-full p-1 md:p-2">
                        <div
                        class="block rounded-lg bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700">
                        <a href="{{ route('posts.show', ['user'=> $user, 'post' => $post]) }}">
                          <img
                            class="rounded-t-lg"
                            src="{{ asset('uploads/' . $post->imagen) }}"
                            alt="" />
                        </a>
                        <div class="p-6">
                          <h5
                            class="mb-2 text-xl font-medium leading-tight text-neutral-800 dark:text-neutral-50">
                            {{$post->title}}
                          </h5>
                          <p class="mb-4 text-base text-neutral-600 dark:text-neutral-200" >
                            {{$post->description}}
                          </p>
                          <div
                          
                            type="button"
                            class="inline-block rounded bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-black shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]"
                            data-te-ripple-init
                            data-te-ripple-color="light">
                            <a href="{{ route('posts.show', ['user'=> $user, 'post' => $post]) }}">
                            Ver
                            </a>
                        </div>
                        </div>
                      </div>
                      
                    </div>
                </div>
            @endforeach        
            @else
            <p class="text-gray-600 uppercase text-sm text-center font-bold">No hy posts</p>
                
            @endif
        </div>
      </div>
    </div>
</div>
</div>

</section>


    {{ $posts->links() }}


   
@endsection