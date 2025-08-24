<?php
include("estado_pasarela_CONFIG_.php");
class estado_pasarela_METHOD_ extends estado_pasarela_CONFIG_
{
	
	
	public function Run($req_objeto)
	{	

		$data = $req_objeto->request;
		
		$response = true;
		
		
		
		return $this->Reponse($req_objeto ,$response);
		
		
	
	}
	
	
	
}
