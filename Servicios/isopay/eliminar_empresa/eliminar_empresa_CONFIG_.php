<?php

include(dirname(__FILE__)."/../../Servicios_Func.php");

abstract class eliminar_empresa_CONFIG_ extends Servicios_Func
{
	
	public function getDescripcion()
	{
		
		
		return 'ZWxpbWluYXIgdW5hIGVtcHJlc2EgcmVnaXN0cmFkYQ==';
		
		
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
													"largo" 		=> "50",	
													"requerido" 	=> true,
													"largo_exacto" 	=> false,
													"desc" 			=> "Rut",
							
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