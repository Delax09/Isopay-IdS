<?php
include("buscar_empresa_especifica_CONFIG_.php");
class buscar_empresa_especifica_METHOD_ extends buscar_empresa_especifica_CONFIG_
{
	
	
	public function Run($req_objeto)
	{	

		$data = $req_objeto->request;
		
		$response = true;

        //Arr::View($data);#IMPRIMIR UN ARREGLO

        $rut = $data->rut;
        $tipo = $data->tipo;

        //LOS HELPER ESTAN EN LA RAIZ => Carpeta Helper
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
                "tipo" => $tipo


            ));
            

            if(!$Check):

                $response = array(
                    "estatus" => false,
                    "msg"	=> "La empresa no existe"

                );

            else:


                $id = $Check[0]->getEmpresaId();
                $nombre = $Check[0]->getNombre();
                $date = $Check[0]->getCdate();
                //$CheckData = json_decode($Check, true);

                $response = array(
                    "estatus" => true,
                    "msg"	=> "Empresa Encontrada",
                    "id"	=> $id,
                    "nombre" => $nombre,
                    "rut"	=> $rut,
                    "tipo"	=> $tipo,
                    "date"	=> $date,
                    //"data"	=> $CheckData

                );


            endif;

        endif;




		return $this->Reponse($req_objeto ,$response);
		
		
	
	}
	
	
	
}