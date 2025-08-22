<?php
include("buscar_empresa_pasarela_global_CONFIG_.php");
class buscar_empresa_pasarela_global_METHOD_ extends buscar_empresa_pasarela_global_CONFIG_
{
	
	
	public function Run($req_objeto)
	{

        $data = $req_objeto->request;

        Manager::Load("isopay", "Empresa");
        $Empresa = Empresa::getInstance();

        Manager::Load("isopay", "Pasarela");
        $Pasarela = Pasarela::getInstance();

        Manager::Load("isopay", "EmpresaPasarela");
        $EmpresaPasarela = EmpresaPasarela::getInstance();

        // Obtener TODAS las empresas
        $empresas = $Empresa->Find();

        $lista_empresas_pasarelas = array();

        foreach ($empresas as $empresa) {
            $empresa_id = $empresa->getEmpresaId();
            $nombreEmpresa = $empresa->getNombre();
            $rutEmpresa = $empresa->getRut();
            $tipoEmpresa = $empresa->getTipo();

            // Buscar pasarelas vinculadas a la empresa actual
            $pasarelasVinculadas = array();
            $empresaPasarelas = $EmpresaPasarela->Find(array(
                "empresa_id" => $empresa_id
            ));

            foreach ($empresaPasarelas as $empresaPasarela) {
                $pasarelaId = $empresaPasarela->getPasarelaId();
                $pasarela = $Pasarela->Find(array(
                    "pasarela_id" => $pasarelaId
                ));

                if ($pasarela) {
                    $nombrePasarela = $pasarela[0]->getNombre();
                    $habilitado = $empresaPasarela->getHabilitada();

                    $pasarelasVinculadas[] = array(
                        "nombrePasarela" => $nombrePasarela,
                        "habilitada"     => $habilitado
                    );
                }
            }

            $lista_empresas_pasarelas[] = array(
                "rut" => $rutEmpresa,
                "nombreEmpresa" => $nombreEmpresa,
                "tipoEmpresa" => $tipoEmpresa,
                "pasarelas" => $pasarelasVinculadas
            );
        }

        // Preparar respuesta
        $response = array(
            "estatus" => true,
            "msg"     => "Empresas y pasarelas de pago cargadas correctamente.",
            "data"    => $lista_empresas_pasarelas
        );




        return $this->Reponse($req_objeto ,$response);


    }
	
	
	
}