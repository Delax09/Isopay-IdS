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
}
