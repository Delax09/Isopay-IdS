<?php
include("confirmacion_transbank_CONFIG_.php");
class confirmacion_transbank_METHOD_ extends confirmacion_transbank_CONFIG_
{
	
	
	public function Run($req_objeto)
	{	

		$data = $req_objeto->request;


        $response = TRANSBANK::ConfirmacionTransbank($data);

		//$response = true;
		
		
		
		return $this->Reponse($req_objeto ,$response);
		
		
	
	}
	
	
	
}