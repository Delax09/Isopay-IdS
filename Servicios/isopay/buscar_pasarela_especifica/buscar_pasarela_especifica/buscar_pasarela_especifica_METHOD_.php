<?php
include("buscar_pasarela_especifica_CONFIG_.php");
class buscar_pasarela_especifica_METHOD_ extends buscar_pasarela_especifica_CONFIG_
{
	
	
	public function Run($req_objeto)
	{

        $data = $req_objeto->request;

        $nombre = strtolower(trim($data->nombre));


        Manager::Load("isopay","Pasarela");
        $Pasarela = Pasarela::getInstance();

        $Check = $Pasarela->Find(array(
            "nombre" => $nombre

        ));


        if(!$Check):

            $response = array(
                "estatus" => false,
                "msg"	=> "La pasarela de pago no existe"

            );


        else:

            $id = $Check[0]->getPasarelaId();
            $estado = $Check[0]->getEstado();
            $date = $Check[0]->getCdate();
            //$CheckData = json_decode($Check, true);

            $response = array(
                "estatus" => true,
                "msg"	=> "Pasarela de pago Encontrada",
                "id"	=> $id,
                "nombre" => $nombre,
                "rut"	=> $estado,
                "date"	=> $date,
                //"data"	=> $CheckData

            );


        endif;



        return $this->Reponse($req_objeto ,$response);



    }
	
	
	
}