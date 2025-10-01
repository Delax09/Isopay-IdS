<?php

abstract class HistorialTransaccionListaListaBase extends ManagementLista
{
	
	public function getHeader()
	{
	
		$lista = array(
					"historial_transaccion_id" 		=>	array("name" =>"Id","class" => ""),
					"estado_anterior" 		=>	array("name" =>"Estado anterior","class" => ""),
					"estado_actual" 		=>	array("name" =>"Estado actual","class" => ""),
					"cdate" 		=>	array("name" =>"Fecha de creacion","class" => ""),
					"transaccion_id" 		=>	array("name" =>"Transaccion","class" => ""),

		);
	
		
		return $lista;
	}
	
	protected function getDataCelda()
	{
	
		$lista = array(
					"historial_transaccion_id"		=> array("type" => 1),
					"estado_anterior"		=> array("type" => 2),
					"estado_actual"		=> array("type" => 2),
					"cdate"		=> array("type" => 6),
					"transaccion_id"		=> array("type" => 1),

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
																			"view" => "HistorialTransaccionLista",
																			"format" => "xls",
																			"export" => "true",
																			"filter" => "FORM_FILTRO_HISTORIALTRANSACCIONLISTA",
																		),
																		
																
																),
																array(
																		"name"	=>"Pdf",
																		"icon"	 => "kt-nav__link-icon la la-file-pdf-o",
																		"extra" => array(
																			"view" => "HistorialTransaccionLista",
																			"format" => "pdf",
																			"export" => "true",
																			"filter" => "FORM_FILTRO_HISTORIALTRANSACCIONLISTA",
																		),
																		
																
																),
																array(
																		"name"	=>"Csv [ , ]",
																		"icon"	 => "kt-nav__link-icon la la-file-excel-o ",
																		"extra" => array(
																			"view" => "HistorialTransaccionLista",
																			"format" => "csvc",
																			"export" => "true",
																			"filter" => "FORM_FILTRO_HISTORIALTRANSACCIONLISTA",
																		),
																		
																
																),
																array(
																		"name"	=>"Csv [ ; ]",
																		"icon"	 => "kt-nav__link-icon la la-file-excel-o ",
																		"extra" => array(
																			"view" => "HistorialTransaccionLista",
																			"format" => "csvp",
																			"export" => "true",
																			"filter" => "FORM_FILTRO_HISTORIALTRANSACCIONLISTA",
																		),
																		
																
																),
																array(
																		"name"	=>"Txt [ , ]",
																		"icon"	 => "kt-nav__link-icon la la-file-code-o ",
																		"extra" => array(
																			"view" => "HistorialTransaccionLista",
																			"format" => "txtc",
																			"export" => "true",
																			"filter" => "FORM_FILTRO_HISTORIALTRANSACCIONLISTA",
																		),
																		
																
																),
																array(
																		"name"	=>"Txt [ ; ]",
																		"icon"	 => "kt-nav__link-icon la la-file-code-o ",
																		"extra" => array(
																			"view" => "HistorialTransaccionLista",
																			"format" => "txtp",
																			"export" => "true",
																			"filter" => "FORM_FILTRO_HISTORIALTRANSACCIONLISTA",
																		),
																		
																
																),
																array(
																		"name"	=>"Json",
																		"icon"	 => "kt-nav__link-icon la la-file-code-o ",
																		"extra" => array(
																			"view" => "HistorialTransaccionLista",
																			"format" => "json",
																			"export" => "true",
																			"filter" => "FORM_FILTRO_HISTORIALTRANSACCIONLISTA",
																		),
																		
																
																),
																array(
																		"name"	=>"Xml",
																		"icon"	 => "kt-nav__link-icon la la-file-code-o ",
																		"extra" => array(
																			"view" => "HistorialTransaccionLista",
																			"format" => "xml",
																			"export" => "true",
																			"filter" => "FORM_FILTRO_HISTORIALTRANSACCIONLISTA",
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

