<style>
	table th{
		background-color: #f1f1f1;
		text-align: left;
	}
	#solicitud{
		font-size: 12px;
	}
	#resultados{
		font-size: 12px;
	}
	#resultados td{
		border:solid 1px;
	}
	#resultados th{
		border:solid 1px;
	}
	.pie{
		background-color: #f1f1f1;
		width: 100%;
	}
	hr{
		margin: 5px 0 5px 0;
	}
	P.breakhere {
		page-break-before: always
	}
	.small{
		font-size: 10px !important;
	}
	h1, h2, h3, h4, h5, h6 {
		-webkit-margin-before: 0.10em !important;
  	-webkit-margin-after: 0.10em !important;
	}
	.negrita {
		background-color: #000;
		color: #fff;
	}
	.text-justified {
		text-align: justify;
	}
</style>

<body>
			<table width="100%">
				<tr>
					<td align="center"><img src="{{ asset('images/logota.png') }}" alt="" width="250"></td>
				</tr>
				<tr>
					<td align="center">
						<p class="small"><b>
							3a. Sur Pte. No. 2322 Col. Penipak Tuxtla Gutiérrez, Chiapas. <br>
							Tel. 60 267 47 Cel. 961 225 3463
						</b></p>
					</td>
				</tr>
			</table>


			{!! $title !!}
			<hr style="margin: 3px 0 3px 0;">
		</div>

		<table width="100%" id="solicitud">
			<tr>
				<td width="33%"><b>Fecha de solicitud: </b>{{ ($solicitud->fecha_solicitud) }}</td>
				<td width="33%"><b>Cl&iacute;nica: </b>{{ ($solicitud->clinica) }}</td>
				<td width="33%"><b>MVZ: </b>>{{ ($solicitud->mvz) }}</td>
			</tr>
			<tr>
				<td><b>Tel&eacute;fono: </b>{{ ($solicitud->telefono) }}</td>
				<td><b>Correo electr&oacute;nico: </b>{{ ($solicitud->email) }}</td>
				<td><b>Fecha y hora de toma de muestras: </b>{{ ($solicitud->toma_muestra) }}</td>
			</tr>
			<tr>
				<td><b>Especie: </b>{{ ($familia->familia) }}</td>
				<td><b>Identificaci&oacute;n del animal: </b>{{ ($solicitud->id_animal) }}</td>
				<td><b>Raza: </b>{{ ($solicitud->raza) }}</td>
			</tr>
			<tr>
				<td><b>Sexo: </b>{{ ($solicitud->sexo) }}</td>
				<td><b>Edad: </b>{{ ($solicitud->edad) }}</td>
				<td><b>Propietario: </b>{{ ($solicitud->propietario) }}</td>
			</tr>
			<tr>
				<td><b>Estudios solicitados: </b>{!! ($solicitud->estudios) !!}</td>
				<td><b>Anamnesis: </b>{!! ($observacion->observacion) !!}</td>
				<td></td>
			</tr>
		</table>
		<hr>
				<?php
					 $estudio = 0;
					 $titulo = 0;
				?>
				<?php  foreach($resultado as $x => $y): ?>
					<?php if ($estudio !== $y->estudio and ($estudio !== 0 or $estudio !== 1) ): ?>
						<!--<P CLASS="breakhere">-->
						<?php $estudio = 1; ?>
					<?php endif; ?>

					<?php if ( $estudio === 1): ?>
						<?php $estudio = 0; ?>
	    		<?php endif; ?>

					<?php if ( $estudio === 0): ?>
						<h2>	{{{ $y->estudio }}} </h2>
						<?php $estudio = $y->estudio; ?>
					<?php endif; ?>

					<?php if ($titulo !== $y->titulo and ($titulo !== 0 or $titulo !== 1) ): ?>
						<?php $titulo = 1; ?>
						<!-- End table -->
						</table>
					<?php endif; ?>

	        <?php if ( $titulo === 1): ?>
						<?php $titulo = 0 ?>
	    		<?php endif; ?>
					<?php if ($titulo === 0): ?>
						<h3>{{{ $y->titulo }}}</h3>
						<?php $titulo = $y->titulo; ?>
							<table id="resultados" style="border:solid 1px;">
								<tr>
									<th>Analito</th>
									<th>Resultado</th>
									<th>Referencia</th>
									<th>Unidad</th>
								</tr>
					<?php endif; ?>
							<tr>
							@if($y->resultado != '')
		            <td>{{ ($y->nombre) }}</td>
	            	@if($y->negrita == 1)
	            		<td class="negrita"><b><i>{{ $y->resultado }}</i></b></td>
	            	@else
	            		<td>{{ $y->resultado }}</td>
	            	@endif
		            <td>{{{ $y->valor }}}</td>
		            <td>{{ $y->unidad }}</td>
		           @endif
		          </tr>
				<?php endforeach;?>
							</table>
							<div class="text-justified">
							<br>
								<h3>Observaciónes:</h3>
								<small style="font-size:10px;">{{ ($observacion->observacion2) }}</small>
							</div>
							<hr>
<p class="small">
	Responsable: <b>M.V.Z. Claudia Maza Santiago</b> <i>C&eacute;dula Profesional: 4081748</i> <br>
	<img src="{{ asset('images/firma.png') }}" alt="" width="130">
</p>
	<?php
		switch (date('m')) {
			case '01':
				$mes = 'enero';
				break;
			case '02':
				$mes = 'febrero';
				break;
			case '03':
				$mes = 'marzo';
				break;
			case '04':
				$mes = 'abril';
				break;
			case '05':
				$mes = 'mayo';
				break;
			case '06':
				$mes = 'junio';
				break;
			case '07':
				$mes = 'julio';
				break;
			case '08':
				$mes = 'agosto';
				break;
			case '09':
				$mes = 'septiembre';
				break;
			case '10':
				$mes = 'octubre';
				break;
			case '11':
				$mes = 'noviembre';
				break;
			case '12':
				$mes = 'diciembre';
				break;
		}
	?>
	<small style="font-size:8px;">Documento creado el d&iacute;a <?php echo date('d'); ?> de <?php echo $mes; ?> de <?php echo date('Y'); ?> a las <?php echo date('h:i a') ?>.</small>
</body>

