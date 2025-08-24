<?php

include(dirname(__FILE__)."/../../Servicios_Func.php");

abstract class registrar_pasarela_CONFIG_ extends Servicios_Func
{
	
	public function getDescripcion()
	{
		
		
		return 'UmVnaXN0cmEgdW5hIHBhc2FyZWxhIGRlIHBhZ28gZW4gbGEgYmFzZSBkZSBkYXRvcw==';
		
		
	}
	
	public function getResponse()
	{
		
		
		return '';
		
		
	}
	
	
	public function getRequest()
	{
		
		return array(
						"nombre" 		=> array(
													"tipo" 			=> "string",
													"largo" 		=> "25",	
													"requerido" 	=> true,
													"largo_exacto" 	=> false,
													"desc" 			=> "",
							
							),
"estado" 		=> array(
													"tipo" 			=> "integer",
													"largo" 		=> "1",	
													"requerido" 	=> true,
													"largo_exacto" 	=> false,
													"desc" 			=> "",
							
							)
							
		);
		
	}
	
	
	
	
}
