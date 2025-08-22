<?php

abstract class PasarelaListaListaBase extends ManagementLista
{
	
	public function getHeader()
	{
	
		$lista = array(
					"pasarela_id" 		=>	array("name" =>"Id","class" => ""),
					"nombre" 		=>	array("name" =>"Nombre","class" => ""),
					"estado" 		=>	array("name" =>"Estado","class" => ""),
					"cdate" 		=>	array("name" =>"Fecha de creación","class" => ""),

		);
	
		
		return $lista;
	}
	
	protected function getDataCelda()
	{
	
		$lista = array(
					"pasarela_id"		=> array("link" => "./?view=PasarelaFicha&pasarela_id=(this.pasarela_id)","type" => 1),
					"nombre"		=> array("link" => "./?view=PasarelaFicha&pasarela_id=(this.pasarela_id)","type" => 2),
					"estado"		=> array("lista" => Listas::Get("iso_pasarela"),"type" => 22),
					"cdate"		=> array("type" => 6),

		);
		
		return $lista;
	}
	
	protected function getExport()
	{
		return array(
							
							 Form::DropDown(array(
												"value"	=> "Exportar" ,
												"icon"	=> "la la-download",
												"class"	=>" btn btn-default btn-icon-sm   ",
												"dropdawn" => array(
																array(
																		"name"	=>"Excel",
																		"icon"	 => "kt-nav__link-icon la la-file-excel-o ",
																		"extra" => array(
																			"view" => "PasarelaLista",
																			"format" => "xls",
																			"export" => "true",
																			"filter" => "FORM_FILTRO_PASARELALISTA",
																		),
																		
																
																),
																array(
																		"name"	=>"Pdf",
																		"icon"	 => "kt-nav__link-icon la la-file-pdf-o",
																		"extra" => array(
																			"view" => "PasarelaLista",
																			"format" => "pdf",
																			"export" => "true",
																			"filter" => "FORM_FILTRO_PASARELALISTA",
																		),
																		
																
																),
																array(
																		"name"	=>"Csv [ , ]",
																		"icon"	 => "kt-nav__link-icon la la-file-excel-o ",
																		"extra" => array(
																			"view" => "PasarelaLista",
																			"format" => "csvc",
																			"export" => "true",
																			"filter" => "FORM_FILTRO_PASARELALISTA",
																		),
																		
																
																),
																array(
																		"name"	=>"Csv [ ; ]",
																		"icon"	 => "kt-nav__link-icon la la-file-excel-o ",
																		"extra" => array(
																			"view" => "PasarelaLista",
																			"format" => "csvp",
																			"export" => "true",
																			"filter" => "FORM_FILTRO_PASARELALISTA",
																		),
																		
																
																),
																array(
																		"name"	=>"Txt [ , ]",
																		"icon"	 => "kt-nav__link-icon la la-file-code-o ",
																		"extra" => array(
																			"view" => "PasarelaLista",
																			"format" => "txtc",
																			"export" => "true",
																			"filter" => "FORM_FILTRO_PASARELALISTA",
																		),
																		
																
																),
																array(
																		"name"	=>"Txt [ ; ]",
																		"icon"	 => "kt-nav__link-icon la la-file-code-o ",
																		"extra" => array(
																			"view" => "PasarelaLista",
																			"format" => "txtp",
																			"export" => "true",
																			"filter" => "FORM_FILTRO_PASARELALISTA",
																		),
																		
																
																),
																array(
																		"name"	=>"Json",
																		"icon"	 => "kt-nav__link-icon la la-file-code-o ",
																		"extra" => array(
																			"view" => "PasarelaLista",
																			"format" => "json",
																			"export" => "true",
																			"filter" => "FORM_FILTRO_PASARELALISTA",
																		),
																		
																
																),
																array(
																		"name"	=>"Xml",
																		"icon"	 => "kt-nav__link-icon la la-file-code-o ",
																		"extra" => array(
																			"view" => "PasarelaLista",
																			"format" => "xml",
																			"export" => "true",
																			"filter" => "FORM_FILTRO_PASARELALISTA",
																		),
																		
																
																),
													
												
												)
													)	
								)				
																		
				
			);
	}
	
	public function getConf($objeto)
	{
			return parent::getConf($objeto);
	}

}

