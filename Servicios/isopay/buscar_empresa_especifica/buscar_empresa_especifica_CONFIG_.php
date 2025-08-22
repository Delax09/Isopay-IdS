<?php

include(dirname(__FILE__)."/../../Servicios_Func.php");

abstract class buscar_empresa_especifica_CONFIG_ extends Servicios_Func
{
	
	public function getDescripcion()
	{
		
		
		return 'QnVzY2EgdW5hIGVtcHJlc2EgZXNwZWNpZmljYQ==';
		
		
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