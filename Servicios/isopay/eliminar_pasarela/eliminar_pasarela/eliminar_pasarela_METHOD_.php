<?php
include("eliminar_pasarela_CONFIG_.php");
class eliminar_pasarela_METHOD_ extends eliminar_pasarela_CONFIG_
{
	
	
	public function Run($req_objeto)
	{

        $data = $req_objeto->request;

        Manager::Load("isopay","Pasarela");
        $Pasarela = Pasarela::getInstance();

        $nombre = strtolower(trim($data->nombre));

        $Check = $Pasarela->Find(array(
            "nombre" => $nombre,


        ));

        if(!$Check):

            $response = array(
                "estatus" => false,
                "msg"	=> "La pasarela de pago no existe"

            );

        else:

            $pasarelaDao = $Check[0];
            $pasarela_id = $pasarelaDao->getPasarelaId();

            $DaoE = $Pasarela->getId($pasarela_id);
            $DaoE->setNombre($nombre);

            $Pasarela->setDao($DaoE)->Delete();

            $response = array(
                "estatus" => true,
                "msg"	=> "Pasarela de Pago Eliminada",
                "data"	=> array("pasarela_pago_id" => $pasarela_id,"nombre" => $nombre)

            );


        endif;


        return $this->Reponse($req_objeto ,$response);




    }
	
	
	
}