<?php

$tag_name = $this->view;

$this->Tpl()->define(array(
    $this->view => $this->GetTemplate("Pagado"), // Carga la vista 'Confirmar'
), $this->TplPath())
    ->define_dynamic("RESUMEN_PAGO", $this->view);


$token = Vars::req("token_ws");

$apiKey = "597055555532";
$secretkey = "579B532A7440BB0C9079DED94D31EA1615BACEB56610332264630D42D0A36B1C";
$pasarela = 4;

$data = array(
    'apiKey'    => $apiKey,
    'secretKey' => $secretkey,
    'token'     => $token,
    'pasarela'  => $pasarela
);

Isopay::ConfirmacionTransbank($data);

$Isopay = Isopay::ConsultarTransaccion($data);

if($Isopay["status"] == "AUTHORIZED") // Significa que el estado de la transaccion es pagada
{

    Manager::Load("protege", "ContratoDetalle");
    $ContratoDetalle = ContratoDetalle::getInstance();
    $Cuotas = $ContratoDetalle->Find(array(
        "token_pasarela" => $token,
        "pasarela_id" => $pasarela,
        "estado" => array(20, 30),

    ));


    if ($Cuotas):

        foreach ($Cuotas as $Cuota):

            $Cuota->setEstado("10");
            $Cuota->setFechaPago(date("YmdHis"));


            $ContratoDetalle->setDao($Cuota)->Save();

        endforeach;

    endif;

}else{

    header('Location: ./?view=CuotasApoderado');

}


$Id_pasarela = $Isopay["response_transbank"]["buy_order"];

$infoTransaccion = Isopay::InfoTransaccion($token);
$Id_local = $infoTransaccion["numero_orden_local"];

$this->Tpl()->assign(array(
    "[TOKEN]" => $token,
    "[PASARELA]" => 'Transbank',
    "[ID_PASARELA]" => $Id_pasarela,
    "[ID_PAGO]" => $Id_local,

));

echo $this->Render();
exit();
