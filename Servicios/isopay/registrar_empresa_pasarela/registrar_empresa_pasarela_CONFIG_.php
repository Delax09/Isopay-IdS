<?php

include(dirname(__FILE__)."/../../Servicios_Func.php");

abstract class registrar_empresa_pasarela_CONFIG_ extends Servicios_Func
{
	
	public function getDescripcion()
	{
		
		
		return 'UmVsYWNpb25hIHF1ZSB1bmEgZW1wcmVzYSB0ZW5nYSBoYWJpbGl0YWRhIHVuYSBwYXNhcmVsYSBkZSBwYWdv';
		
		
	}
	
	public function getResponse()
	{
		
		
		return '';
		
		
	}
	
	
	public function getRequest()
	{
		
		return array(
						"rut" 		=> array(
													"tipo" 			=> "string",
													"largo" 		=> "25",	
													"requerido" 	=> true,
													"largo_exacto" 	=> false,
													"desc" 			=> "",
							
							),
"tipo" 		=> array(
													"tipo" 			=> "integer",
													"largo" 		=> "1",	
													"requerido" 	=> true,
													"largo_exacto" 	=> false,
													"desc" 			=> "",
							
							),
"pasarela" 		=> array(
													"tipo" 			=> "integer",
													"largo" 		=> "1",	
													"requerido" 	=> true,
													"largo_exacto" 	=> false,
													"desc" 			=> "",
							
							),
"habilitada" 		=> array(
													"tipo" 			=> "integer",
													"largo" 		=> "1",	
													"requerido" 	=> true,
													"largo_exacto" 	=> false,
													"desc" 			=> "",
							
							)
							
		);
		
	}
	
	
	
	
}