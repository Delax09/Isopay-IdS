<?php
class Isopay
{
	public static function generarIdUnico() {
		// Obtiene el timestamp con microsegundos
		$microtime = microtime(true);

		// Convierte el timestamp a milisegundos y lo transforma en entero
		$timestamp = (int)($microtime * 1000);

		// Agrega un valor aleatorio para evitar colisiones
		$random = mt_rand(1000, 9999);

		// Combina el timestamp con el número aleatorio
		$idUnico = $timestamp . $random;

		return $idUnico;
	}

    public static function GenerarLink($data)
    {
        // Endpoint de la API
        $url = 'https://pay.isocrates.pro/api/isopay/registrar_orden_pago';

        // Token de autenticación (puede ser constante o venir en $data)
        $token = '9820c650519cadfddd53dd3aa325f224';

        // Convertir el array asociativo PHP a JSON
        $payload = json_encode($data);

        // Inicializar cURL
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $payload,
            CURLOPT_HTTPHEADER => array(
                'x-api-token: ' . $token,
                'Content-Type: application/json'
            ),
        ));

        // Ejecutar la solicitud
        $response = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);

        // Manejo básico de errores
        if ($error) {
            return array(
                'status' => 'error',
                'message' => 'cURL Error: ' . $error
            );
        }

        // Decodificar la respuesta JSON
        $decoded = json_decode($response, true);

        // Retornar la respuesta (puede incluir el link de pago si viene en la respuesta)
        return $decoded ?: $response;
    }


    public static function ConsultarTransaccion($data)
    {
        // Inicializar cURL
        $curl = curl_init();

        // Configurar opciones
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://pay.isocrates.pro/api/isopay/consultar_transaccion',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_POSTFIELDS => json_encode(array(
                'apiKey'    => $data['apiKey'],
                'secretKey' => $data['secretKey'],
                'token'     => $data['token'],
                'pasarela'  => $data['pasarela']
            )),
            CURLOPT_HTTPHEADER => array(
                'x-api-token: 9820c650519cadfddd53dd3aa325f224',
                'Content-Type: application/json'
            ),
        ));

        // Ejecutar y obtener respuesta
        $response = curl_exec($curl);

        // Capturar errores si los hay
        if (curl_errno($curl)) {
            $error_msg = curl_error($curl);
            curl_close($curl);
            return array(
                'estatus' => 0,
                'msg' => 'Error en cURL: ' . $error_msg
            );
        }

        curl_close($curl);

        // Decodificar respuesta JSON
        $decoded = json_decode($response, true);

        // Retornar respuesta procesada
        return $decoded ?: array(
            'estatus' => 0,
            'msg' => 'Respuesta inválida del servidor',
            'raw' => $response
        );
    }



    public static function InfoTransaccion($token)
    {
        // Inicializar cURL
        $curl = curl_init();

        // Configurar opciones
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://pay.isocrates.pro/api/isopay/buscar_transaccion_token',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_POSTFIELDS => json_encode(array(
                'token'    => $token,
            )),
            CURLOPT_HTTPHEADER => array(
                'x-api-token: 9820c650519cadfddd53dd3aa325f224',
                'Content-Type: application/json'
            ),
        ));

        // Ejecutar y obtener respuesta

        $response = curl_exec($curl);

        // Capturar errores si los hay
        if (curl_errno($curl)) {
            $error_msg = curl_error($curl);
            curl_close($curl);
            return array(
                'estatus' => 0,
                'msg' => 'Error en cURL: ' . $error_msg
            );
        }

        curl_close($curl);

        // Decodificar respuesta JSON
        $decoded = json_decode($response, true);

        // Retornar respuesta procesada
        return $decoded ?: array(
            'estatus' => 0,
            'msg' => 'Respuesta inválida del servidor',
            'raw' => $response
        );
    }

    public static function ConfirmacionTransbank($data)
    {

        // Inicializar cURL
        $curl = curl_init();

        // Configurar opciones
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://pay.isocrates.pro/api/isopay/confirmacion_transbank',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_POSTFIELDS => json_encode(array(
                'apiKey'    => $data['apiKey'],
                'secretKey' => $data['secretKey'],
                'token'     => $data['token'],
            )),
            CURLOPT_HTTPHEADER => array(
                'x-api-token: 9820c650519cadfddd53dd3aa325f224',
                'Content-Type: application/json'
            ),
        ));

        // Ejecutar y obtener respuesta
        $response = curl_exec($curl);

        // Capturar errores si los hay
        if (curl_errno($curl)) {
            $error_msg = curl_error($curl);
            curl_close($curl);
            return array(
                'estatus' => 0,
                'msg' => 'Error en cURL: ' . $error_msg
            );
        }

        curl_close($curl);

        // Decodificar respuesta JSON
        $decoded = json_decode($response, true);

        // Retornar respuesta procesada
        return $decoded ?: array(
            'estatus' => 0,
            'msg' => 'Respuesta inválida del servidor',
            'raw' => $response
        );

    }
}
