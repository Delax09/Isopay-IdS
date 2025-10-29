<?php
include("buscar_transaccion_token_CONFIG_.php");
class buscar_transaccion_token_METHOD_ extends buscar_transaccion_token_CONFIG_
{
	
	
	public function Run($req_objeto)
	{	

		$data = $req_objeto->request;
        $token = $data->token;




        Manager::Load("isopay", "Transaccion");
        $Transaccion = Transaccion::getInstance();

        $TransaccionInfo = $Transaccion->Find([
            "token" => $token
        ]);

        $T = $TransaccionInfo[0];

        if($TransaccionInfo):

            $response = array(
                "transaccion_id" => $T->getTransaccionId(),
                "monto" => $T->getMonto(),
                "numero_orden_local" => $T->getNumeroOrdenLocal(),
                "numero_orden_pasarela" => $T->getNumeroOrdenPasarela(),
                "fecha_emision" => $T->getCdate(),
                "concepto" => $T->getConcepto(),
                "estado" => $T->getEstado(),
                "token" => $T->getToken(),
                "url" => $T->getUrl(),
                "cdate" => $T->getCdate(),
            );
        else:

            $response = True;

        endif;

		return $this->Reponse($req_objeto ,$response);
		
		
	
	}
	
	
	
}