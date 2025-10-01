<?php

abstract class ErrorTransaccionListaListaBase extends ManagementLista
{
	
	public function getHeader()
	{
	
		$lista = array(
					"error_transaccion_id" 		=>	array("name" =>"Id","class" => ""),
					"codigo_error" 		=>	array("name" =>"Codigo error","class" => ""),
					"descripcion" 		=>	array("name" =>"Descripcion","class" => ""),
					"cdate" 		=>	array("name" =>"Fecha de creacion","class" => ""),
					"numero_orden_local" 		=>	array("name" =>"Numero Orden Isocrates","class" => ""),
					"transaccion_id" 		=>	array("name" =>"Transaccion Id","class" => ""),

		);
	
		
		return $lista;
	}
	
	protected function getDataCelda()
	{
	
		$lista = array(
					"error_transaccion_id"		=> array("type" => 1),
					"codigo_error"		=> array("type" => 2),
					"descripcion"		=> array("type" => 2),
					"cdate"		=> array("type" => 6),
					"numero_orden_local"		=> array("type" => 1),
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
																			"view" => "ErrorTransaccionLista",
																			"format" => "xls",
																			"export" => "true",
																			"filter" => "FORM_FILTRO_ERRORTRANSACCIONLISTA",
																		),
																		
																
																),
																array(
																		"name"	=>"Pdf",
																		"icon"	 => "kt-nav__link-icon la la-file-pdf-o",
																		"extra" => array(
																			"view" => "ErrorTransaccionLista",
																			"format" => "pdf",
																			"export" => "true",
																			"filter" => "FORM_FILTRO_ERRORTRANSACCIONLISTA",
																		),
																		
																
																),
																array(
																		"name"	=>"Csv [ , ]",
																		"icon"	 => "kt-nav__link-icon la la-file-excel-o ",
																		"extra" => array(
																			"view" => "ErrorTransaccionLista",
																			"format" => "csvc",
																			"export" => "true",
																			"filter" => "FORM_FILTRO_ERRORTRANSACCIONLISTA",
																		),
																		
																
																),
																array(
																		"name"	=>"Csv [ ; ]",
																		"icon"	 => "kt-nav__link-icon la la-file-excel-o ",
																		"extra" => array(
																			"view" => "ErrorTransaccionLista",
																			"format" => "csvp",
																			"export" => "true",
																			"filter" => "FORM_FILTRO_ERRORTRANSACCIONLISTA",
																		),
																		
																
																),
																array(
																		"name"	=>"Txt [ , ]",
																		"icon"	 => "kt-nav__link-icon la la-file-code-o ",
																		"extra" => array(
																			"view" => "ErrorTransaccionLista",
																			"format" => "txtc",
																			"export" => "true",
																			"filter" => "FORM_FILTRO_ERRORTRANSACCIONLISTA",
																		),
																		
																
																),
																array(
																		"name"	=>"Txt [ ; ]",
																		"icon"	 => "kt-nav__link-icon la la-file-code-o ",
																		"extra" => array(
																			"view" => "ErrorTransaccionLista",
																			"format" => "txtp",
																			"export" => "true",
																			"filter" => "FORM_FILTRO_ERRORTRANSACCIONLISTA",
																		),
																		
																
																),
																array(
																		"name"	=>"Json",
																		"icon"	 => "kt-nav__link-icon la la-file-code-o ",
																		"extra" => array(
																			"view" => "ErrorTransaccionLista",
																			"format" => "json",
																			"export" => "true",
																			"filter" => "FORM_FILTRO_ERRORTRANSACCIONLISTA",
																		),
																		
																
																),
																array(
																		"name"	=>"Xml",
																		"icon"	 => "kt-nav__link-icon la la-file-code-o ",
																		"extra" => array(
																			"view" => "ErrorTransaccionLista",
																			"format" => "xml",
																			"export" => "true",
																			"filter" => "FORM_FILTRO_ERRORTRANSACCIONLISTA",
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

