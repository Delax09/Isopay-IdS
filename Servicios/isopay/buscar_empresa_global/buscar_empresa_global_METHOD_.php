<?php
include("buscar_empresa_global_CONFIG_.php");
class buscar_empresa_global_METHOD_ extends buscar_empresa_global_CONFIG_
{
	
	
	public function Run($req_objeto)
	{	

		$data = $req_objeto->request;


        // Cargamos el manager de empresas
        Manager::Load("isopay", "Empresa");
        $Empresa = Empresa::getInstance();

        // Obtenemos todas las empresas sin filtros
        $empresas = $Empresa->Find(array());

        if (!$empresas || empty($empresas)) {
            $response = array(
                "estatus" => false,
                "msg"     => "No existen empresas registradas"
            );
        } else {
            $lista_empresas = array();

            foreach ($empresas as $empresa) {
                $lista_empresas[] = array(
                    "id"     => $empresa->getEmpresaId(),
                    "nombre" => $empresa->getNombre(),
                    "rut"    => $empresa->getRut(),
                    "tipo"   => $empresa->getTipo(),
                    "date"   => $empresa->getCdate()
                );
            }

            $response = array(
                "estatus" => true,
                "msg"     => "Empresas encontradas",
                "data"    => $lista_empresas
            );
        }
		
		
		return $this->Reponse($req_objeto ,$response);
		
		
	
	}
	
	
	
}