<?php
include("actualizar_empresa_pasarela_CONFIG_.php");
class actualizar_empresa_pasarela_METHOD_ extends actualizar_empresa_pasarela_CONFIG_
{
	
	
	public function Run($req_objeto)
	{


        $data = $req_objeto->request;

        $response = true;

        $rut = $data->rut;
        $pasarelaId = $data->pasarela;
        $habilitada = $data->habilitada;
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




                    if(!$CheckEP):

                        $response = array(
                            "estatus" => false,
                            "msg"	=> "La empresa no esta vinculada a la pasarela ". $nombrePasarela

                        );

                    else:

                        $DaoE = $CheckEP[0];
                        $DaoE->setEmpresaId($PkEmpresa);
                        $DaoE->setPasarelaId($pasarelaId);
                        $DaoE->setHabilitada($habilitada);

                        $EmpresaPasarela->setDao($DaoE)->Save();

                        $response = array(
                            "estatus" => true,
                            "msg"	=> "El vinculo de la empresa con la pasarela de pago: ".$nombrePasarela." fue actualizado correctamente",
                            "data"	=> $DaoE->_getDaoDescription()

                        );

                    endif;

                endif;

            endif;

        endif;

        return $this->Reponse($req_objeto ,$response);



    }
	
	
	
}