<?php

namespace App\Http\Livewire;

use App\Models\Salario;
use Livewire\Component;
use App\Models\Categoria;
use App\Models\Vacante;
use Livewire\WithFileUploads;

class CrearVacante extends Component
{
    //definir las propiedades
    public $titulo;
    public $salario;
    public $categoria;
    public $empresa;
    public $ultimo_dia;
    public $descripcion;
    public $imagen;

    use WithFileUploads;

    //reglas de validación
    public $rules = [
        'titulo' => ['required', 'string'],
        'salario' => 'required',
        'categoria' => 'required',
        'empresa' => 'required',
        'ultimo_dia' => 'required',
        'descripcion' => 'required',
        'imagen' => ['required', 'image', 'max:1024']
    ];

    public function crear_vacante()
    {
        /**
         * Validar el formulario
         * El metodo validate() toma las reglas de validación definidas en la variable $rules
         * Retorna los valores de cada input en forma de array
         */
        $datos = $this->validate($this->rules);

        //almacenar la imagen
        $ruta_imagen = $this->imagen->store('public/vacantes');
        $datos['imagen'] = str_replace('public/vacantes/', '', $ruta_imagen);

        // dd($nombre_imagen);

        //crear la vacante
        Vacante::create([
            'titulo' => $datos['titulo'],
            'salario_id' => $datos['salario'],
            'categoria_id' => $datos['categoria'],
            'empresa' => $datos['empresa'],
            'ultimo_dia' => $datos['ultimo_dia'],
            'descripcion' => $datos['descripcion'],
            'imagen' => $datos['imagen'],
            'user_id' => auth()->user()->id
        ]);

        //mostrar alerta
        session()->flash('mensaje', 'La vacante se creo correctamente');

        //redireccionar
        return redirect()->route('vacantes.index');
    }

    public function render()
    {
        $salarios = Salario::all();
        $categorias = Categoria::all();

        return view('livewire.crear-vacante', [
            'salarios' => $salarios,
            'categorias' => $categorias
        ]);
    }
}
