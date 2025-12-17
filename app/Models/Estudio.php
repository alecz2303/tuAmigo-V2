<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
* 
*/
class Estudio extends Model
{
	protected $guarded = array('id');

	public static $rules = [
		'estudio' => 'required|min:4',
		'comentario' => 'min:4'
	];

	public static $messages = [
		'estudio.required' => 'El campo :attribute es requerido',
		'estudio.min' => 'El campo :attribute debe tener al menos :min caracteres.',
		'comentario.min' => 'El campo :attribute debe tener al menos :min caracteres.'
	];
}