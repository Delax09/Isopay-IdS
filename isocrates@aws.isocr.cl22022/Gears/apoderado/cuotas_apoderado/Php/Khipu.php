<?php

$tag_name = $this->view;

$this->Tpl()->define(array(
    $this->view => $this->GetTemplate("Pagado"), // Carga la vista 'Confirmar'
), $this->TplPath())
    ->define_dynamic("RESUMEN_PAGO", $this->view);



Manager::Load("protege","Persona");
$Persona = Persona::getInstance();
//$DaoP = $Persona->getId(Auth::getVar("alumno_id"));
$DaoP = $Persona->getId(321);



$CuotasNoPagadas = $DaoP->getCuotas(null,array(20,30)); // $Cuotas = $DaoP->getCuotas(null,array(20,30));


//Arr::view($CuotasNoPagadas);die;

$pasarela_requerida = 2;
$cuotas_a_procesar = [];

if (is_array($CuotasNoPagadas)):
    foreach ($CuotasNoPagadas as $Cuota):
        // Asumiendo que los DAOs tienen un método getVar o se puede acceder directamente
        $pasarela_id = $Cuota->getPasarelaId();
        $estado_actual = $Cuota->getEstado();
        $token_pasarela = $Cuota->getTokenPasarela();

        if ($pasarela_id == $pasarela_requerida && !empty($token_pasarela)):
            // Ejemplo de qué cuotas cumplen la condición:
            $cuotas_a_procesar[] = array(
                "id" => $Cuota->getContratoDetalleId(),
                "cuota_n" => $Cuota->getNCuota(),
                "PasarelaId" => $pasarela_id,
                "token" => $token_pasarela
            );
        endif;
    endforeach;
endif;

//Arr::view($cuotas_a_procesar);die;


if($cuotas_a_procesar):


    $token = $cuotas_a_procesar[0]["token"]; // este es el commerceOrder que tú enviaste

    $apiKey = "57bfce43-731d-4a2e-a73c-c7c929aee7ea";
    $secretkey = "";
    $pasarela = 2;

    $data = array(
        'apiKey'    => $apiKey,
        'secretKey' => $secretkey,
        'token'     => $token,
        'pasarela'  => $pasarela
    );

    sleep(10);

    $Isopay = Isopay::ConsultarTransaccion($data);

    //Arr::view($Isopay);die;


    if($Isopay["status"] == "done") // Significa que el estado de la transaccion es pagada
    {


        Manager::Load("protege","ContratoDetalle");
        $ContratoDetalle = ContratoDetalle::getInstance();
        $Cuotas = 	$ContratoDetalle->Find(array(
            "token_pasarela" => $token,
            "pasarela_id"	=> $pasarela,
            "estado"		=> array(20,30),

        ));


        if($Cuotas):

            foreach($Cuotas as $Cuota):

                $Cuota->setEstado("10");
                $Cuota->setFechaPago(date("YmdHis"));


                $ContratoDetalle->setDao($Cuota)->Save();

            endforeach;

        endif;

    }else{

        header('Location: ./?view=CuotasApoderado');

    }



    $Id_pasarela = $Isopay["response_khipu"]["transaction_id"];
    $Id_local = $Isopay["response_khipu"]["receiver_id"];

    $this->Tpl()->assign(array(
        "[TOKEN]" => $token,
        "[PASARELA]" => 'Khipu',
        "[ID_PASARELA]" => $Id_pasarela,
        "[ID_PAGO]" => $Id_local,

    ));


    echo $this->Render();

else:

    //CuotasApoderadoRun::Load();

    header("Location: ./?view=CuotasApoderado");


endif;

exit();



