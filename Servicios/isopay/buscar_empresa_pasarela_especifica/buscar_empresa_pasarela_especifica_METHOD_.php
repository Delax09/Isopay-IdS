<?php
include("buscar_empresa_pasarela_especifica_CONFIG_.php");
class buscar_empresa_pasarela_especifica_METHOD_ extends buscar_empresa_pasarela_especifica_CONFIG_
{
	
	
	public function Run($req_objeto)
	{

        $data = $req_objeto->request;

        $rut = $data->rut;
        $tipo = $data->tipo;

        if(!Validar::Rut($rut)):
            $response = array(
                "estatus" => false,
                "msg"	=> "Rut incorrecto"

            );


        else:

            $rut = Validar::FormatearRut($rut,"","" );

            Manager::Load("isopay","Empresa");
            $Empresa = Empresa::getInstance();

            Manager::Load("isopay","Pasarela");
            $Pasarela = Pasarela::getInstance();

            $CheckE = $Empresa->Find(array(
                "rut" => $rut,
                "tipo" => $tipo
            ));

            if(!$CheckE):

                $response = array(
                    "estatus" => false,
                    "msg"	=> "No existe la empresa"

                );

            else:

                $PkEmpresa = $CheckE[0]->getEmpresaId();
                $nombreEmpresa = $CheckE[0]->getNombre();
                $tipoEmpresa = $CheckE[0]->getTipo();


                Manager::Load("isopay","EmpresaPasarela");
                $EmpresaPasarela = EmpresaPasarela::getInstance();

                $CheckEP = $EmpresaPasarela->Find(array(
                    "empresa_id" => $PkEmpresa,
                ));

                $lista_empresas_pasarela = array(
                    "rut" => $rut,
                    "nombreEmpresa"     => $nombreEmpresa,
                    "tipoEmpresa"      => $tipoEmpresa,
                    "pasarelas"      => array()
                );


                foreach ($CheckEP as $empresa_pasarela) {


                    $CheckP = $Pasarela->Find(array(
                        "pasarela_id" => $empresa_pasarela->getPasarelaId(),
                    ));

                    $nombrePasarela = $CheckP[0]->getNombre();
                    $habilitado = $empresa_pasarela->getHabilitada();

                    $lista_empresas_pasarela["pasarelas"][] = array(
                        "nombrePasarela" => $nombrePasarela,
                        "habilitada"     => $habilitado,
                    );
                }


                if(!$lista_empresas_pasarela):

                    $response = array(
                        "estatus" => false,
                        "msg" => "La empresa no tiene relaciones"
                    );

                else:


                    $response = array(
                        "estatus" => true,
                        "msg"	=> "Empresa vinculada con " . count($lista_empresas_pasarela['pasarelas']) . " pasarela(s) de pago.",
                        "data"	=> $lista_empresas_pasarela

                    );



                endif;

            endif;

        endif;



        return $this->Reponse($req_objeto ,$response);



    }
	
	
	
}