<?php

include(dirname(__FILE__)."/../../Servicios_Func.php");

abstract class registrar_empresa_CONFIG_ extends Servicios_Func
{
	
	public function getDescripcion()
	{
		
		
		return 'UmVnaXN0cmEgdW5hIGVtcHJlc2E=';
		
		
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
													"largo" 		=> "50",	
													"requerido" 	=> true,
													"largo_exacto" 	=> false,
													"desc" 			=> "Nombre de empresa",
							
							),
"rut" 		=> array(
													"tipo" 			=> "string",
													"largo" 		=> "20",	
													"requerido" 	=> true,
													"largo_exacto" 	=> false,
													"desc" 			=> "Rut de la empresa",
							
							),
"tipo" 		=> array(
													"tipo" 			=> "integer",
													"largo" 		=> "1",	
													"requerido" 	=> true,
													"largo_exacto" 	=> false,
													"desc" 			=> "Indica a que tipo de empresa corresponde",
							
							)
							
		);
		
	}
	
	
	
	
}