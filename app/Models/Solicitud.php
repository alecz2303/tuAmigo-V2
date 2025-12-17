<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
*
*/
class Solicitud extends Model
{

	protected $table = 'solicitudes';
	protected $guarded = array('id');

	public function resultado()
  {
  	return $this->hasMany('Resultado','solicitud_id','id');
  }

  public function observacion()
  {
  	return $this->hasOne('Observacion');
  }

	public static $rules = [
		'fecha_solicitud' => 'required',
		'clinica' => 'required',
		'mvz' => 'required',
		'telefono' => 'required',
		'email' => 'required',
		'toma_muestra' => 'required',
		'id_animal' => 'required',
		'raza' => 'required',
		'sexo' => 'required',
		'edad' => 'required',
		'propietario' => 'required',
	];

	public static $messages = [
		'fecha_solicitud.required' => 'El campo :attribute es requerido',
		'clinica.required' => 'El campo :attribute es requerido',
		'mvz.required' => 'El campo :attribute es requerido',
		'telefono.required' => 'El campo :attribute es requerido',
		'email.required' => 'El campo :attribute es requerido',
		'toma_muestra.required' => 'El campo :attribute es requerido',
		'id_animal.required' => 'El campo :attribute es requerido',
		'raza.required' => 'El campo :attribute es requerido',
		'sexo.required' => 'El campo :attribute es requerido',
		'edad.required' => 'El campo :attribute es requerido',
		'propietario.required' => 'El campo :attribute es requerido',
	];

	public function familia()
	{
		return $this->belongsTo(\App\Models\Familia::class, 'familia_id');
	}

}