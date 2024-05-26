<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Mis Vacantes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session()->has('mensaje'))
                <div class="bg-green-200 dark:bg-green-600 text-green-600 dark:text-white border border-green-600 dark:border-none text-sm text-center font-bold uppercase p-2 my-3 rounded">
                    {{ session('mensaje')}}
                </div>
            @endif
            
            <livewire:mostrar-vacantes />
        </div>
    </div>
</x-app-layout>