<?php
include("elimina_orden_pago_CONFIG_.php");
class elimina_orden_pago_METHOD_ extends elimina_orden_pago_CONFIG_
{
	
	
	public function Run($req_objeto)
	{	

		$data = $req_objeto->request;
		
		$response = true;
		
		
		
		return $this->Reponse($req_objeto ,$response);
		
		
	
	}
	
	
	
}