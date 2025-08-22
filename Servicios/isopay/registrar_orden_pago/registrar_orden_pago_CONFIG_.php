<?php

include(dirname(__FILE__)."/../../Servicios_Func.php");

abstract class registrar_orden_pago_CONFIG_ extends Servicios_Func
{
	
	public function getDescripcion()
	{
		
		
		return 'cmVnaXN0cmFyIHVuYSBvcmRlbiBwYWdv';
		
		
	}
	
	public function getResponse()
	{
		
		
		return '';
		
		
	}
	
	
	public function getRequest()
	{
		
		return array(
						"apiKey" 		=> array(
													"tipo" 			=> "string",
													"largo" 		=> "255",	
													"requerido" 	=> true,
													"largo_exacto" 	=> false,
													"desc" 			=> "",
							
							),
"secretKey" 		=> array(
													"tipo" 			=> "string",
													"largo" 		=> "255",	
													"requerido" 	=> false,
													"largo_exacto" 	=> false,
													"desc" 			=> "",
							
							),
"monto" 		=> array(
													"tipo" 			=> "integer",
													"largo" 		=> "",	
													"requerido" 	=> true,
													"largo_exacto" 	=> false,
													"desc" 			=> "",
							
							),
"numeroOrden" 		=> array(
													"tipo" 			=> "integer",
													"largo" 		=> "",	
													"requerido" 	=> true,
													"largo_exacto" 	=> false,
													"desc" 			=> "",
							
							),
"concepto" 		=> array(
													"tipo" 			=> "string",
													"largo" 		=> "255",	
													"requerido" 	=> true,
													"largo_exacto" 	=> false,
													"desc" 			=> "",
							
							),
"pasarela" 		=> array(
													"tipo" 			=> "integer",
													"largo" 		=> "1",	
													"requerido" 	=> true,
													"largo_exacto" 	=> false,
													"desc" 			=> "1: flow; 2: khipu; 3: mercadopago; 4: transbank",
							
							),
"empresaRut" 		=> array(
													"tipo" 			=> "string",
													"largo" 		=> "25",	
													"requerido" 	=> true,
													"largo_exacto" 	=> false,
													"desc" 			=> "Rut empresa",
							
							),
"correo" 		=> array(
													"tipo" 			=> "string",
													"largo" 		=> "100",	
													"requerido" 	=> true,
													"largo_exacto" 	=> false,
													"desc" 			=> "",
							
							),
"urlConfirmation" 		=> array(
													"tipo" 			=> "string",
													"largo" 		=> "100",	
													"requerido" 	=> true,
													"largo_exacto" 	=> false,
													"desc" 			=> "",
							
							),
"urlReturn" 		=> array(
													"tipo" 			=> "string",
													"largo" 		=> "100",	
													"requerido" 	=> true,
													"largo_exacto" 	=> false,
													"desc" 			=> "",
							
							),
"tipoEmpresa" 		=> array(
													"tipo" 			=> "integer",
													"largo" 		=> "1",	
													"requerido" 	=> true,
													"largo_exacto" 	=> false,
													"desc" 			=> "Tipo de empresa",
							
							)
							
		);
		
	}
	
	
	
	
}