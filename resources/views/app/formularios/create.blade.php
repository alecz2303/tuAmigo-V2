@extends('layouts.formulario')

@section('content')
@include('notifications')
	<?php
		 	$url = 'formulario';
		 	$method = 'post';
	?>

		<div class="page-header">
			<h3>
				{{ $title }}
			</h3>
			<hr>
		</div>


	{{ Form::open(array('url'=>$url, 'method'=>$method, 'data-abide','id'=>'form')) }}
			<div class="row">
				<div class="col-md-4">
					<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <span class="input-group-text" id="basic-addon1">Fecha de Solicitud</span>
					  </div>
					  <input type="date" name="fecha_solicitud" class="form-control" placeholder="Fecha de Solicitud" aria-label="Fecha de Solicitud" aria-describedby="basic-addon1" required>
					  <div class="invalid-feedback">
		          El campo de Fecha es Obligatorio.
		        </div>
					</div>
				</div>

				<div class="col-md-4">
					<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <span class="input-group-text" id="basic-addon2">Clínica</span>
					  </div>
					  {{ Form::text('clinica', null, ['class'=>'form-control', 'placeholder'=>'Clínica', 'aria-label'=>'Clínica', 'aria-describedby'=>'basic-addon2','required']) }}
					  <div class="invalid-feedback">
		          El campo de Clínica es Obligatorio.
		        </div>
					</div>
				</div>

				<div class="col-md-4">
					<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <span class="input-group-text" id="basic-addon3">MVZ</span>
					  </div>
					  {{ Form::text('mvz', null, ['class'=>'form-control', 'placeholder'=>'MVZ', 'aria-label'=>'MVZ', 'aria-describedby'=>'basic-addon3','required']) }}
					  <div class="invalid-feedback">
		          El campo de MVZ es Obligatorio.
		        </div>
					</div>
				</div>
				
			</div>

			<div class="row">

				<div class="col-md-4">
					<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <span class="input-group-text" id="basic-addon4">Teléfono</span>
					  </div>
					  {{ Form::text('telefono', null, ['class'=>'form-control', 'placeholder'=>'Teléfono', 'aria-label'=>'Teléfono', 'aria-describedby'=>'basic-addon4','required']) }}
					  <div class="invalid-feedback">
		          El campo de Teléfono es Obligatorio.
		        </div>
					</div>
				</div>
				
				<div class="col-md-4">
					<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <span class="input-group-text" id="basic-addon5">Correo Electrónico</span>
					  </div>
					  {{ Form::email('email', null, ['class'=>'form-control', 'placeholder'=>'Correo Electrónico', 'aria-label'=>'Correo Electrónico', 'aria-describedby'=>'basic-addon5','required']) }}
					  <div class="invalid-feedback">
		          El campo de Correo Electrónico es Obligatorio.
		        </div>
					</div>
				</div>
				
				<div class="col-md-4">
					<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <span class="input-group-text" id="basic-addon6">Fecha y Hr Toma Muestra</span>
					  </div>
					  {{ Form::text('toma_muestra', null, ['id'=>'datetimepicker','class'=>'form-control', 'placeholder'=>'Fecha y Hr Toma Muestra', 'aria-label'=>'Fecha. y Hr Toma Muestra', 'aria-describedby'=>'basic-addon6','required']) }}
					  <div class="invalid-feedback">
		          El campo de Fecha y Hr Toma Muestra es Obligatorio.
		        </div>
					</div>
				</div>
				
			</div>
			<div class="row">

				<div class="col-md-4">
					<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <label class="input-group-text" for="inputGroupSelect01">Especie</label>
					  </div>
					  {{ Form::select('familia_id', array(null=>'Seleccione Uno')+$familia_options, Input::old('familia_id', isset($solicitud)?$solicitud->familia_id:null), ['required','class'=>'custom-select','id'=>'inputGroupSelect01']) }}
					  <div class="invalid-feedback">
		          El campo de Especie es Obligatorio.
		        </div>
					</div>
				</div>

				<div class="col-md-4">
					<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <span class="input-group-text" id="basic-addon1">Identificación Mascota</span>
					  </div>
					  {{ Form::text('id_animal', null, ['class'=>'form-control', 'placeholder'=>'Identificación Mascota', 'aria-label'=>'Identificación Mascota', 'aria-describedby'=>'basic-addon1','required']) }}
					  <div class="invalid-feedback">
		          El campo de Identificación Mascota es Obligatorio.
		        </div>
					</div>
				</div>

				<div class="col-md-4">
					<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <span class="input-group-text" id="basic-addon1">Raza</span>
					  </div>
					  {{ Form::text('raza', null, ['id'=>'datetimepicker','class'=>'form-control', 'placeholder'=>'Raza', 'aria-label'=>'Raza', 'aria-describedby'=>'basic-addon1','required']) }}
					  <div class="invalid-feedback">
		          El campo de Raza es Obligatorio.
		        </div>
					</div>
				</div>

			</div>

			<div class="row">

				<div class="col-md-4">
					<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <label class="input-group-text" for="inputGroupSelect02">Sexo</label>
					  </div>
					  {{ Form::select('sexo', array(null=>'Seleccione Uno','Macho'=>'Macho','Hembra'=>'Hembra','Macho Castrado'=>'Macho Castrado','Hembra Castrada'=>'Hembra Castrada'), null, ['required','id'=>'inputGroupSelect02','class'=>'custom-select']) }}
					  <div class="invalid-feedback">
		          El campo de Sexo es Obligatorio.
		        </div>
					</div>
				</div>

				<div class="col-md-4">
					<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <span class="input-group-text" id="basic-addon1">Edad</span>
					  </div>
					  {{ Form::text('edad', null, ['id'=>'datetimepicker','class'=>'form-control', 'placeholder'=>'Edad', 'aria-label'=>'Edad', 'aria-describedby'=>'basic-addon1','required']) }}
					  <div class="invalid-feedback">
		          El campo de Edad es Obligatorio.
		        </div>
					</div>
				</div>
				
				<div class="col-md-4">
					<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <span class="input-group-text" id="basic-addon1">Propietario</span>
					  </div>
					  {{ Form::text('propietario', null, ['id'=>'datetimepicker','class'=>'form-control', 'placeholder'=>'Propietario', 'aria-label'=>'Propietario', 'aria-describedby'=>'basic-addon1','required']) }}
					  <div class="invalid-feedback">
		          El campo de Propietario es Obligatorio.
		        </div>
					</div>
				</div>

			</div>

			<div class="row">

				<div class="col-md-8">

					<div class="input-group">
					  <div class="input-group-prepend">
					    <span class="input-group-text">Anamnesis</span>
					  </div>
					  {{ Form::textarea('anamnesis', null,array('rows'=>3,'class'=>'form-control', 'aria-label'=>'With textarea','required')) }}
					  <div class="invalid-feedback">
		          El campo de Anamnesis es Obligatorio.
		        </div>
					</div>
	
				</div>
			</div>

			<br>

			<div class="container">
			  <div class="row">
			    <div class="col">
			      <div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <div class="input-group-text">
						      <input type="checkbox" name="1" aria-label="Checkbox for following text input">
						    </div>
						  </div>
						  <u>BIOMETRÍA HEMÁTICA O HEMOGRAMA</u>
						</div>

						<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <div class="input-group-text">
						      <input type="checkbox" name="2" aria-label="Checkbox for following text input">
						    </div>
						  </div>
						  Panel de Coagulación (Hemograma, Plaquetas, Tiempo de Protombina, Tiempo de Tromboplastina y Fibrinogeno)
						</div>

						<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <div class="input-group-text">
						      <input type="checkbox" name="3" aria-label="Checkbox for following text input">
						    </div>
						  </div>
						  Urianálisis
						</div>

						<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <div class="input-group-text">
						      <input type="checkbox" name="4" aria-label="Checkbox for following text input">
						    </div>
						  </div>
						  Urocultivo
						</div>

						<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <div class="input-group-text">
						      <input type="checkbox" name="5" aria-label="Checkbox for following text input">
						    </div>
						  </div>
						  Análisis Fisioquímico de Cálculos
						</div>

						<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <div class="input-group-text">
						      <input type="checkbox" name="6" aria-label="Checkbox for following text input">
						    </div>
						  </div>
						  Estudio Coprológico
						</div>
						<div class="row">
					    <div class="col">
					      <div class="input-group mb-3">
								  <u>QUÍMICA SANGUÍNEA</u>
								</div>

								<div class="input-group mb-3">
								  <div class="input-group-prepend">
								    <div class="input-group-text">
								      <input type="checkbox" name="7" aria-label="Checkbox for following text input">
								    </div>
								  </div>
								  Ácido Úrico
								</div>

								<div class="input-group mb-3">
								  <div class="input-group-prepend">
								    <div class="input-group-text">
								      <input type="checkbox" name="8" aria-label="Checkbox for following text input">
								    </div>
								  </div>
								  Alanino Aminostransferasa (ALT)
								</div>

								<div class="input-group mb-3">
								  <div class="input-group-prepend">
								    <div class="input-group-text">
								      <input type="checkbox" name="9" aria-label="Checkbox for following text input">
								    </div>
								  </div>
								  Aspartato Amino Transferasa (AST)
								</div>

								<div class="input-group mb-3">
								  <div class="input-group-prepend">
								    <div class="input-group-text">
								      <input type="checkbox" name="10" aria-label="Checkbox for following text input">
								    </div>
								  </div>
								  Albúmina en Suero
								</div>

								<div class="input-group mb-3">
								  <div class="input-group-prepend">
								    <div class="input-group-text">
								      <input type="checkbox" name="11" aria-label="Checkbox for following text input">
								    </div>
								  </div>
								  Amilasa
								</div>

								<div class="input-group mb-3">
								  <div class="input-group-prepend">
								    <div class="input-group-text">
								      <input type="checkbox" name="12" aria-label="Checkbox for following text input">
								    </div>
								  </div>
								  Bilirrubina Directa
								</div>

								<div class="input-group mb-3">
								  <div class="input-group-prepend">
								    <div class="input-group-text">
								      <input type="checkbox" name="13" aria-label="Checkbox for following text input">
								    </div>
								  </div>
								  Bilirrubina Total
								</div>

								<div class="input-group mb-3">
								  <div class="input-group-prepend">
								    <div class="input-group-text">
								      <input type="checkbox" name="14" aria-label="Checkbox for following text input">
								    </div>
								  </div>
								  Calcio
								</div>

								<div class="input-group mb-3">
								  <div class="input-group-prepend">
								    <div class="input-group-text">
								      <input type="checkbox" name="15" aria-label="Checkbox for following text input">
								    </div>
								  </div>
								  CK
								</div>

								<div class="input-group mb-3">
								  <div class="input-group-prepend">
								    <div class="input-group-text">
								      <input type="checkbox" name="16" aria-label="Checkbox for following text input">
								    </div>
								  </div>
								  Cloro
								</div>

								<div class="input-group mb-3">
								  <div class="input-group-prepend">
								    <div class="input-group-text">
								      <input type="checkbox" name="17" aria-label="Checkbox for following text input">
								    </div>
								  </div>
								  Colesterol Total
								</div>

								<div class="input-group mb-3">
								  <div class="input-group-prepend">
								    <div class="input-group-text">
								      <input type="checkbox" name="18" aria-label="Checkbox for following text input">
								    </div>
								  </div>
								  Creatinina
								</div>

								<div class="input-group mb-3">
								  <div class="input-group-prepend">
								    <div class="input-group-text">
								      <input type="checkbox" name="19" aria-label="Checkbox for following text input">
								    </div>
								  </div>
								  Fosfatasa Alcalina
								</div>

								<div class="input-group mb-3">
								  <div class="input-group-prepend">
								    <div class="input-group-text">
								      <input type="checkbox" name="20" aria-label="Checkbox for following text input">
								    </div>
								  </div>
								  Fósforo en Suero
								</div>

								<div class="input-group mb-3">
								  <div class="input-group-prepend">
								    <div class="input-group-text">
								      <input type="checkbox" name="21" aria-label="Checkbox for following text input">
								    </div>
								  </div>
								  Glucosa
								</div>

								<div class="input-group mb-3">
								  <div class="input-group-prepend">
								    <div class="input-group-text">
								      <input type="checkbox" name="22" aria-label="Checkbox for following text input">
								    </div>
								  </div>
								  GGT
								</div>

								<div class="input-group mb-3">
								  <div class="input-group-prepend">
								    <div class="input-group-text">
								      <input type="checkbox" name="23" aria-label="Checkbox for following text input">
								    </div>
								  </div>
								  Potasio
								</div>

								<div class="input-group mb-3">
								  <div class="input-group-prepend">
								    <div class="input-group-text">
								      <input type="checkbox" name="24" aria-label="Checkbox for following text input">
								    </div>
								  </div>
								  Proteínas Totales
								</div>
					    </div>
					    <div class="col">
					      <div class="input-group mb-3">
								  <div class="input-group-prepend">
								    <div class="input-group-text">
								      <input type="checkbox" name="25" aria-label="Checkbox for following text input">
								    </div>
								  </div>
								  Sodio
								</div>

								<div class="input-group mb-3">
								  <div class="input-group-prepend">
								    <div class="input-group-text">
								      <input type="checkbox" name="26" aria-label="Checkbox for following text input">
								    </div>
								  </div>
								  Triglicéridos
								</div>

								<div class="input-group mb-3">
								  <div class="input-group-prepend">
								    <div class="input-group-text">
								      <input type="checkbox" name="27" aria-label="Checkbox for following text input">
								    </div>
								  </div>
								  Urea
								</div>

								<div class="input-group mb-3">
								  <div class="input-group-prepend">
								    <div class="input-group-text">
								      <input type="checkbox" name="28" aria-label="Checkbox for following text input">
								    </div>
								  </div>
								  Hormona Estimulante de Tiroides
								</div>

								<div class="input-group mb-3">
								  <div class="input-group-prepend">
								    <div class="input-group-text">
								      <input type="checkbox" name="29" aria-label="Checkbox for following text input">
								    </div>
								  </div>
								  Hormona Folículo Estimulante
								</div>

								<div class="input-group mb-3">
								  <div class="input-group-prepend">
								    <div class="input-group-text">
								      <input type="checkbox" name="30" aria-label="Checkbox for following text input">
								    </div>
								  </div>
								  Hormona Luteinizante
								</div>

								<div class="input-group mb-3">
								  <div class="input-group-prepend">
								    <div class="input-group-text">
								      <input type="checkbox" name="31" aria-label="Checkbox for following text input">
								    </div>
								  </div>
								  Progesterona
								</div>

								<div class="input-group mb-3">
								  <div class="input-group-prepend">
								    <div class="input-group-text">
								      <input type="checkbox" name="32" aria-label="Checkbox for following text input">
								    </div>
								  </div>
								  Prolactina
								</div>

								<div class="input-group mb-3">
								  <div class="input-group-prepend">
								    <div class="input-group-text">
								      <input type="checkbox" name="33" aria-label="Checkbox for following text input">
								    </div>
								  </div>
								  Testosterona Total
								</div>

								<div class="input-group mb-3">
								  <div class="input-group-prepend">
								    <div class="input-group-text">
								      <input type="checkbox" name="34" aria-label="Checkbox for following text input">
								    </div>
								  </div>
								  Tiroxina T4
								</div>

								<div class="input-group mb-3">
								  <div class="input-group-prepend">
								    <div class="input-group-text">
								      <input type="checkbox" name="35" aria-label="Checkbox for following text input">
								    </div>
								  </div>
								  Triyodotironina (T3)
								</div>

								<div class="input-group mb-3">
								  <div class="input-group-prepend">
								    <div class="input-group-text">
								      <input type="checkbox" name="36" aria-label="Checkbox for following text input">
								    </div>
								  </div>
								  Cortisol
								</div>

								<div class="input-group mb-3">
								  <div class="input-group-prepend">
								    <div class="input-group-text">
								      <input type="checkbox" name="37" aria-label="Checkbox for following text input">
								    </div>
								  </div>
								  Hormona Paratiroidea (PTH Intacta)
								</div>

								<div class="input-group mb-3">
								  <div class="input-group-prepend">
								    <div class="input-group-text">
								      <input type="checkbox" name="38" aria-label="Checkbox for following text input">
								    </div>
								  </div>
								  Hierro
								</div>

								<div class="input-group mb-3">
								  <div class="input-group-prepend">
								    <div class="input-group-text">
								      <input type="checkbox" name="39" aria-label="Checkbox for following text input">
								    </div>
								  </div>
								  Captación de Hierro
								</div>
					    </div>
					  </div>
					  <div class="row">
					  	<div class="col">
					  		<div class="input-group mb-3">
									<u>PANELES ESPECIALES PARA EL DIAGNÓSTICO INTEGRAL (AYUNO MÍNIMO DE 8 HRS.)</u>
								</div>
						  	
						  	<div class="input-group mb-3">
								  <div class="input-group-prepend">
								    <div class="input-group-text">
								      <input type="checkbox" name="40" aria-label="Checkbox for following text input">
								    </div>
								  </div>
								  Panel Función Renal (Hemograma, Urea, Creatinina, Fósforo y Examen General de Orina)
								</div>

								<div class="input-group mb-3">
								  <div class="input-group-prepend">
								    <div class="input-group-text">
								      <input type="checkbox" name="41" aria-label="Checkbox for following text input">
								    </div>
								  </div>
								  Panel de Función Pancreática (Amilasa, Calcio, Glucosa y Coprológico)
								</div>

								<div class="input-group mb-3">
								  <div class="input-group-prepend">
								    <div class="input-group-text">
								      <input type="checkbox" name="42" aria-label="Checkbox for following text input">
								    </div>
								  </div>
								  Panel Preoperatorio (Hemograma, Glucosa, Urea, Creatinina, ALT, AST, y Fosfatasa Alcalina)
								</div>

								<div class="input-group mb-3">
								  <div class="input-group-prepend">
								    <div class="input-group-text">
								      <input type="checkbox" name="43" aria-label="Checkbox for following text input">
								    </div>
								  </div>
								  Panel Función Hepática (Hemograma, ALT, AST, Fosfatasa alcalina, Glucosa, Colesterol, Bilirrubinas Directa e Indirecta y Proteínas Totales, GGT.)
								</div>

								<div class="input-group mb-3">
								  <div class="input-group-prepend">
								    <div class="input-group-text">
								      <input type="checkbox" name="44" aria-label="Checkbox for following text input">
								    </div>
								  </div>
								  Panel Aves (Ácido Úrico, ALT, AST, Urea, Proteínas Totales, Amilasa)
								</div>

								<div class="input-group mb-3">
								  <div class="input-group-prepend">
								    <div class="input-group-text">
								      <input type="checkbox" name="45" aria-label="Checkbox for following text input">
								    </div>
								  </div>
								  Perfil Renal (Urea, Creatinina y Fósforo)
								</div>

								<div class="input-group mb-3">
								  <div class="input-group-prepend">
								    <div class="input-group-text">
								      <input type="checkbox" name="46" aria-label="Checkbox for following text input">
								    </div>
								  </div>
								  Perfil Hepático (ALT, AST, Fosfatasa Alcalina, Bilirrubina Directa e Indirecta, Colesterol, Glucosa y Proteínas Totales)
								</div>

								<div class="input-group mb-3">
								  <div class="input-group-prepend">
								    <div class="input-group-text">
								      <input type="checkbox" name="47" aria-label="Checkbox for following text input">
								    </div>
								  </div>
								  Perfil Hormonal (Hormona Luteinizante, Hormona Folículo Estimulante, Prolactina, Progesterona y Estradiol)
								</div>

								<div class="input-group mb-3">
								  <div class="input-group-prepend">
								    <div class="input-group-text">
								      <input type="checkbox" name="48" aria-label="Checkbox for following text input">
								    </div>
								  </div>
								  Perfil Tiroideo 1 (Tryyodotironina T3, Tiroxina T4, Hormona Estimulante de Tiroides)
								</div>

								<div class="input-group mb-3">
								  <div class="input-group-prepend">
								    <div class="input-group-text">
								      <input type="checkbox" name="49" aria-label="Checkbox for following text input">
								    </div>
								  </div>
								  Perfil Tiroideo 2 (tryyodotironina, Captación T3 cap, Tryyodotironina T3, Tiroxina T4, Yodo Proteico, Índice de Tiroxina ITL, Hormona Estimulante de Tiroides)
								</div>

								<div class="input-group mb-3">
								  <div class="input-group-prepend">
								    <div class="input-group-text">
								      <input type="checkbox" name="50" aria-label="Checkbox for following text input">
								    </div>
								  </div>
								  Perfil Diabetes (Glucosa, Colesterol, Triglicéridos, Hemoglobina, Glicosilada, Insulina y Examen General de Orina)
								</div>

								<div class="input-group mb-3">
								  <div class="input-group-prepend">
								    <div class="input-group-text">
								      <input type="checkbox" name="51" aria-label="Checkbox for following text input">
								    </div>
								  </div>
								  Panel Síndrome de Cushing (Hemograma, Examen General de Orina, Cortisol, 2 Determinaciones y Fosfatasa Alcalina)
								</div>

								<div class="input-group mb-3">
								  <div class="input-group-prepend">
								    <div class="input-group-text">
								      <input type="checkbox" name="52" aria-label="Checkbox for following text input">
								    </div>
								  </div>
								  Perfil Bioquímico de 6 Elementos (Urea, Creatinina, ALT, AST, Fosfatasa Alcalina y Glucosa)
								</div>

								<div class="input-group mb-3">
								  <div class="input-group-prepend">
								    <div class="input-group-text">
								      <input type="checkbox" name="53" aria-label="Checkbox for following text input">
								    </div>
								  </div>
								  Perfil Bioquímico de 12 Elementos (Calcio, Fósforo, Glucosa, Creatinina, Urea, Colesterol, Proteínas Totales, Albúmina, Bilirrubina Totales, Fosfatasa Alcalina, ALT, AST)
								</div>

								<div class="input-group mb-3">
								  <div class="input-group-prepend">
								    <div class="input-group-text">
								      <input type="checkbox" name="89" aria-label="Checkbox for following text input">
								    </div>
								  </div>
								  Perfil Bioquímico de 17 elementos(Urea, ALT, AST, Fosfatasa, Glucosa, Colesterol, Proteínas Totales, Albúmina, Triglicéridos, Bilirrubina Directa, Bilirrubina Total, Calcio, Fósforo, Acido Urico, Ck , Amilasa y Creatinina)
								</div>

								<div class="input-group mb-3">
								  <div class="input-group-prepend">
								    <div class="input-group-text">
								      <input type="checkbox" name="54" aria-label="Checkbox for following text input">
								    </div>
								  </div>
								  Perfil Bioquímico de 19 Elementos (CK, Urea, Creatinina, Glucosa, Colesterol, Bilirrubina Directa, Bilirrubina Total, ALT, AST, Fosfatasa Alcalina, Albúmina, Proteínas Totales, Amilasa, Triglicéridos, Calcio, Fósforo y Ácido Úrico, GGT y Globulinas)
								</div>

					  	</div>
					  </div>
			    </div>
			    <div class="col">
			      
			      <div class="input-group mb-3">
						  <u>BACTERIOLOGÍA</u>
						</div>

						<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <div class="input-group-text">
						      <input type="checkbox" name="55" aria-label="Checkbox for following text input">
						    </div>
						  </div>
						  Hemocultivo
						</div>

						<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <div class="input-group-text">
						      <input type="checkbox" name="56" aria-label="Checkbox for following text input">
						    </div>
						  </div>
						  Cultivo Micológico
						</div>

						<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <div class="input-group-text">
						      <input type="checkbox" name="57" aria-label="Checkbox for following text input">
						    </div>
						  </div>
						  Cultivo Bacteriológico de Exudado Faríngeo
						</div>

						<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <div class="input-group-text">
						      <input type="checkbox" name="58" aria-label="Checkbox for following text input">
						    </div>
						  </div>
						  Cultivo Bacteriológico de Exudado Vulvovaginal
						</div>

						<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <div class="input-group-text">
						      <input type="checkbox" name="59" aria-label="Checkbox for following text input">
						    </div>
						  </div>
						  Cultivo Bacteriológico de Heces
						</div>

						<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <div class="input-group-text">
						      <input type="checkbox" name="60" aria-label="Checkbox for following text input">
						    </div>
						  </div>
						  Cultivo Bacteriológico de Secreción Ótico
						</div>

						<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <div class="input-group-text">
						      <input type="checkbox" name="61" aria-label="Checkbox for following text input">
						    </div>
						  </div>
						  Cultivo Bacteriológico de Secreción Pleural
						</div>

						<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <div class="input-group-text">
						      <input type="checkbox" name="62" aria-label="Checkbox for following text input">
						    </div>
						  </div>
						  Cultivo Bacteriológico de Secreción Prostático
						</div>

						<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <div class="input-group-text">
						      <input type="checkbox" name="63" aria-label="Checkbox for following text input">
						    </div>
						  </div>
						  Cultivo Bacteriológico de Piel
						</div>

						<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <div class="input-group-text">
						      <input type="checkbox" name="64" aria-label="Checkbox for following text input">
						    </div>
						  </div>
						  Cultivo Bacteriológico de Bacterias Anaerobias
						</div>

						<br><br>

						<div class="input-group mb-3">
						  <u>OX DE ENFERMEDADES (ELISA)</u>
						</div>

						<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <div class="input-group-text">
						      <input type="checkbox" name="65" aria-label="Checkbox for following text input">
						    </div>
						  </div>
						  Erlichia Ewingli, Canis
						</div>

						<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <div class="input-group-text">
						      <input type="checkbox" name="66" aria-label="Checkbox for following text input">
						    </div>
						  </div>
						  Borrelia Burgdorferi
						</div>

						<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <div class="input-group-text">
						      <input type="checkbox" name="67" aria-label="Checkbox for following text input">
						    </div>
						  </div>
						  Anaplasma Phagocytopphilum, Platys
						</div>

						<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <div class="input-group-text">
						      <input type="checkbox" name="68" aria-label="Checkbox for following text input">
						    </div>
						  </div>
						  Leishmania Infantum
						</div>

						<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <div class="input-group-text">
						      <input type="checkbox" name="69" aria-label="Checkbox for following text input">
						    </div>
						  </div>
						  Dirofilaria
						</div>

						<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <div class="input-group-text">
						      <input type="checkbox" name="70" aria-label="Checkbox for following text input">
						    </div>
						  </div>
						  Anemia Infecciosa Equina
						</div>

						<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <div class="input-group-text">
						      <input type="checkbox" name="71" aria-label="Checkbox for following text input">
						    </div>
						  </div>
						  Brucella Canis
						</div>

						<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <div class="input-group-text">
						      <input type="checkbox" name="72" aria-label="Checkbox for following text input">
						    </div>
						  </div>
						  Coronavirus Canino
						</div>

						<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <div class="input-group-text">
						      <input type="checkbox" name="73" aria-label="Checkbox for following text input">
						    </div>
						  </div>
						  Hepatitis Infecciosa Canina
						</div>

						<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <div class="input-group-text">
						      <input type="checkbox" name="74" aria-label="Checkbox for following text input">
						    </div>
						  </div>
						  Herpes Virus Canino
						</div>

						<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <div class="input-group-text">
						      <input type="checkbox" name="75" aria-label="Checkbox for following text input">
						    </div>
						  </div>
						  Leptospirosis
						</div>

						<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <div class="input-group-text">
						      <input type="checkbox" name="76" aria-label="Checkbox for following text input">
						    </div>
						  </div>
						  Viaf/sida Felino
						</div>

						<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <div class="input-group-text">
						      <input type="checkbox" name="77" aria-label="Checkbox for following text input">
						    </div>
						  </div>
						  Leucemia Viral Felina
						</div>

						<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <div class="input-group-text">
						      <input type="checkbox" name="78" aria-label="Checkbox for following text input">
						    </div>
						  </div>
						  Moquillo o Distemper Canino
						</div>

						<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <div class="input-group-text">
						      <input type="checkbox" name="79" aria-label="Checkbox for following text input">
						    </div>
						  </div>
						  Muermo
						</div>

						<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <div class="input-group-text">
						      <input type="checkbox" name="80" aria-label="Checkbox for following text input">
						    </div>
						  </div>
						  Panleuco Penia Felina
						</div>

						<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <div class="input-group-text">
						      <input type="checkbox" name="81" aria-label="Checkbox for following text input">
						    </div>
						  </div>
						  Parvovirus
						</div>

						<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <div class="input-group-text">
						      <input type="checkbox" name="82" aria-label="Checkbox for following text input">
						    </div>
						  </div>
						  Peritonitis Infecciosa Felina
						</div>

						<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <div class="input-group-text">
						      <input type="checkbox" name="83" aria-label="Checkbox for following text input">
						    </div>
						  </div>
						  Piroplasmosis
						</div>

						<br><br>

						<div class="input-group mb-3">
						  <u>PATOLOGÍA</u>
						</div>

						<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <div class="input-group-text">
						      <input type="checkbox" name="84" aria-label="Checkbox for following text input">
						    </div>
						  </div>
						  Citología
						</div>

						<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <div class="input-group-text">
						      <input type="checkbox" name="85" aria-label="Checkbox for following text input">
						    </div>
						  </div>
						  Citología Vaginal
						</div>

						<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <div class="input-group-text">
						      <input type="checkbox" name="86" aria-label="Checkbox for following text input">
						    </div>
						  </div>
						  Análisis Fluidos
						</div>

						<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <div class="input-group-text">
						      <input type="checkbox" name="87" aria-label="Checkbox for following text input">
						    </div>
						  </div>
						  Histopatológico
						</div>

						<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <div class="input-group-text">
						      <input type="checkbox" name="88" aria-label="Checkbox for following text input">
						    </div>
						  </div>
						  Necropsia
						</div>

			    </div>
			  </div>
			</div>

			<br><br>

			<div class="row">
				<div class="col-md-4">
					{{ Form::submit('Guardar solicitud', ['class'=>'btn btn-primary']) }}
				</div>
			</div>

			<br><br><br>
	{{ Form::close() }}
@stop

@section('scripts')
	<link rel="stylesheet" type="text/css" href="{{ asset('datetimepicker-master/jquery.datetimepicker.css') }}"/ >
	<script src="{{ asset('datetimepicker-master/jquery.js') }}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
	<script src="{{ asset('datetimepicker-master/jquery.datetimepicker.js') }}"></script>

	<script type="text/javascript">
		jQuery.validator.setDefaults({
		    errorElement: 'span',
		    errorPlacement: function (error, element) {
		        error.addClass('invalid-feedback');
		        element.closest('.form-group').append(error);
		    },
		    highlight: function (element, errorClass, validClass) {
		        $(element).addClass('is-invalid');
		    },
		    unhighlight: function (element, errorClass, validClass) {
		        $(element).removeClass('is-invalid');
		    }
		});
	</script>

	<script>
	$(document).ready(function() {
	  $("#form").validate();

	});

  $(function() {
    $( "#datepicker" ).datetimepicker({
    	timepicker:false,
    	lang:'es',
    	format: "Y-m-d"
    });
  });
  </script>
  <script>
  jQuery('#datetimepicker').datetimepicker({
  	lang:'es',
  	format:'Y-m-d H:i:s'
  });
  </script>


	<link href="{{ asset('fklingler/demo/style.css') }}" media="all" rel="stylesheet" type="text/css">
  <script src="{{ asset('fklingler/jquery.touch-multiselect.js') }}"></script>
  <script type="text/javascript">
    $(document).ready(function () {
      $('#multiple').touchMultiSelect({
      	noneButtonText: 'Ninguno'
      });
    });
  </script>

@stop