<?php

include(dirname(__FILE__)."/../../Servicios_Func.php");

abstract class buscar_transaccion_token_CONFIG_ extends Servicios_Func
{
	
	public function getDescripcion()
	{
		
		
		return 'QnVzY2FyIGluZm9ybWFjaW9uIGRlIHRyYW5zYWNjaW9uIHBvciB0b2tlbg==';
		
		
	}
	
	public function getResponse()
	{
		
		
		return '';
		
		
	}
	
	
	public function getRequest()
	{
		
		return array(
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