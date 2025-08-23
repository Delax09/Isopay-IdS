<?php

class Khipu
{
    public static function GenerarPago($params)
    {

        $apiKey = $params["apiKey"];

        $urlBase = "https://payment-api.khipu.com/v3/payments";

        $payload = array(
            "amount" => $params["amount"],
            "currency" => $params["currency"],
            "subject" => $params["subject"],
            "transaction_id" => strval($params["commerceOrder"]),
            "return_url" => $params["urlReturn"],
            "cancel_url" => $params["urlReturn"],

        );

        // Preparar cURL
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => $urlBase,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($payload),
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json",
                "x-api-key: $apiKey"
            ]
        ]);

        $response = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);

        // Manejo de respuesta
        if ($error):

            $response = array(
                "estatus" => false,
                "msg" => "cURL Error: $error"
            );

        else:
            $responseData = json_decode($response, true);

            if (!isset($responseData["payment_url"])):
                $response = array(
                    "estatus" => false,
                    "msg" => $responseData["message"] ?? "Error desconocido",
                    "response khipu" => $responseData
                );

            else:

                $response = array(
                    "estatus" => true,
                    "token" => $responseData["payment_id"],
                    "url" => $responseData["simplified_transfer_url"],
                    "response_khipu" => $responseData
                );

            endif;

        endif;


        return $response;

    }


    public static function ConsultarTransaccion($params)
    {

        $apiKey = $params["apiKey"];

        $token = $params["token"];

        $urlBase = "https://payment-api.khipu.com/v3/payments/";

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => $urlBase . $token,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "x-api-key: $apiKey"
            ]
        ]);

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

            if (!isset($responseData["payment_url"])):
                $response = array(
                    "estatus" => false,
                    "msg" => $responseData["message"] ?? "Error desconocido",
                    "response khipu" => $responseData
                );

            else:

                $response = array(
                    "estatus" => true,
                    "subject" => $responseData["subject"],
                    "status" => $responseData["status"],
                    "status_detail" => $responseData["status"],
                    "response_khipu" => $responseData
                );

            endif;

        endif;


        /* Estados posibles (status):
          - "pending"
          - "verifying"
          - "done"

         Detalle de estado (status_detail):
          - "pending"
          - "normal"
          - "marked-paid-by-receiver"
          - "rejected-by-payer"
          - "marked-as-abuse"
          - "reversed"
       * */

        return $response;
    }


}