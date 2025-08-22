<?php
include("registrar_empresa_pasarela_CONFIG_.php");
class registrar_empresa_pasarela_METHOD_ extends registrar_empresa_pasarela_CONFIG_
{
	
	
	public function Run($req_objeto)
	{

        $data = $req_objeto->request;


        $rut = $data->rut;
        $habilitada = $data->habilitada;
        $pasarelaId = $data->pasarela;
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

                $CheckP = $Pasarela->Find(array(
                    "pasarela_id" => $pasarelaId,
                ));

                if(!$CheckP):

                    $response = array(
                        "estatus" => false,
                        "msg" => "No existe la pasarela de pago"
                    );

                else:

                    $PkEmpresa = $CheckE[0]->getEmpresaId();

                    $nombrePasarela = $CheckP[0]->getNombre();

                    Manager::Load("isopay","EmpresaPasarela");
                    $EmpresaPasarela = EmpresaPasarela::getInstance();

                    $CheckEP = $EmpresaPasarela->Find(array(
                        "empresa_id" => $PkEmpresa,
                        "pasarela_id" => $pasarelaId,
                    ));


                    if($CheckEP):

                        $response = array(
                            "estatus" => false,
                            "msg"	=> "La empresa ya tiene vinculado a la pasarela ". $nombrePasarela

                        );

                    else:

                        $DaoE = $EmpresaPasarela->getEmptyDao();
                        $DaoE->setEmpresaId($PkEmpresa);
                        $DaoE->setPasarelaId($pasarelaId);
                        $DaoE->setHabilitada($habilitada);
                        $DaoE->setCdate(date("YmdHis"));

                        $EmpresaPasarela->setDao($DaoE)->Save();

                        $response = array(
                            "estatus" => true,
                            "msg"	=> "Empresa vinculada con la pasarela de pago: ". $nombrePasarela,
                            "data"	=> $DaoE->_getDaoDescription()

                        );

                    endif;

                endif;

            endif;

        endif;

        return $this->Reponse($req_objeto ,$response);


    }
	
	
	
}