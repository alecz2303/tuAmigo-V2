<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 *
 */
class Formulario extends Model
{
    protected $table = 'formularios';
    protected $fillable = ['fecha_solicitud','clinica','mvz','telefono','email','toma_muestra','familia_id','id_animal','raza','sexo','edad','propietario','anamnesis','estudios'];

    private $rules = [
      'fecha_solicitud' => 'required',
      'clinica'         => 'required',
      'mvz'             => 'required',
      'telefono'        => 'required',
      'email'           => 'required',
      'toma_muestra'    => 'required',
      'familia_id'      => 'required',
      'id_animal'       => 'required',
      'raza'            => 'required',
      'sexo'            => 'required',
      'edad'            => 'required',
      'propietario'     => 'required',
      'anamnesis'       => 'required',
      'estudios'        => 'required',
    ];

    public function familia()
    {
      return $this->belongsTo('Familia','familia_id');
    }
    
    public function validate($data)
    {
      //hace un validador nuevo
      $v = Validator::make($data, $this->rules);
      //checa validación
      if ($v->fails()) {
          //asigna errores y regresa falso
          $this->errors = $v->errors();
          return false;
      }

      //la validación pasa
      return true;
    }

    public function errors()
    {
      return $this->errors;
    }
}