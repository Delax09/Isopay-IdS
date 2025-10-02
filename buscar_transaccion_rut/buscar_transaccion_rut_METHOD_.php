<?php
include("buscar_transaccion_rut_CONFIG_.php");
class buscar_transaccion_rut_METHOD_ extends buscar_transaccion_rut_CONFIG_
{


    public function Run($req_objeto)
    {
        $data = $req_objeto->request;
        $rut = $data->rut;
        $tipo = $data->tipo;

        if (!Validar::Rut($rut)):
            $response = array(
                "estatus" => false,
                "msg" => "Rut incorrecto"
            );
        else:
            $rut = Validar::FormatearRut($rut, "", "");

            // Cargar clases necesarias
            Manager::Load("isopay", "Empresa");
            $Empresa = Empresa::getInstance();

            Manager::Load("isopay", "Transaccion");
            $Transaccion = Transaccion::getInstance();

            // Buscar empresa por rut y tipo
            $CheckE = $Empresa->Find([
                "rut" => $rut,
                "tipo" => $tipo
            ]);

            if (!$CheckE):
                $response = array(
                    "estatus" => false,
                    "msg" => "La empresa no existe"
                );
            else:
                $PkEmpresa = $CheckE[0]->getEmpresaId();
                $nombreEmpresa = $CheckE[0]->getNombre();
                $tipoEmpresa = $CheckE[0]->getTipo();

                // Buscar transacciones asociadas a la empresa
                $listaTransacciones = $Transaccion->Find([
                    "empresa_id" => $PkEmpresa
                ]);

                $transacciones_data = [];

                foreach ($listaTransacciones as $T):

                    $transacciones_data[] = [
                        "transaccion_id" => $T->getTransaccionId(),
                        "monto" => $T->getMonto(),
                        "numero_orden_local" => $T->getNumeroOrdenLocal(),
                        "numero_orden_pasarela" => $T->getNumeroOrdenPasarela(),
                        "fecha_emision" => $T->getCdate(),
                        "concepto" => $T->getConcepto(),
                        "estado" => $T->getEstado(),
                        "token" => $T->getToken(),
                        "url" => $T->getUrl(),
                        "cdate" => $T->getCdate(),
                    ];

                endforeach;

                $response = array(
                    "estatus" => true,
                    "msg" => "Empresa encontrada",
                    "rut" => $rut,
                    "nombreEmpresa" => $nombreEmpresa,
                    "tipoEmpresa" => $tipoEmpresa,
                    "transacciones" => $transacciones_data
                );

            endif;

        endif;



        return $this->Reponse($req_objeto ,$response);



    }
	
	
	
}