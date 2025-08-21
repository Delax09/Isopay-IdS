<?php

class Flow
{

    public static function GenerarPago($params)
    {


		if(Init::FLOW_STATUS == false):

			$urlBase = "https://sandbox.flow.cl/api";

		else:

			$urlBase = "https://flow.cl/api";

		endif;
        // Endpoint base de Flow


        // Parámetros para la orden
        $requestParams = array(
                            "apiKey" => $params["apiKey"],
                            "commerceOrder" => $params["commerceOrder"],
                            "subject" => $params["subject"],
                            "currency" => $params["currency"],
                            "amount" => $params["amount"],
                            "email" => $params["email"],
                            "urlConfirmation" => $params["urlConfirmation"],
                            "urlReturn" => $params["urlReturn"]
        );

        // Firmar con HMAC-SHA256
        $keys = array_keys($requestParams);
        sort($keys);
        $toSign = "";
        foreach ($keys as $key) {
            $toSign .= $key . trim($requestParams[$key]);
        }
        $signature = hash_hmac('sha256', $toSign, $params["secretKey"]);
        $requestParams["s"] = $signature;

        // Llamada a la API de Flow
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $urlBase . "/payment/create");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $requestParams);
        $response = curl_exec($ch);
        curl_close($ch);
        $responseData = json_decode($response, true);

        // Manejar la respuesta
        if (!isset($responseData["url"])):

            $response = array(
                            "estatus" => false,
                            "code" => $responseData["code"] ?? "000",
                            "msg" => $responseData["message"] ?? "Error desconocido"
            );

        else :

            $urlCompleta = $responseData["url"] . "?token=" . $responseData["token"];

            $response = array(
                            "estatus" => true,
                            "token" => $responseData["token"],
                            "url" => $urlCompleta,
                            "order" => $responseData["flowOrder"],
							"response_flow" => 	$responseData
            );



        endif;

        return $response;

    }
