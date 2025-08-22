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
}
