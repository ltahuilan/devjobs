<?php

namespace App\Http\Livewire;

use App\Models\Vacante;
use Livewire\Component;
use Livewire\WithPagination;

class MostrarVacantes extends Component
{
    use WithPagination;

    //propiedad que contiene arreglo de los metodos invocados desde eventos de livewire
    protected $listeners = ['eliminar_vacante']; //livewire ver. 2.x

    public function eliminar_vacante(Vacante $vacante)
    {
        $vacante->delete();
    }
    
    public function render()
    {

        $vacantes = Vacante::where('user_id', auth()->user()->id )->paginate(5);

        return view('livewire.mostrar-vacantes', [
            'vacantes' => $vacantes
        ]);
    }
}
