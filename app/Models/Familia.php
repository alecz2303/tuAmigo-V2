<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
* 
*/
class Familia extends Model
{
	
	protected $guarded = array('id');

	public static $rules = [
		'familia' => 'required',
	];

	public static $messages = [
		'familia.required' => 'El campo :attribute es requerido',
	];

}