<?php
include("registrar_orden_pago_CONFIG_.php");
class registrar_orden_pago_METHOD_ extends registrar_orden_pago_CONFIG_
{
	
	
	public function Run($req_objeto)
    {

        /*
            Flow
            https://sandbox.flow.cl/app/web/login.php
            enpierattinicl@gmail.com
            Fl0w.2025.!
            Api Key : 398F8143-118E-4693-802A-61384ELC3808
            Secret Key : 757e1587a8476847dc038de1a132521bf8c573ce
         */

        $data = $req_objeto->request;

        // Datos de la orden de pago
        $apiKey = trim($data->apiKey);
        $secretKey = trim($data->secretKey);
        $monto = $data->monto;
        $numeroOrden = $data->numeroOrden;
        $concepto = $data->concepto;
        $currency = "CLP";
        $correo = $data->correo;
        $empresaRut = $data->empresaRut;
        $tipoEmpresa = $data->tipoEmpresa;
        $pasarela = $data->pasarela;
        $urlConfirmation = $data->urlConfirmation;
        $urlReturn = $data->urlReturn;

        $empresaRut = Validar::FormatearRut($empresaRut, "", "");


        // Parámetros de la orden
        $params = array(
            "apiKey" => $apiKey,
            "secretKey" => $secretKey,
            "commerceOrder" => $numeroOrden, // Número de la orden en tu sistema
            "subject" => $concepto, // Título de la orden
            "currency" => $currency,
            "amount" => $monto, // Monto en pesos chilenos
            "email" => $correo,
            "urlConfirmation" => $urlConfirmation, // URL para notificación de pago
            "urlReturn" => $urlReturn // URL para redirección post pago
        );

        Manager::Load("isopay", "Transaccion");
        $Transaccion = Transaccion::getInstance();
        Manager::Load("isopay", "Empresa");
        $Empresa = Empresa::getInstance();
        Manager::Load("isopay", "Pasarela");
        $Pasarela = Pasarela::getInstance();
        Manager::Load("isopay", "EmpresaPasarela");
        $EmpresaPasarela = EmpresaPasarela::getInstance();
        Manager::Load("isopay", "HistorialTransaccion");
        $historial = HistorialTransaccion::getInstance();


        $CheckE = $Empresa->Find(array(
            "rut" => $empresaRut,
            "tipo" => $tipoEmpresa
        ));
        $CheckP = $Pasarela->Find(array(
            "pasarela_id" => $pasarela,
        ));
        $CheckO = $Transaccion->Find(array(
            "numero_orden_local" => $numeroOrden,
        ));

        if (!$CheckE):
            $response = array(
                "estatus" => false,
                "msg" => "Empresa no registrada"
            );

        elseif (!$CheckP):
            $response = array(
                "estatus" => false,
                "msg" => "Pasarela no registrada"
            );

        elseif ($CheckO):
            $response = array(
                "estatus" => false,
                "msg" => "La orden de pago ya existe"
            );

        else:
            $IdEmpresa = $CheckE[0]->getEmpresaId();
            $CheckEP = $EmpresaPasarela->Find(array(
                "empresa_id" => $IdEmpresa,
                "pasarela_id" => $pasarela
            ));

            if (!$CheckEP):
                $response = array(
                    "estatus" => false,
                    "msg" => "La empresa no tiene acceso a esta pasarela"
                );

            elseif ($CheckEP[0]->getHabilitada() == 2):
                $response = array(
                    "estatus" => false,
                    "msg" => "La pasarela está deshabilitada para esta empresa"
                );

            else:

                $params_historial = array(
                    "apiKey" => $apiKey,
                    "secretKey" => $secretKey, // + $DataPasarela["token"]
                    "pasarela" => $pasarela
                );

                if ($pasarela === 1): // 1 es el identificador de pasarela flow

                    // Llamada a la clase Flow
                    $DataPasarela = Flow::GenerarPago($params);
                    $params_historial["token"] = $DataPasarela["token"];
                    $consulta = Flow::ConsultarTransaccion($params_historial);
                    $estado_pago = $consulta['status'];

                    // traduccion del estado de pago desde la consulta a flow
                    if ($estado_pago === 1):
                        $estado_pago = "pendiente";
                    elseif ($estado_pago === 2):
                        $estado_pago = "pagado";
                    elseif ($estado_pago === 3):
                        $estado_pago = "rechazado";
                    elseif ($estado_pago === 4):
                        $estado_pago = "anulado";


                    elseif ($pasarela === 2): // 2 es el identificador de pasarela Khipu

                        $DataPasarela = Khipu::GenerarPago($params);
                        $params_historial["token"] = $DataPasarela["token"];
                        $consulta = Khipu::ConsultarTransaccion($params_historial);
                        $estado_pago = $consulta['status'];

                    elseif ($pasarela === 3): // 3 es el identificador de pasarela mercadopago

                        $DataPasarela = MercadoPago::GenerarPago($params);
                        $params_historial["token"] = $DataPasarela["token"];
                        $consulta = MercadoPago::ConsultarTransaccion($params_historial);
                        $estado_pago = $consulta['status'];

                    elseif ($pasarela === 4): // 4 es el identificador de pasarela transbank

                        $DataPasarela = TransBank::GenerarPago($params);
                        $params_historial["token"] = $DataPasarela["token"];
                        $consulta = TransBank::ConsultarTransaccion($params_historial);
                        $estado_pago = $consulta['status'];

                    endif;

                    if (!$DataPasarela["estatus"]):

                        $response = array(
                            "estatus" => false,
                            "msg" => "No se guardo la orden de pago",
                            "response" => $DataPasarela
                        );

                    else:

                        $DaoT = $Transaccion->getEmptyDao();
                        $DaoT->setMonto($monto);
                        $DaoT->setConcepto($concepto);
                        $DaoT->setEstado("Pendiente");
                        $DaoT->setNumeroOrdenLocal($numeroOrden);
                        $DaoT->setNumeroOrdenPasarela($DataPasarela["order"]);
                        $DaoT->setToken($DataPasarela["token"]);
                        $DaoT->setUrl($DataPasarela["url"]);
                        $DaoT->setEmpresaId($IdEmpresa);
                        $DaoT->setPasarelaId($pasarela);
                        $DaoT->setCdate(date("YmdHis"));
                        
                        $Transaccion->setDao($DaoT)->Save();

                        // guardamos en historial de transaccion
                        $historial_transaccion = array(
                            "estado_anterior" => "",
                            "estado_actual" => $estado_pago,
                            "transaccion_id" => $DaoT->getTransaccionId()
                        );

                        $DaoH = $historial->getEmptyDao();
                        $DaoH->setEstadoAnterior($historial_transaccion['estado_anterior']);
                        $DaoH->setEstadoActual($historial_transaccion['estado_actual']);
                        $DaoH->setTransaccionId($historial_transaccion['transaccion_id']);
                        $DaoH->setCdate(date("YmdHis"));
                        $historial->setDao($DaoH)->Save();

                        $response = array(
                            "estatus" => true,
                            "msg" => "Orden de pago registrada",
                            "data bd" => $DaoT->_getDaoDescription(),
                            "data pasarela" => $DataPasarela

                        );

                    endif;

                endif;

            endif;
            return $this->Reponse($req_objeto, $response);

        endif;
    }
}