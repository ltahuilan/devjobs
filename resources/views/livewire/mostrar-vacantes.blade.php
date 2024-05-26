<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
    <div class="px-6">
        @forelse ($vacantes as $vacante)
            <div class="flex flex-col md:flex-row justify-between border-b border-slate-300 p-2 my-6">
                <div class="space-y-3">
                    <a href="{{ route('vacantes.show', $vacante->id)}}" class="text-2xl text-slate-700 hover:text-black dark:text-white hover:dark:text-slate-300 font-bold transition ease-in-out duration-150">
                        {{ $vacante->titulo }}
                    </a>
                    <p class="text-sm text-slate-700 dark:text-slate-100 font-bold">
                        {{$vacante->empresa}}
                    </p>
                    <p class="text-sm text-slate-500 dark:text-slate-300 font-bold">
                        Último día: {{$vacante->ultimo_dia->format('d/m/Y')}}
                    </p>                    
                </div>

                {{-- acciones --}}
                <div class="flex flex-col md:flex-row gap-3 items-stretch md:items-center  my-4 md:my-0">
                    <a href="#" class="bg-slate-700 hover:bg-slate-900 dark:bg-slate-500 dark:hover:bg-slate-600 text-white dark:text-slate-100 text-center text-lg md:text-sm font-bold uppercase px-3 py-3 md:py-2 rounded transition ease-in-out duration-150">
                        Candidatos
                    </a>
                    <a href="{{ route('vacantes.edit', $vacante->id) }}" class="bg-indigo-700 hover:bg-indigo-800 text-slate-100 text-center text-lg md:text-sm font-bold uppercase px-3 py-3 md:py-2 rounded transition ease-in-out duration-150">
                        Editar
                    </a>
                    <button
                        wire:click="$emit('mostrarAlerta', {{ $vacante->id}})"
                        class="bg-red-600 hover:bg-red-700 text-slate-100 text-center text-lg md:text-sm font-bold uppercase px-3 py-3 md:py-2 rounded transition ease-in-out duration-150"
                    >
                        Eliminar
                    </button>
                </div>
            </div>
        @empty
            <p class="text-sm text-center text-slate-700 dark:text-slate-100 p-4">No hay vacantes para mostrar</p>
        @endforelse


        {{-- Mostrar los links de la paginación --}}
        <div class="my-6">
            {{$vacantes->links()}}
        </div>
    </div>

    {{-- SweetAlert2 --}}
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>

            Livewire.on('mostrarAlerta', (vacanteId) => {
                Swal.fire({
                    title: "{{ __('¿Eliminar la vacante?') }}",
                    text: "Este cambio no se puede revertir",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Si, eliminar",
                    cancelButtonText: "Cancelar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emit('eliminar_vacante', vacanteId);

                        Swal.fire({
                            title: "Eliminado!",
                            text: "La vacante se ha eliminado correctamente",
                            icon: "success"
                        });
                    }
                });
            }) 
        </script>


    @endpush

</div>    
