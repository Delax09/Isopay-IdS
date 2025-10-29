<?php
$tag_name = $this->view;

$this->Tpl()->define(array(
    $this->view => $this->GetTemplate("Pagar"), // Carga la vista 'Pagar'
), $this->TplPath())
    ->define_dynamic("LISTAR_CUOTAS", $this->view) // Lo mantengo para la lista de cuotas a pagar
    ->define_dynamic("LISTAR_PASARELAS", $this->view);

// Cargar listas y manager (necesarios para obtener datos)
$prt_periodo = Listas::Get("prt_periodo");

Manager::Load("protege", "Persona");
$Persona = Persona::getInstance();
//$DaoP = $Persona->getId(Auth::getVar("alumno_id"));
$DaoP = $Persona->getId(321); // Usando ID fijo como en el ejemplo

// Obtener datos del alumno para la cabecera
$Curso = $DaoP->getCursoActual(null, Auth::getVar("periodo_view"));
$prt_cursos_all = Listas::Get("prt_cursos_all");

$this->Tpl()->assign(array(
    "[NOMBRE_ALUMNO]" => $DaoP->getNombre(),
    "[CURSO_ALUMNO]" => $prt_cursos_all[$Curso->getCursoId()],
    "[DESCRIPCION]" => 'Detalle del pago y pasarela de pago.'

));

// Recibir IDs de cuotas seleccionadas por POST
// MAL: $cuotas_seleccionadas_enc = (isset($_POST['cuota']) && is_array($_POST['cuota'])) ? $_POST['cuota'] : array();
$cuotas_seleccionadas_enc = (Vars::req("cuota") && is_array(Vars::req("cuota"))) ? Vars::req("cuota") : array();

$monto_total = 0;
$cuotas_a_pagar = array();

// Procesar y Listar Cuotas Seleccionadas
if (!empty($cuotas_seleccionadas_enc)):
    Manager::Load("protege", "ContratoDetalle"); // Asumimos que existe un DAO para ContratoDetalle
    $ContratoDetalle = ContratoDetalle::getInstance();

    foreach ($cuotas_seleccionadas_enc as $id_enc):
        // Desencriptar el ID
        $id_dec = Crypt::Dec($id_enc);

        // Cargar el objeto cuota (ContratoDetalle)
        $DaoC = $ContratoDetalle->getId($id_dec);

        if ($DaoC):
            $cuotas_a_pagar[] = $DaoC;

            // Acumular el monto total
            $monto_total += $DaoC->getMonto();

            // Formato de Monto
            $monto = number_format($DaoC->getMonto(), 0, ',', '.');

            // Asignar variables al bloque dinámico
            $this->Tpl()->assign(array(
                "[N_CUOTA]" => $DaoC->getNCuota(),
                "[PERIODO]" => $prt_periodo[$DaoC->getPeriodoId()],
                "[FECHA]" => Fecha::Invertir($DaoC->getFechaVencimiento()),
                "[MONTO]" => $monto,
                "[ID_CUOTA_ENC]" => $id_enc, // Para mantener el ID encriptado en el "carrito"
            ));

            $this->Tpl()->parse("XXX_LISTAR_CUOTAS_XXX", ".LISTAR_CUOTAS");

        endif;
    endforeach;

    // Asignar el monto total y la descripción del botón Pagar
    $monto_total_formato = number_format($monto_total, 0, ',', '.');
    $this->Tpl()->assign(array(
        "[MONTO_TOTAL]" => $monto_total_formato,
        "[DESCRIPCION_PAGO]" => 'Total a pagar: $' . $monto_total_formato,
    ));

else:
    // Si no hay cuotas seleccionadas (aunque la validación JS en la vista debería evitar esto)
    $this->Tpl()->clear_dynamic("LISTAR_CUOTAS");

    // Podrías redirigir al listado principal con un error si esto ocurre
    //Header::Redirect("?view=CuotasApoderado&msg=no_seleccion");

    $this->Tpl()->assign(array(
        "[MONTO_TOTAL]" => '$0',
        "[DESCRIPCION_PAGO]" => 'No hay cuotas seleccionadas.',
    ));

endif;
// El historial no se lista en esta vista, por lo que lo limpiamos si el bloque existe
$this->Tpl()->clear_dynamic("LISTAR_HISTORIAL");

// --- PASARELAS DE PAGO ---
$Pasarelas = [
    "1" => "Flow",
    "2" => "Khipu",
    "3" => "Mercado Pago",
    "4" => "Transbank"
];

foreach ($Pasarelas as $key => $nombre) {
    $this->Tpl()->assign(array(
        "[PASARELA_VALUE]" => $key,
        "[PASARELA_NOMBRE]" => $nombre
    ));
    $this->Tpl()->parse("XXX_LISTAR_PASARELAS_XXX", ".LISTAR_PASARELAS");
}

// Limpieza de bloques innecesarios
$this->Tpl()->clear_dynamic("LISTAR_HISTORIAL");









