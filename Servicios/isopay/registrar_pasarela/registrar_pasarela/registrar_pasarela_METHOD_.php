<?php
include("registrar_pasarela_CONFIG_.php");
class registrar_pasarela_METHOD_ extends registrar_pasarela_CONFIG_
{
	
	
	public function Run($req_objeto)
	{


        $data = $req_objeto->request;

        $response = true;


        Manager::Load("isopay","Pasarela");
        $Pasarela = Pasarela::getInstance();

        $nombre = strtolower(trim($data->nombre));

        $Check = $Pasarela->Find(array(
            "nombre" => $nombre,


        ));

        if ($Check):
            $response = array(
                "estatus" => false,
                "msg"	=> "La pasarela de pago {$nombre} ya existe"

            );

        else:

            $DaoE = $Pasarela->getEmptyDao();
            $DaoE->setNombre($nombre);
            $DaoE->setEstado(trim($data->estado));
            $DaoE->setCdate(date("YmdHis"));

            $Pasarela->setDao($DaoE)->Save();

            $response = array(
                "estatus" => true,
                "msg"	=> "Pasarela de pago resgistrada",
                "data"	=> $DaoE->_getDaoDescription()

            );

        endif;

        return $this->Reponse($req_objeto ,$response);





    }
	
	
	
}