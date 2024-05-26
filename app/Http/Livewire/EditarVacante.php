<?php

namespace App\Http\Livewire;

use App\Models\Salario;
use App\Models\Vacante;
use Livewire\Component;
use App\Models\Categoria;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;

class EditarVacante extends Component
{
    /**
     * Se sustituye $id por $vacante_id debido a que la propiedad $id
     * es reservada para el uso interno de livewire
     */
    public $vacante_id;
    public $titulo;
    public $salario;
    public $categoria;
    public $empresa;
    public $ultimo_dia;
    public $descripcion;
    public $imagen;
    public $imagen_nueva;

    use WithFileUploads;

    //reglas de validación
    public $rules = [
        'titulo' => ['required', 'string'],
        'salario' => 'required',
        'categoria' => 'required',
        'empresa' => 'required',
        'ultimo_dia' => 'required',
        'descripcion' => 'required',
        'imagen_nueva' => ['nullable', 'image', 'max:1024'], //nullable: puede estar vacío
    ];

    //lifecycle hook
    //el argumento se pasa al utilizar el componente en una vista
    //se implementa cuando se pasan valores a un formulario en modo edición
    public function mount(Vacante $vacante)
    {
        $this->vacante_id = $vacante->id;
        $this->titulo = $vacante->titulo;
        $this->salario = $vacante->salario_id;
        $this->categoria = $vacante->categoria_id;
        $this->empresa = $vacante->empresa;

        //la libreria Carbon permite cambiar el formato de fecha almacenado en la BD
        $this->ultimo_dia = Carbon::parse($vacante->ultimo_dia)->format('Y-m-d');
        $this->descripcion = $vacante->descripcion;
        $this->imagen = $vacante->imagen;
    }

    public function editar_vacante()
    {
        /**
         * El metodo validate() toma las reglas de validación definidas en la variable $rules
         * Retorna los valores de cada input en forma de array
         */
        $datos = $this->validate($this->rules);

        //Si hay una nueva imagen
        if ($this->imagen_nueva) {
            //almacenar la imagen
            $ruta_imagen = $this->imagen_nueva->store('public/vacantes');
            $datos['imagen_nueva'] = str_replace('public/vacantes/', '', $ruta_imagen);
        }

        // dd($datos);

        //Encontrar el registro a editar
        $vacante = Vacante::find($this->vacante_id);

        //Asignar los datos
        $vacante->titulo = $datos['titulo'];
        $vacante->salario_id = $datos['salario'];
        $vacante->categoria_id = $datos['categoria'];
        $vacante->empresa = $datos['empresa'];
        $vacante->ultimo_dia = $datos['ultimo_dia'];
        $vacante->descripcion = $datos['descripcion'];
        $vacante->imagen = $datos['imagen_nueva'] ?? $vacante->imagen; // si $datos['imagen_nueva'] es NULL asigna la imagen ya existente


        //Guardar los cambios
        $vacante->save();

        //Redireccionar y mostrar mensaje
        session()->flash('mensaje', 'Vacante modificada correctamente');
        return redirect()->route('vacantes.index');

    }


    public function render()
    {
        $salarios = Salario::all();
        $categorias = Categoria::all();
        
        return view('livewire.editar-vacante', [
            'salarios' => $salarios,
            'categorias' => $categorias
        ]);
    }
}
