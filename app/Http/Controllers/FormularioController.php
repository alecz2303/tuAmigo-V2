<?php

namespace App\Http\Controllers;

use App\Models\Formulario;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;

class FormularioController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$title = "Solicitud de Estudios";
		$familia_options = DB::table('familias')->orderBy('familia', 'asc')->lists('familia','id');
		$estudio_options = DB::table('estudios')->orderBy('estudio', 'asc')->lists('estudio','id');
		return View::make('app/formularios/create', compact('title','familia_options','estudio_options'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$estudios = [];
		if (Input::has(1)) {
			array_push($estudios,'BIOMETRÍA HEMÁTICA O HEMOGRAMA,');
		}
		if (Input::has(2)) {
			array_push($estudios,'Panel de Coagulación (Hemograma, Plaquetas, Tiempo de Protombina, Tiempo de Tromboplastina y Fibrinogeno),');
		}
		if (Input::has(3)) {
			array_push($estudios,'Urianálisis,');
		}
		if (Input::has(4)) {
			array_push($estudios,'Urocultivo,');
		}
		if (Input::has(5)) {
			array_push($estudios,'Análisis Fisioquímico de Cálculos,');
		}
		if (Input::has(6)) {
			array_push($estudios,'Estudio Coprológico,');
		}
		if (Input::has(7)) {
			array_push($estudios,'Ácido Úrico,');
		}
		if (Input::has(8)) {
			array_push($estudios,'Alanino Aminostransferasa (ALT),');
		}
		if (Input::has(9)) {
			array_push($estudios,'Alanino Aminostransferasa (ALT),');
		}
		if (Input::has(10)) {
			array_push($estudios,'Albúmina en Suero,');
		}
		if (Input::has(11)) {
			array_push($estudios,'Amilasa,');
		}
		if (Input::has(12)) {
			array_push($estudios,'Bilirrubina Directa,');
		}
		if (Input::has(13)) {
			array_push($estudios,'Bilirrubina Total,');
		}
		if (Input::has(14)) {
			array_push($estudios,'Calcio,');
		}
		if (Input::has(15)) {
			array_push($estudios,'CK,');
		}
		if (Input::has(16)) {
			array_push($estudios,'Cloro,');
		}
		if (Input::has(17)) {
			array_push($estudios,'Colesterol Total,');
		}
		if (Input::has(18)) {
			array_push($estudios,'Creatinina,');
		}
		if (Input::has(19)) {
			array_push($estudios,'Fosfatasa Alcalina,');
		}
		if (Input::has(20)) {
			array_push($estudios,'Fósforo en Suero,');
		}
		if (Input::has(21)) {
			array_push($estudios,'Glucosa,');
		}
		if (Input::has(22)) {
			array_push($estudios,'GGT,');
		}
		if (Input::has(23)) {
			array_push($estudios,'Potasio,');
		}
		if (Input::has(24)) {
			array_push($estudios,'Proteínas Totales,');
		}
		if (Input::has(25)) {
			array_push($estudios,'Sodio,');
		}
		if (Input::has(26)) {
			array_push($estudios,'Triglicéridos,');
		}
		if (Input::has(27)) {
			array_push($estudios,'Urea,');
		}
		if (Input::has(28)) {
			array_push($estudios,'Hormona Estimulante de Tiroides,');
		}
		if (Input::has(29)) {
			array_push($estudios,'Hormona Folículo Estimulante,');
		}
		if (Input::has(30)) {
			array_push($estudios,'Hormona Luteinizante,');
		}
		if (Input::has(31)) {
			array_push($estudios,'Progesterona,');
		}
		if (Input::has(32)) {
			array_push($estudios,'Prolactina,');
		}
		if (Input::has(33)) {
			array_push($estudios,'Testosterona Total,');
		}
		if (Input::has(34)) {
			array_push($estudios,'Tiroxina T4,');
		}
		if (Input::has(35)) {
			array_push($estudios,'Triyodotironina (T3),');
		}
		if (Input::has(36)) {
			array_push($estudios,'Cortisol,');
		}
		if (Input::has(37)) {
			array_push($estudios,'Hormona Paratiroidea (PTH Intacta),');
		}
		if (Input::has(38)) {
			array_push($estudios,'Hierro,');
		}
		if (Input::has(39)) {
			array_push($estudios,'Captación de Hierro,');
		}
		if (Input::has(40)) {
			array_push($estudios,'Panel Función Renal (Hemograma, Urea, Creatinina, Fósforo y Examen General de Orina),');
		}
		if (Input::has(41)) {
			array_push($estudios,'Panel de Función Pancreática (Amilasa, Calcio, Glucosa y Coprológico),');
		}
		if (Input::has(42)) {
			array_push($estudios,'Panel Preoperatorio (Hemograma, Glucosa, Urea, Creatinina, ALT, AST, y Fosfatasa Alcalina),');
		}
		if (Input::has(43)) {
			array_push($estudios,'Panel Función Hepática (Hemograma, ALT, AST, Fosfatasa alcalina, Glucosa, Colesterol, Bilirrubinas Directa e Indirecta y Proteínas Totales, GGT.),');
		}
		if (Input::has(44)) {
			array_push($estudios,'Panel Aves (Ácido Úrico, ALT, AST, Urea, Proteínas Totales, Amilasa),');
		}
		if (Input::has(45)) {
			array_push($estudios,'Perfil Renal (Urea, Creatinina y Fósforo),');
		}
		if (Input::has(46)) {
			array_push($estudios,'Perfil Hepático (ALT, AST, Fosfatasa Alcalina, Bilirrubina Directa e Indirecta, Colesterol, Glucosa y Proteínas Totales),');
		}
		if (Input::has(47)) {
			array_push($estudios,'Perfil Hormonal (Hormona Luteinizante, Hormona Folículo Estimulante, Prolactina, Progesterona y Estradiol),');
		}
		if (Input::has(48)) {
			array_push($estudios,'Perfil Tiroideo 1 (Tryyodotironina T3, Tiroxina T4, Hormona Estimulante de Tiroides),');
		}
		if (Input::has(49)) {
			array_push($estudios,'Perfil Tiroideo 2 (tryyodotironina, Captación T3 cap, Tryyodotironina T3, Tiroxina T4, Yodo Proteico, Índice de Tiroxina ITL, Hormona Estimulante de Tiroides),');
		}
		if (Input::has(50)) {
			array_push($estudios,'Perfil Diabetes (Glucosa, Colesterol, Triglicéridos, Hemoglobina, Glicosilada, Insulina y Examen General de Orina),');
		}
		if (Input::has(51)) {
			array_push($estudios,'Panel Síndrome de Cushing (Hemograma, Examen General de Orina, Cortisol, 2 Determinaciones y Fosfatasa Alcalina),');
		}
		if (Input::has(52)) {
			array_push($estudios,'Perfil Bioquímico de 6 Elementos (Urea, Creatinina, ALT, AST, Fosfatasa Alcalina y Glucosa),');
		}
		if (Input::has(53)) {
			array_push($estudios,'Perfil Bioquímico de 12 Elementos (Calcio, Fósforo, Glucosa, Creatinina, Urea, Colesterol, Proteínas Totales, Albúmina, Bilirrubina Totales, Fosfatasa Alcalina, ALT, AST),');
		}
		if (Input::has(89)) {
			array_push($estudios,'Perfil Bioquímico de 17 Elementos (Urea, ALT, AST, Fosfatasa, Glucosa, Colesterol, Proteínas Totales, Albúmina, Triglicéridos, Bilirrubina Directa, Bilirrubina Total, Calcio, Fósforo, Acido Urico, Ck , Amilasa y Creatinina)');
		}
		if (Input::has(54)) {
			array_push($estudios,'Perfil Bioquímico de 19 Elementos (CK, Urea, Creatinina, Glucosa, Colesterol, Bilirrubina Directa, Bilirrubina Total, ALT, AST, Fosfatasa Alcalina, Albúmina, Proteínas Totales, Amilasa, Triglicéridos, Calcio, Fósforo y Ácido Úrico, GGT y Globulinas),');
		}
		if (Input::has(55)) {
			array_push($estudios,'Hemocultivo,');
		}
		if (Input::has(56)) {
			array_push($estudios,'Cultivo Micológico,');
		}
		if (Input::has(57)) {
			array_push($estudios,'Cultivo Bacteriológico de Exudado Faríngeo,');
		}
		if (Input::has(58)) {
			array_push($estudios,'Cultivo Bacteriológico de Exudado Vulvovaginal,');
		}
		if (Input::has(59)) {
			array_push($estudios,'Cultivo Bacteriológico de Heces,');
		}
		if (Input::has(60)) {
			array_push($estudios,'Cultivo Bacteriológico de Secreción Ótico,');
		}
		if (Input::has(61)) {
			array_push($estudios,'Cultivo Bacteriológico de Secreción Pleural,');
		}
		if (Input::has(62)) {
			array_push($estudios,'Cultivo Bacteriológico de Secreción Prostático,');
		}
		if (Input::has(63)) {
			array_push($estudios,'Cultivo Bacteriológico de Piel,');
		}
		if (Input::has(64)) {
			array_push($estudios,'Cultivo Bacteriológico de Bacterias Anaerobias,');
		}
		if (Input::has(65)) {
			array_push($estudios,'Erlichia Ewingli, Canis,');
		}
		if (Input::has(66)) {
			array_push($estudios,'Borrelia Burgdorferi,');
		}
		if (Input::has(67)) {
			array_push($estudios,'Anaplasma Phagocytopphilum, Platys,');
		}
		if (Input::has(68)) {
			array_push($estudios,'Leishmania Infantum,');
		}
		if (Input::has(69)) {
			array_push($estudios,'Dirofilaria,');
		}
		if (Input::has(70)) {
			array_push($estudios,'Anemia Infecciosa Equina,');
		}
		if (Input::has(71)) {
			array_push($estudios,'Brucella Canis,');
		}
		if (Input::has(72)) {
			array_push($estudios,'Coronavirus Canino,');
		}
		if (Input::has(73)) {
			array_push($estudios,'Hepatitis Infecciosa Canina,');
		}
		if (Input::has(74)) {
			array_push($estudios,'Herpes Virus Canino,');
		}
		if (Input::has(75)) {
			array_push($estudios,'Leptospirosis,');
		}
		if (Input::has(76)) {
			array_push($estudios,'Viaf/sida Felino,');
		}
		if (Input::has(77)) {
			array_push($estudios,'Leucemia Viral Felina,');
		}
		if (Input::has(78)) {
			array_push($estudios,'Moquillo o Distemper Canino,');
		}
		if (Input::has(79)) {
			array_push($estudios,'Muermo,');
		}
		if (Input::has(80)) {
			array_push($estudios,'Panleuco Penia Felina,');
		}
		if (Input::has(81)) {
			array_push($estudios,'Parvovirus,');
		}
		if (Input::has(82)) {
			array_push($estudios,'Peritonitis Infecciosa Felina,');
		}
		if (Input::has(83)) {
			array_push($estudios,'Piroplasmosis,');
		}
		if (Input::has(84)) {
			array_push($estudios,'Citología,');
		}
		if (Input::has(85)) {
			array_push($estudios,'Citología Vaginal,');
		}
		if (Input::has(86)) {
			array_push($estudios,'Análisis Fluidos,');
		}
		if (Input::has(87)) {
			array_push($estudios,'Histopatológico,');
		}
		if (Input::has(88)) {
			array_push($estudios,'Necropsia,');
		}

		$est = implode("|",$estudios);
		
		Input::merge(['estudios'=>$est]);


		$new = Input::all();
		$formulario = new Formulario();
		if (!$formulario->validate($new)) {
      $errors = $formulario->errors();
      return Redirect::back()->withInput()->withErrors($errors);
    }

    if (!$form = $formulario->create(Input::all())) {
    	return Redirect::back()->withInput()->withErrors($errors);
    }


    $data=array(
    	'folio_solicitud' => $form->id,
			'fecha_solicitud' => Input::get('fecha_solicitud'),
			'clinica'         => Input::get('clinica'),
			'mvz'             => Input::get('mvz'),
			'telefono'        => Input::get('telefono'),
			'email'           => Input::get('email'),
			'toma_muestra'    => Input::get('toma_muestra'),
			'familia_id'      => $form->familia->familia,
			'id_animal'       => Input::get('id_animal'),
			'raza'            => Input::get('raza'),
			'sexo'            => Input::get('sexo'),
			'edad'            => Input::get('edad'),
			'propietario'     => Input::get('propietario'),
			'anamnesis'       => Input::get('anamnesis'),
			'estudios'        => Input::get('estudios')
		);



		Mail::send('emails.solicitud', $data, function($message) {
		    $message->from('analisis@analisistuamigo.com', 'Tu Amigo Laboratorio Clínico');
		    $message->subject('Solicitud de Estudios <<'.Input::get('mvz').'>>, "TU AMIGO LABORATORIO CLÍNICO"');
		    $message->to('mazaclaudia82@gmail.com');
		    $message->cc('labvet@analisistuamigo.com');
		    //$message->cc('alejandro@hostlat.com');
		});

		return Redirect::back()->with('success','Hemos recibido tu solicitud, en breve nos pondrémos en contacto contigo.');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
