<?php
include("consultar_transaccion_CONFIG_.php");
class consultar_transaccion_METHOD_ extends consultar_transaccion_CONFIG_
{


    public function Run($req_objeto)
    {

        $data = $req_objeto->request;

        // Datos de la orden de pago
        $apiKey = trim($data->apiKey);
        $secretKey = trim($data->secretKey);
        $token = $data->token;
        $pasarela = $data->pasarela;


        // Parámetros de la orden
        $params = array(
            "apiKey" => $apiKey,
            "secretKey" => $secretKey,
            "token" => $token,
            "pasarela" => $pasarela,
        );

        Manager::Load("isopay","Transaccion");
        $Transaccion = Transaccion::getInstance();
        Manager::Load("isopay", "HistorialTransaccion");
        $Historial = HistorialTransaccion::getInstance();

        $Check1 = $Transaccion->Find(array(
            "numero_orden_local" => $token,
        ));
        $Check2 = $Transaccion->Find(array(
            "token" => $token,
        ));

        if(!$Check1 && !$Check2):

            $response = array(
                "estatus" => false,
                "msg"	=> "La orden de pago no existe."

            );

        else:

            if ($pasarela === 1): // 1 es el identificador de pasarela flow

                $DataPasarela = Flow::ConsultarTransaccion($params);
                $estado_consulta = $DataPasarela['status'];
                if ($estado_consulta === 1):
                    $estado_consulta = "pendiente";
                elseif ($estado_consulta === 2):
                    $estado_consulta = "pagado";
                elseif ($estado_consulta === 3):
                    $estado_consulta = "rechazado";
                elseif ($estado_consulta === 4):
                    $estado_consulta = "anulado";
                endif;

            elseif ($pasarela === 2): // 2 es el identificador de pasarela flow

                $DataPasarela = Khipu::ConsultarTransaccion($params);

            elseif ($pasarela === 3): // 3 es el identificador de pasarela mercadopago

                $DataPasarela = MercadoPago::ConsultarTransaccion($params);

            elseif ($pasarela === 4): // 4 es el identificador de pasarela transbank

                $DataPasarela = TransBank::ConsultarTransaccion($params);

            endif;

            //bucar la transaccion mediante el token
            $transaccioninfo = $Transaccion->Find(array(
                'token' => $token
            ));
            $transaccion_id = $transaccioninfo[0]->getTransaccionId();

            //bucar el historial mediante el id de transaccion
            $historialinfo = $Historial->Find(array(
                'transaccion_id' => $transaccion_id
            ));
            $estado_historial = $historialinfo[0]->getEstadoActual();

            //comparamos el estado recibido de la consulta y el de la base de datos
            if (strtolower($estado_consulta) !== strtolower($estado_historial)):
                $historial_transaccion = array(
                    'transaccion_id' => $transaccion_id,
                    'estado_anterior' => $estado_historial,
                    'estado_actual' => $estado_consulta,
                );

                $DaoH = $Historial->getEmptyDao();
                $DaoH->setEstadoAnterior($historial_transaccion['estado_anterior']);
                $DaoH->setEstadoActual($historial_transaccion['estado_actual']);
                $DaoH->setTransaccionId($historial_transaccion['transaccion_id']);
                $DaoH->setCdate(date("YmdHis"));
                //$Historial->setDao($DaoH)->Save();

            endif;

            $response = $DataPasarela;


        endif;


        return $this->Reponse($req_objeto ,$response);





    }


}