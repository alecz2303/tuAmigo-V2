<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
* 
*/
class Unidad extends Model
{

	protected $table = 'unidades';
	protected $guarded = array('id');

	public static $rules = [
		'estudio_id' => 'required',
		'unidad' => 'required',
	];

	public static $messages = [
		'estudio_id.required' => 'El campo :attribute es requerido',
		'unidad.required' => 'El campo :attribute es requerido',
	];

	public function estudio()
	{
		return $this->belongsTo(\App\Models\Estudio::class);
	}

	public function familia()
	{
		return $this->belongsTo(\App\Models\Familia::class);
	}

	
}