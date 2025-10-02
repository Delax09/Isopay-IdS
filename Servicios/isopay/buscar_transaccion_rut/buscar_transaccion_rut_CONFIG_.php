<?php

include(dirname(__FILE__)."/../../Servicios_Func.php");

abstract class buscar_transaccion_rut_CONFIG_ extends Servicios_Func
{
	
	public function getDescripcion()
	{
		
		
		return 'QnVzY2EgbGFzIHRyYW5zYWNjaW9uZXMgZGUgdW5hIGVtcHJlc2EgZW4gZXNwZWNpZmljbyAoZGViZSBpbmNsdWlyIGVsIHJ1dCB5IGVsIHRpcG8p';
		
		
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
							
							)
							
		);
		
	}
	
	
	
	
}