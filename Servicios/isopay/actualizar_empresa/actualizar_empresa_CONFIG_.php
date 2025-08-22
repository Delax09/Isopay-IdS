<?php

include(dirname(__FILE__)."/../../Servicios_Func.php");

abstract class actualizar_empresa_CONFIG_ extends Servicios_Func
{
	
	public function getDescripcion()
	{
		
		
		return 'YWN0dWFsaXphIHVuYSBlbXByZXNh';
		
		
	}
	
	public function getResponse()
	{
		
		
		return '';
		
		
	}
	
	
	public function getRequest()
	{
		
		return array(
						"empresa_id" 		=> array(
													"tipo" 			=> "integer",
													"largo" 		=> "11",	
													"requerido" 	=> true,
													"largo_exacto" 	=> false,
													"desc" 			=> "Representa la clave primaria",
							
							),
"nombre" 		=> array(
													"tipo" 			=> "string",
													"largo" 		=> "50",	
													"requerido" 	=> false,
													"largo_exacto" 	=> false,
													"desc" 			=> "Nombre de la empresa a actualizar",
							
							),
"rut" 		=> array(
													"tipo" 			=> "string",
													"largo" 		=> "20",	
													"requerido" 	=> false,
													"largo_exacto" 	=> false,
													"desc" 			=> "Rut de la emrpesa a actualizar",
							
							),
"tipo" 		=> array(
													"tipo" 			=> "integer",
													"largo" 		=> "1",	
													"requerido" 	=> false,
													"largo_exacto" 	=> false,
													"desc" 			=> "Indica el tipo de empresa a la que corresponnde",
							
							)
							
		);
		
	}
	
	
	
	
}