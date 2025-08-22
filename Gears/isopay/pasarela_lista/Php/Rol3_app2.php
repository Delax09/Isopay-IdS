<?php

$tag_name = $this->view;

$this->Tpl()->define(array(
			$this->view => $this->GetTemplate(),
),$this->TplPath())
->define_dynamic("FILTRO_".strtoupper($tag_name)."_LIST",$this->view)
->define_dynamic("FILTRO_ROW_".strtoupper($tag_name)."_LIST",$this->view)	
->define_dynamic("HEADER_".strtoupper($tag_name)."_LIST",$this->view);


$filtros = array_chunk((array)$this->getFiltro()->getCampos(),3);//CONFIURACION CAMPOS FILTRO

//PARSEO DE FILTROS
$flag_filtro = false;



foreach($filtros as $key => $campos):
	
	foreach($campos as $campo):
	
		$show = "none";
		if(get_class($campo) != "Hidden"):

			$show = "";	
			$flag_filtro = true;	

		endif;

		$this->Tpl()->assign("[SHOW_FILTER]",$show);
		$campo->setColClass("col-12");
		$this->Tpl()->assign("[".strtoupper($tag_name)."_LABEL]",$campo->getLabel());
		$this->Tpl()->assign("[".strtoupper($tag_name)."_FILTROS]",$campo->Render());
		$this->Tpl()->parse("XX_PCCCCASO_".strtoupper($tag_name)."_FILTRO_XX",".FILTRO_".strtoupper($tag_name)."_LIST");

	endforeach;

	$this->Tpl()->parse("XX_PCCCCASO_ROW_".strtoupper($tag_name)."_FILTRO_XX",".FILTRO_ROW_".strtoupper($tag_name)."_LIST");
	$this->Tpl()->clear("XX_PCCCCASO_".strtoupper($tag_name)."_FILTRO_XX");

endforeach;



$exportar = $this->getLista()->getExport();
$acciones = null;

if(count($exportar))
{
	foreach($exportar as $accion):
		$acciones.="".$accion->Render();
	endforeach;
	
}

$Header = $this->getLista()->getHeader();



foreach($Header as $DataHeader):
	
	if(UserAgent::esMobile()):
		
		if(!$DataHeader["class"] == "hidden-xs"):
		
			$this->Tpl()->assign(array(
									"[INPUT_CAMPO_".strtoupper($tag_name)."]" => $DataHeader["name"],	
			))->parse("XXX_HEADER_".strtoupper($tag_name)."_TABLA",".HEADER_".strtoupper($tag_name)."_LIST");
		
		endif;
		
	else:
	
		$this->Tpl()->assign(array(
									"[INPUT_CAMPO_".strtoupper($tag_name)."]" => $DataHeader["name"],	
		))->parse("XXX_HEADER_".strtoupper($tag_name)."_TABLA",".HEADER_".strtoupper($tag_name)."_LIST");
	
	endif;
	
endforeach;

$_view_desc = $this->getTitulo();

$this->Tpl()->assign(array(
				"[".strtoupper($this->view)."_EXPORTAR]"	=> $acciones,
				"[".strtoupper($this->view)."_TITULO]"		=> $_view_desc[0],
				"[".strtoupper($this->view)."_DESCRIPCION]"	=> $_view_desc[1],
				"[FILTRO_HIDE]"								=> $flag_filtro === false ? "hide" : "",
));


//FIN PARSEO DE FILTROS