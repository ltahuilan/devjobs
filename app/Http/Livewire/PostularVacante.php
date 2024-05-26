<?php

namespace App\Http\Livewire;

use App\Models\Vacante;
use Livewire\Component;
use Livewire\WithFileUploads;

class PostularVacante extends Component
{
    use WithFileUploads;

    public $cv;
    public $vacante;
    public $rules = [
        'cv' => ['required', 'mimes:pdf', 'max:1024']
    ];

    /**
     * Pasar el objeto $vacante al atributo public $vacante para que estedisponible en el resto metodos
     */
    public function mount(Vacante $vacante)
    {
        $this->vacante = $vacante;
    }

    public function postular()
    {
        /**
         * validar el formulario
         * El metodo validate() toma las reglas de validación definidas en la variable $rules
         * Retorna los valores de cada input en forma de array
         */ 
        $datos = $this->validate($this->rules);

        //guardar CV en disco
        $ruta_cv = $this->cv->store('public/postulaciones');
        $datos['cv'] = str_replace('public/postulaciones/', '', $ruta_cv);

        //guardar postulacion
        $this->vacante->candidatos()->create([
            
            // No es necesario definir vacante_id ya que esta se pasa automaticamente
            // por medio metodo candidatos que utiliza la relación hasMany
            'user_id' => auth()->user()->id,
            'cv' => $datos['cv']
        ]);
        
        //mostrar notificación y enviar email
        session()->flash('notify', 'Tu postulación ha sido enviada correctamente');

        // dd( session('mensaje') );

        //mostrar un mensaje de OK
    }
    

    public function render()
    {
        return view('livewire.postular-vacante');
    }
}
