<?php

include(dirname(__FILE__)."/../../Servicios_Func.php");

abstract class eliminar_pasarela_CONFIG_ extends Servicios_Func
{
	
	public function getDescripcion()
	{
		
		
		return 'RWxpbWluYSBhIHVuYSBwYXNhcmVsYSBkZSBwYWdv';
		
		
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
							
							)
							
		);
		
	}
	
	
	
	
}
