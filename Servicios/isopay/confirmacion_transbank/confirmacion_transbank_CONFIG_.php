<?php

include(dirname(__FILE__)."/../../Servicios_Func.php");

abstract class confirmacion_transbank_CONFIG_ extends Servicios_Func
{
	
	public function getDescripcion()
	{
		
		
		return 'Y29uZmlybWFjaW9uIGRlIHRyYW5zYmFuaw==';
		
		
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
													"requerido" 	=> true,
													"largo_exacto" 	=> false,
													"desc" 			=> "",
							
							),
"token" 		=> array(
													"tipo" 			=> "string",
													"largo" 		=> "255",	
													"requerido" 	=> true,
													"largo_exacto" 	=> false,
													"desc" 			=> "",
							
							)
							
		);
		
	}
	
	
	
	
}