<?php
include("actualizar_pasarela_CONFIG_.php");
class actualizar_pasarela_METHOD_ extends actualizar_pasarela_CONFIG_
{
	
	
	public function Run($req_objeto)
	{


        $data = $req_objeto->request;

        Manager::Load("isopay","Pasarela");
        $Pasarela = Pasarela::getInstance();


        $DaoE = $Pasarela->getId($data->pasarela_id);

        if(!$DaoE):

            $response = array(
                "estatus" => false,
                "msg"	=> "Pasarela de pago no registrada"

            );

        else:


            $DaoE->setNombre(strtolower(trim($data->nombre)));
            $DaoE->setEstado(trim($data->estado));

            $Pasarela->setDao($DaoE)->Save();

            $response = array(
                "estatus" => true,
                "msg"	=> "Pasarela de pago actualizada correctamente",
                "data"	=> $DaoE->_getDaoDescription()

            );


        endif;



        return $this->Reponse($req_objeto ,$response);




    }
	
	
	
}