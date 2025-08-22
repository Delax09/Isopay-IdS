<?php

class MercadoPago
{
    public static function GenerarPago($params)
    {
        
        $accessToken = $params["apiKey"];

        $urlBase = "https://api.mercadopago.com/checkout/preferences";

        // Datos del pago
        $data = [
            "title" => $params["subject"],
            "quantity" => 1,
            "unit_price" => $params["amount"],
            "currency_id" => $params["currency"] // Cambia según tu moneda: CLP, ARS, BRL, etc.
        ];

        // Armamos el cuerpo del pago
        $body = [
            "items" => [$data],
            "payer" => [
                "name" => "",
                "email" => $params["email"]
            ],
            "back_urls" => [
                "success" => $params["urlConfirmation"],
                "failure" => $params["urlReturn"],
                "pending" => $params["urlReturn"]
            ],
            "auto_return" => "approved",
            "external_reference" => strval($params["commerceOrder"])
        ];

        // Inicializar cURL
        $ch = curl_init($urlBase);

        // Configurar la solicitud
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json",
            "Authorization: Bearer $accessToken"
        ]);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));

        // Ejecutar la solicitud
        $response = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);

        if ($error):

            $response = array(
                "estatus" => false,
                "msg" => "cURL Error: $error"
            );

        else:

            $responseData = json_decode($response, true);

            if (!isset($responseData["id"])):
                $response = array(
                    "estatus" => false,
                    "msg" => $responseData["message"] ?? "Error desconocido",
                    "response mp" => $responseData
                );

            else:

                if(Init::MERCADOPAGO_STATUS == false):
                    $url = $responseData["sandbox_init_point"];
                else:
                    $url = $responseData["init_point"];
                endif;

                $response = array(
                    "estatus" => true,
                    "token" => $responseData["id"],
                    "url" => $url,
                    "response_mercadopago" => $responseData
                );

            endif;

        endif;




        return $response;

    }

    public static function ConsultarTransaccion($params)
    {

        $accessToken = $params["apiKey"];

        // Paso 1: Obtener info de la preferencia
        $preference_id = $params["token"];
        $urlPref = "https://api.mercadopago.com/checkout/preferences/$preference_id";

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $urlPref,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer $accessToken"
            )
        ));
        $responsePref = curl_exec($curl);
        curl_close($curl);

        $infoTransaccion = json_decode($responsePref, true);

        if (!isset($infoTransaccion["external_reference"])):
            $response = [
                "estatus" => false,
                "msg" => "No se encontró external_reference en la preferencia",
                "response" => $infoTransaccion
            ];
        else:
            $external_reference = $infoTransaccion["external_reference"];

            // Paso 2: Buscar pagos asociados a esa referencia
            $urlPagos = "https://api.mercadopago.com/v1/payments/search?external_reference=" . urlencode($external_reference);
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $urlPagos,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTPHEADER => array(
                    "Authorization: Bearer $accessToken"
                )
            ));

            $responsePagos = curl_exec($curl);
            curl_close($curl);

            $responseData = json_decode($responsePagos, true);

            if (!isset($responseData["results"]) || count($responseData["results"]) === 0):
                $response = [
                    "estatus" => false,
                    "msg" => "No se encontraron pagos con esa referencia",
                    "response" => $responseData
                ];
            else:
                // Tomamos el primer pago (puedes recorrerlos si necesitas más)
                $pago = $responseData["results"][0];

                Manager::Load("isopay","Transaccion");
                $Transaccion = Transaccion::getInstance();
                $Check = $Transaccion->Find(array(
                    "token" => $preference_id,
                ));
                $subject = $Check[0]->getConcepto();

                $response = [
                    "estatus" => true,
                    "subject" => $subject,
                    "status" => $pago["status"],           // Estado: approved, rejected, pending, etc.
                    "status_detail" => $pago["status_detail"], // Detalle más específico
                    "response_mercadopago" => $responseData
                ];

            endif;

        endif;


        /*
        status
            pending
            approved
            authorized

        status_detail
            accredited
            partially_refunded
            partially_bpp_refunded

        */
        return $response;
    }
}