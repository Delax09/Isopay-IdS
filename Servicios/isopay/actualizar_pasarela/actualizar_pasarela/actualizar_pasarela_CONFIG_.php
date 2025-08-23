<?php

include(dirname(__FILE__)."/../../Servicios_Func.php");

abstract class actualizar_pasarela_CONFIG_ extends Servicios_Func
{
	
	public function getDescripcion()
	{
		
		
		return 'QWN0dWFsaXphIGxhIGluZm9ybWFjaW9uIGRlIGxhIHBhc2FyZWxhIGRlIHBhZ28=';
		
		
	}
	
	public function getResponse()
	{
		
		
		return '';
		
		
	}
	
	
	public function getRequest()
	{
		
		return array(
						"pasarela_id" 		=> array(
													"tipo" 			=> "integer",
													"largo" 		=> "11",	
													"requerido" 	=> true,
													"largo_exacto" 	=> false,
													"desc" 			=> "",
							
							),
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