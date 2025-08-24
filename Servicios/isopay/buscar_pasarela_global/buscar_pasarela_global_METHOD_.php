<?php
include("buscar_pasarela_global_CONFIG_.php");
class buscar_pasarela_global_METHOD_ extends buscar_pasarela_global_CONFIG_
{
	
	
	public function Run($req_objeto)
	{
        $data = $req_objeto->request;

        // Cargamos el manager de empresas
        Manager::Load("isopay", "Pasarela");
        $Pasarela = Pasarela::getInstance();

        // Obtenemos todas las empresas sin filtros
        $pasarelas = $Pasarela->Find(array());

        if (!$pasarelas || empty($pasarelas)) {


            $response = array(
                "estatus" => false,
                "msg"     => "No existen pasarelas de pago registradas"
            );


        } else {


            $lista_pasarelas = array();

            foreach ($pasarelas as $pasarela) {
                $lista_pasarelas[] = array(
                    "id"     => $pasarela->getPasarelaId(),
                    "nombre" => $pasarela->getNombre(),
                    "estado"    => $pasarela->getEstado(),
                    "date"   => $pasarela->getCdate()
                );
            }


            $response = array(
                "estatus" => true,
                "msg"     => "Pasarelas de pago encontradas",
                "data"    => $lista_pasarelas
            );


        }


        return $this->Reponse($req_objeto ,$response);


    }
	
	
	
}
