<?php

$tag_name = $this->view;

$this->Tpl()->define(array(
    $this->view => $this->GetTemplate("Pagado"), // Carga la vista 'Confirmar'
), $this->TplPath())
    ->define_dynamic("RESUMEN_PAGO", $this->view);

$token = Vars::req("preference_id");

$apiKey = "APP_USR-2085686316830495-111900-58d1cd6ba42fbb117830f7896f59d7eb-2557120635";
$secretkey = "";
$pasarela = 3;

$data = array(
    'apiKey'    => $apiKey,
    'secretKey' => $secretkey,
    'token'     => $token,
    'pasarela'  => $pasarela
);

$Isopay = Isopay::ConsultarTransaccion($data);

if($Isopay["status"] == "approved") // Significa que el estado de la transaccion es pagada
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



$Id_pasarela = Vars::req("collection_id");
$Id_local = Vars::req("external_reference");

$this->Tpl()->assign(array(
    "[TOKEN]" => $token,
    "[PASARELA]" => 'Mercado pago',
    "[ID_PASARELA]" => $Id_pasarela,
    "[ID_PAGO]" => $Id_local,

));


echo $this->Render();
exit();






