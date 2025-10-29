<?php

$tag_name = $this->view;

$this->Tpl()->define(array(
    $this->view => $this->GetTemplate("Pagado"), // Carga la vista 'Confirmar'
), $this->TplPath())
    ->define_dynamic("RESUMEN_PAGO", $this->view);

$token = Vars::req("token");

$apiKey = "398F8143-118E-4693-802A-61384ELC3808";
$secretkey = "757e1587a8476847dc038de1a132521bf8c573ce";
$pasarela = 1;

$data = array(
    'apiKey'    => $apiKey,
    'secretKey' => $secretkey,
    'token'     => $token,
    'pasarela'  => $pasarela
);

$Isopay = Isopay::ConsultarTransaccion($data);

if($Isopay["status"] == 2) // Significa que el estado de la transaccion es pagada
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




	/*
    Manager::Load("protege","Persona");
    $Persona = Persona::getInstance();
    //$DaoP = $Persona->getId(Auth::getVar("alumno_id"));
    $DaoP = $Persona->getId(321);

    $CuotasNoPagadas = $DaoP->getCuotas(null,array(20,30)); // $Cuotas = $DaoP->getCuotas(null,array(20,30));
    if($CuotasNoPagadas):
        foreach ($CuotasNoPagadas as $DaoC):

            if($DaoC->getTokenPasarela() == $token){

                $DaoC->setEstado("10");
                $DaoC->setFechaPago(date("YmdHis"));


                $Persona->setDao($DaoC)->Save();

            }


        endforeach;

    endif;

	*/


}else{

    header('Location: ./?view=CuotasApoderado');

}



$Id_pasarela = $Isopay["response_flow"]["flowOrder"];
$Id_local = $Isopay["response_flow"]["commerceOrder"];

$this->Tpl()->assign(array(
    "[TOKEN]" => $token,
    "[PASARELA]" => 'Flow',
    "[ID_PASARELA]" => $Id_pasarela,
    "[ID_PAGO]" => $Id_local,

));


echo $this->Render();
exit();






