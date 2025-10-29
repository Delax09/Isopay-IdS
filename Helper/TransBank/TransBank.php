<?php
class TransBank
{
    public static function GenerarPago($params)
    {

        if(Init::TRANSBANK_STATUS == false):
            // Datos de la transacción (Estos son del ambiente sandbox)
            $url = 'https://webpay3gint.transbank.cl/rswebpaytransaction/api/webpay/v1.2/transactions';
        else:
            // AL PASAR A PRODUCCION DESCOMENTAR ESTOS CAMPOS
            $url = 'https://webpay3g.transbank.cl/rswebpaytransaction/api/webpay/v1.2/transactions';

        endif;

        $apiKey = $params["apiKey"];
        $secretKey = $params["secretKey"];
        $sessionId = uniqid('sesion_', true);

        $data = [
            'buy_order' => $params["numeroOrden"].'-'.uniqid(),
            'session_id' => $sessionId,
            'amount' => $params["amount"],
            'return_url' => $params["urlReturn"]
        ];

        // Inicializar cURL
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Tbk-Api-Key-Id: '. $apiKey,               // Commerce Code de pruebas
            'Tbk-Api-Key-Secret: '. $secretKey  // API Key Secret de pruebas
        ]);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        // Ejecutar petición
        $response = curl_exec($ch);
        $response = json_decode($response, true);
        curl_close($ch);

        // Validar error
        if (!isset($response["url"])):

            $response = array(
                "estado" => False,
                "error" => $response["error_message"],
            );

        else:

            $response = array(
                "estatus" => True,
                "token" => $response["token"],
                "url" => $response["url"] . "?token_ws=" . $response["token"],
                "response_transbank" => $response
            );


        endif;

        return $response;
    }
    
    public static function ConsultarTransaccion($params)
    {


        $token = $params["token"];

        if(Init::TRANSBANK_STATUS == false):
            // Datos de la transacción (Estos son del ambiente sandbox)
            $url = 'https://webpay3gint.transbank.cl/rswebpaytransaction/api/webpay/v1.2/transactions/' . $token;
        else:
            // AL PASAR A PRODUCCION DESCOMENTAR ESTOS CAMPOS
            $url = 'https://webpay3g.transbank.cl/rswebpaytransaction/api/webpay/v1.2/transactions/' . $token;

        endif;

        $apiKey = $params["apiKey"];
        $secretKey = $params["secretKey"];

        // Inicializar cURL
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Tbk-Api-Key-Id: ' . $apiKey,
            'Tbk-Api-Key-Secret: ' . $secretKey
        ]);

        $responseData = curl_exec($ch);

        if (curl_errno($ch)) {
            $error_msg = curl_error($ch);
            curl_close($ch);
            $response = array(
                "estatus" => false,
                "error" => "Error en cURL: $error_msg"
            );
        }

        curl_close($ch);
        $responseData = json_decode($responseData, true);

        // Validar respuesta
        if (!isset($responseData["status"])):
            $response = array(
                "estatus" => false,
                "error" => "Transacción no encontrada o token inválido",
                "detalle" => $responseData
            );
        else:

            Manager::Load("isopay","Transaccion");
            $Transaccion = Transaccion::getInstance();
            $Check = $Transaccion->Find(array(
                "token" => $token,
            ));
            $subject = $Check[0]->getConcepto();

            $response = array(
                "estatus" => true,
                "subject" => $subject,
                "status" => $responseData["status"], // Ej: "AUTHORIZED"
                "response_transbank" => $responseData
            );

        endif;

        /*
         *
         * Estado de la transacción
             * INITIALIZED
             * AUTHORIZED
             * REVERSED
             * FAILED
             * NULLIFIED
             * PARTIALLY_NULLIFIED
             * CAPTURED
         */

        return $response;
    }

        public static function ConfirmacionTransbank($params)
    {

        $apiKey = $params->apiKey;
        $secretKey = $params->secretKey;
        $token = $params->token;


        if(Init::TRANSBANK_STATUS == false):
            // Datos de la transacción (Estos son del ambiente sandbox)
            $url = 'https://webpay3gint.transbank.cl/rswebpaytransaction/api/webpay/v1.2/transactions/' . $token;
        else:
            // AL PASAR A PRODUCCION DESCOMENTAR ESTOS CAMPOS
            $url = 'https://webpay3g.transbank.cl/rswebpaytransaction/api/webpay/v1.2/transactions/' . $token;

        endif;




        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "PUT",
            CURLOPT_HTTPHEADER => array(
                "Tbk-Api-Key-Id: ". $apiKey,
                "Tbk-Api-Key-Secret: ". $secretKey,
                "Content-Type: application/json"
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);


        Return $response;

    }
}


