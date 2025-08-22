<?php

include(dirname(__FILE__)."/../../Servicios_Func.php");

abstract class consultar_transaccion_CONFIG_ extends Servicios_Func
{
	
	public function getDescripcion()
	{
		
		
		return 'TWV0b2RvIHBhcmEgY29tcHJvYmFyIGVsIGVzdGFkbyBkZSB1bmEgdHJhbnNhY2Npb24=';
		
		
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
"token" 		=> array(
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
													"desc" 			=> "",
							
							)
							
		);
		
	}
	
	
	
	
}