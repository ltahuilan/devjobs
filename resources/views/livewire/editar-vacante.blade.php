{{-- wire:submit.prevent='crearVacante' definido en livewire/Crearvacante.php --}}

<form class="md:w-1/2 space-y-5" wire:submit.prevent='editar_vacante'>
    
    {{-- Título de la vacante --}}
    <div>
        <x-input-label for="titulo" :value="__('Titulo')" />
        <x-text-input
            id="titulo"
            type="text"
            wire:model="titulo"
            :value="old('titulo')"
            placeholder="Título de la vacante"
            class="block mt-1 w-full"
        />
        
        {{-- La variable $message se pasa al componente de livewire --}}
        @error('titulo')
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>

    {{-- Salario de la vacante --}}
    <div>
        <x-input-label for="salario" :value="__('Salario')" />
        <select wire:model="salario" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
            <option value="">-- Seleccionar --</option>
            @foreach ($salarios as $salario)
                <option value="{{$salario->id}}">{{$salario->salario}}</option>
            @endforeach
        </select>
        @error('salario')
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>

    {{-- Categoría de la vacante --}}
    <div>
        <x-input-label for="categoria" :value="__('Categoria')" />
        <select wire:model="categoria" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
            <option value="">-- Seleccionar --</option>
            @foreach ($categorias as $categoria)
                <option value="{{$categoria->id}}">{{$categoria->categoria}}</option>
            @endforeach
        </select>
        @error('categoria')
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>

    {{-- Empresa --}}
    <div>
        <x-input-label for="empresa" :value="__('Empresa')" />
        <x-text-input
            id="empresa"
            type="text"
            wire:model="empresa"
            :value="old('empresa')"
            placeholder="Nombre de la empresa Ej. Uber, Netflix, Google"
            class="block mt-1 w-full"
        />
        @error('empresa')
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>

    {{-- Último día para postularse a la vacante --}}
    <div>
        <x-input-label for="ultimo_dia" :value="__('Último día para postularse')" />
        <x-text-input
            id="ultimo_dia"
            type="date"
            wire:model="ultimo_dia"
            :value="old('ultimo_dia')"
            placeholder="Nombre de la ultimo_dia Ej. Uber, Netflix, Google"
            class="block mt-1 w-full"
        />
        @error('ultimo_dia')
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>

    {{-- Descripcion general de la vacante --}}
    <div>
        <x-input-label for="descripcion" :value="__('Descripción de la vacante')" />
        <textarea
            wire:model="descripcion"
            cols="30"
            rows="10"
            class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
            >
        </textarea>
        @error('descripcion')
            <livewire:mostrar-alerta :message="$message" />
        @enderror        
    </div>

    {{-- Imagen para la vacante --}}

    {{-- Para no comprometer la ruta donde se almacenan las imagenes,
    se puede crearun link simbolico que apunta a storage/vacantes
    para mostrar una imagen almacenada en storage/app/public 
    php artisan storage:link
    --}}
    <div class="my-5 w-72 mx-auto">
        <p class="my-4 uppercase">Imagen de esta vacante:</p>
        <img src="{{ asset('storage/vacantes/' . $imagen) }}" alt="{{ 'Imagen de ' . $titulo }}">
    </div>

    <div>
        <x-input-label for="imagen_nueva" :value="__('Cambiar Imagen')" />
        <x-text-input
            id="image"
            type="file"
            wire:model="imagen_nueva"
            class="block mt-1 w-full" 
            accept="image/*"
        />

        <div class="my-5 w-72 mx-auto">
            @if($imagen_nueva)
                <p class="mb-1">Imagen seleccionada:</p>
                <img src="{{ $imagen_nueva->temporaryUrl() }}" alt="img_temporary">
            @endif
        </div>

        @error('imagen_nueva')
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>

    <x-primary-button class="w-full justify-center">
        Guardar Cambios
    </x-primary-button>

    {{-- <x-secondary-button class="w-full justify-center" href="{{ route('vacantes.index') }}">
        Cancelar
    </x-secondary-button> --}}
    <a 
        href="{{ route('vacantes.index') }}"
        class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150 w-full justify-center"
    >
        Cancelar
    </a>
</form>

