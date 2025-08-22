<?php

include(dirname(__FILE__)."/../../Servicios_Func.php");

abstract class eliminar_empresa_pasarela_CONFIG_ extends Servicios_Func
{
	
	public function getDescripcion()
	{
		
		
		return 'RWxpbWluYSB1bmEgcmVsYWNpb24gZW50cmUgdW5hIGVtcHJlc2EgeSB1bmEgIHBhc2FyZWxhIGRlIHBhZ28=';
		
		
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