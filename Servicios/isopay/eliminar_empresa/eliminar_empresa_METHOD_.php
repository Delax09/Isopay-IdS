<?php
include("eliminar_empresa_CONFIG_.php");
class eliminar_empresa_METHOD_ extends eliminar_empresa_CONFIG_
{
	
	
	public function Run($req_objeto)
	{	

		$data = $req_objeto->request;
		
		$rut = $data->rut;

        if(!Validar::Rut($rut)):

            $response = array(
                "estatus" => false,
                "msg"	=> "Rut incorrecto"

            );


        else:


            $rut = Validar::FormatearRut($rut,"","" );

            Manager::Load("isopay","Empresa");
            $Empresa = Empresa::getInstance();

            $Check = $Empresa->Find(array(
                "rut" => $rut,
                "tipo" => $data->tipo


            ));

            if(!$Check):

                $response = array(
                    "estatus" => false,
                    "msg"	=> "La empresa no existe"

                );

            else:

                $DaoE = $Check[0];
                $empresa_id = $DaoE->getEmpresaId();

                $Empresa->setDao($DaoE)->Delete();

                $response = array(
                    "estatus" => true,
                    "msg"	=> "Empresa Eliminada",
                    "data"	=> array("empresa_id" => $empresa_id,"rut" => $rut,"tipo" => $data->tipo)

                );


            endif;



        endif;
		
		
		
		return $this->Reponse($req_objeto ,$response);
		
		
	
	}
	
	
	
}