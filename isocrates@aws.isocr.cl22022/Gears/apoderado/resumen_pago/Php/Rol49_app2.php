<?php



$tag_name = $this->view;

$this->Tpl()->define(array(
			$this->view => $this->GetTemplate(),
),$this->TplPath())
    ->define_dynamic("RESUMEN_PAGO", $this->view);

Manager::Load("protege", "Persona");
$Persona = Persona::getInstance();
//$DaoP = $Persona->getId(Auth::getVar("alumno_id"));
$DaoP = $Persona->getId(321); // Usando ID fijo como en el ejemplo
$email = $DaoP->getEmail();

$cuotas_seleccionadas_enc = (Vars::req("cuotas_final") && is_array(Vars::req("cuotas_final"))) ? Vars::req("cuotas_final",true) : array();

if(!count($cuotas_seleccionadas_enc)):

	exit("Error");

endif;

$monto_total = Vars::req('monto_total');
$monto_total = str_replace(['.', ','], '', $monto_total);
$monto_total = (integer) $monto_total;

$pasarela_value = Vars::req('pasarela');
$fecha = date('d-m-Y H:i:s');

if($pasarela_value == 1):
    $pasarela_nombre = 'Flow';
    $apiKey = '398F8143-118E-4693-802A-61384ELC3808';
    $secretKey = '757e1587a8476847dc038de1a132521bf8c573ce';
    $pasarela = 1;
elseif($pasarela_value == 2):
    $pasarela_nombre = 'Khipu';
    $apiKey = '57bfce43-731d-4a2e-a73c-c7c929aee7ea';
    $secretKey = '';
    $pasarela = 2;
elseif($pasarela_value == 3):
    $pasarela_nombre = 'Mercado Pago';
    $apiKey = 'TEST-8631818037010505-071503-f455334f76fd193764476e5c9e82eb42-2561927866';
    $secretKey = '';
    $pasarela = 3;
elseif($pasarela_value == 4):
    $pasarela_nombre = 'Transbank';
    $apiKey = '597055555532';
    $secretKey = '579B532A7440BB0C9079DED94D31EA1615BACEB56610332264630D42D0A36B1C';
    $pasarela = 4;
endif;

$transaccion = Isopay::generarIdUnico();

$datos = [
    "apiKey" => $apiKey,
    "secretKey" => $secretKey,
    "monto" => $monto_total,
    "numeroOrden" => $transaccion,
    "concepto" => "Cuota prueba",
    "correo" => $email,
    "empresaRut" => "776702412",
    "tipoEmpresa" => 1,
    "pasarela" => $pasarela,
    "urlConfirmation" => "https://demo.isocrates.pro/?view=CuotasApoderado",
    "urlReturn" => "https://demo.isocrates.pro/?view=CuotasApoderado"
];




$Isopay = (array) Isopay::GenerarLink($datos);

if($Isopay["estatus"]  == 1):



	$id_iso_pay = $Isopay["data bd"]["transaccion_id"];
	$id_pasarela = $Isopay["data bd"]["numero_orden_pasarela"];
	$token = $Isopay["data bd"]["token"];
	$url = $Isopay["data bd"]["url"];



	Manager::Load("protege","ContratoDetalle");
	$ContratoDetalle = ContratoDetalle::getInstance();


	foreach ($cuotas_seleccionadas_enc as $cuota_id):

			$DaoC = $ContratoDetalle->getId($cuota_id);
			$DaoC->setTransaccionId($transaccion);
			$DaoC->setPasarelaId($pasarela);
			$DaoC->setTransaccionPasarelaId($id_pasarela);
			$DaoC->setTokenPasarela($token);
			$DaoC->setTransaccionIdIsopay($id_iso_pay);

			if(!$DaoC):

				exit("Error cuota no existe");

			endif;

			$ContratoDetalle->setDao($DaoC)->Save();

	endforeach;

	header("Location: ".$url);
	exit();


else:

	Arr::View($Isopay);

exit("Error de conexión con IsoPay");

endif;



// Extraer la URL del pago (asegurándote de que existe)
$link_pago = isset($Isopay['data pasarela']['url']) ? $Isopay['data pasarela']['url'] : '';

$this->Tpl()->assign(array(
    "[MONTO]" => $monto_total,
    "[PASARELA]" => $pasarela_nombre,
    "[FECHA_PAGO]" => $fecha,
    "[LINK_PAGO]" => $link_pago,
));


