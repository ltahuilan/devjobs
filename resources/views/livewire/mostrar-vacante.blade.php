<div class="p-6 text-gray-900 dark:text-gray-100">
    
    <h2 class="text-2xl font-bold">{{$vacante->titulo}}</h2>

    <div class="md:grid md:grid-cols-2 mt-10 p-8 bg-gray-100 dark:bg-gray-700">
        <p class="my-4 uppercase font-bold">Empresa:
            <span class="font-normal normal-case">{{$vacante->empresa}}</span>
        </p>
        <p class="my-4 uppercase font-bold">Último día para postularse:
            <span class="font-normal normal-case">{{$vacante->ultimo_dia}}</span>
        </p>
        <p class="my-4 uppercase font-bold">Categoría:
            <span class="font-normal normal-case">{{$vacante->categoria->categoria}}</span>
        </p>
        <p class="my-4 uppercase font-bold">Salario:
            <span class="font-normal normal-case">{{$vacante->salario->salario}}</span>
        </p>
    </div>

    <div class="md:grid md:grid-cols-6 gap-8 mt-6">
        <img
            src="{{ asset('storage/vacantes/' . $vacante->imagen) }}"
            alt="{{'Imagen de ' . $vacante->titulo}}"
            class="col-span-2"
        >
        <div class="md:col-span-4 mt-10 md:mt-0">{{$vacante->descripcion}}</div>
    </div>

    @guest
        <div class="mt-10 p-8 text-center bg-gray-100 dark:bg-gray-700">
            <p class="">¿Deseas postularte a esta vacante?
                <a href="{{ route('register') }}" class="text-indigo-700 hover:text-indigo-800 dark:text-indigo-500 hover:dark:text-indigo-600 font-bold mt-4">
                    Registrate para postularte a estas y otras vacantes
                </a>
            </p>
        </div>
    @endguest
    
    {{-- Mostrar solo si no es un reclutador y si esta autenticado --}}
    @cannot('create', App\Models\Vacante::class)
        @auth
            <livewire:postular-vacante :vacante="$vacante" />     
        @endauth
    @endcannot

</div>
