<?php

$tag_name = $this->view;

$this->Tpl()->define(array(
			$this->view => $this->GetTemplate(),
),$this->TplPath())
    ->define_dynamic("LISTAR_CUOTAS",$this->view)
    ->define_dynamic("LISTAR_HISTORIAL",$this->view);


$cnt_estado_cuota = Listas::Get("cnt_estado_cuota");
$prt_periodo = Listas::Get("prt_periodo");

Manager::Load("protege","Persona");
$Persona = Persona::getInstance();
//$DaoP = $Persona->getId(Auth::getVar("alumno_id"));
$DaoP = $Persona->getId(321);



$CuotasNoPagadas = $DaoP->getCuotas(null,array(20,30)); // $Cuotas = $DaoP->getCuotas(null,array(20,30));

$CuotasHistorial = $DaoP->getCuotas(null, array(10));

$Curso = $DaoP->getCursoActual(null,Auth::getVar("periodo_view"));
$prt_cursos_all= Listas::Get("prt_cursos_all");



$this->Tpl()->assign(array(
	"[NOMBRE_ALUMNO]"	=> $DaoP->getNombre(),
	"[CURSO_ALUMNO]" => $prt_cursos_all[$Curso->getCursoId()],
    "[DESCRIPCION]" => 'Revisa los pagos pendientes de tu cuenta,
							selecciona las cuotas que quieres pagar
							y presiona pagar para continuar'

));



if($CuotasNoPagadas):
	$cont = 0;
	foreach ($CuotasNoPagadas as $DaoC):
		$cont++;

        $id = Crypt::Enc($DaoC->getContratoDetalleId());

        $pagar = '<div class="form-check icon-check">
                        <input class="form-check-input" name="cuota[]" type="checkbox" value="'.$id.'" id="cuota_'.$cont.'" >
                        <label class="form-check-label" for="cuota_'.$cont.'">Pagar</label>
                        <i class="icon-check-1 fa fa-square color-gray-dark font-16"></i>
                        <i class="icon-check-2 fa fa-check-square font-16 color-highlight"></i>
                    </div>';

        $monto = number_format($DaoC->getMonto(), 0, ',', '.'); // Resultado: 1.234.567,89


        $this->Tpl()->assign(array(
                                    "[N_CUOTA]" => $DaoC->getNCuota(),
                                    "[PERIODO]" => $prt_periodo[$DaoC->getPeriodoId()],
                                    "[FECHA]" => Fecha::Invertir($DaoC->getFechaVencimiento()),
                                    "[ESTADO]" => $cnt_estado_cuota[$DaoC->getEstado()],
                                    "[MONTO]" => '$'.$monto,
                                    "[BOTON]"	=> $pagar,

        ));

        $this->Tpl()->parse("XXX_LISTAR_CUOTAS_XXX",".LISTAR_CUOTAS");

	endforeach;

else:

    $this->Tpl()->clear_dynamic("LISTAR_CUOTAS");

endif;


if ($CuotasHistorial):

    $cont = 0;
    foreach ($CuotasHistorial as $DaoH):
        $cont++;

        $id = Crypt::Enc($DaoH->getContratoDetalleId());

        $pagar = '<div class="form-check icon-check">
                        <input class="form-check-input" name="cuota[]" type="checkbox" value="'.$id.'" id="cuota_'.$cont.'" >
                        <label class="form-check-label" for="cuota_'.$cont.'">Pagar</label>
                        <i class="icon-check-1 fa fa-square color-gray-dark font-16"></i>
                        <i class="icon-check-2 fa fa-check-square font-16 color-highlight"></i>
                    </div>';

        $monto = number_format($DaoC->getMonto(), 0, ',', '.'); // Resultado: 1.234.567,89


        $this->Tpl()->assign(array(
            "[N_CUOTA_HISTORIAL]" => $DaoH->getNCuota(),
            "[PERIODO_HISTORIAL]" => $prt_periodo[$DaoH->getPeriodoId()],
            "[FECHA_HISTORIAL]" => Fecha::Invertir($DaoH->getFechaVencimiento()),
            "[ESTADO_HISTORIAL]" => $cnt_estado_cuota[$DaoH->getEstado()],
            "[MONTO_HISTORIAL]" => '$'.$monto,
        ));

        $this->Tpl()->parse("XXX_LISTAR_HISTORIAL_XXX",".LISTAR_HISTORIAL");

    endforeach;

else:

    $this->Tpl()->clear_dynamic("LISTAR_HISTORIAL");


endif;


