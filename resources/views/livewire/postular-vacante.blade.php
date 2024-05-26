<div class="my-10 p-10 bg-gray-100 dark:bg-gray-700 flex flex-col justify-center items-center">
    <h3 class="mb-4 text-3xl text-center font-bold text-gray-700 dark:text-gray-300">
        Postulate a esta vacante
    </h3>

    @if(session()->has('notify'))
        <div
            class="bg-green-200 dark:bg-green-600 text-green-600 dark:text-white border border-green-600 dark:border-none text-sm text-center font-bold uppercase p-2 my-3 rounded">
            {{ session('notify') }}
        </div>
    @else
        <form wire:submit.prevent='postular'>
            <div>
                <x-input-label
                    for="cv"
                    :value="__('Agrega tu Hoja de Vida o Curriculum (PDF)')"
                    class="mb-4 text-3xl"
                />
                <x-text-input 
                    id="cv"
                    type="file"
                    wire:model='cv'
                    class="w-full"
                    accept=".pdf"
                />
        
                @error('cv')
                    <livewire:mostrar-alerta :message="$message"/>
                @enderror       
            </div>

            <x-primary-button class="my-5">
                {{__('Postularme')}}
            </x-primary-button>
        </form>

    @endif

</div>
