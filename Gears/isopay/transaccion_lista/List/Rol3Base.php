<?php

abstract class TransaccionListaListaBase extends ManagementLista
{
	
	public function getHeader()
	{
	
		$lista = array(
					"transaccion_id" 		=>	array("name" =>"Id","class" => ""),
					"monto" 		=>	array("name" =>"Monto","class" => ""),
					"concepto" 		=>	array("name" =>"Concepto","class" => ""),
					"estado" 		=>	array("name" =>"Estado","class" => ""),
					"numero_orden_local" 		=>	array("name" =>"N. Orden local","class" => ""),
					"token" 		=>	array("name" =>"Token","class" => ""),
					"url" 		=>	array("name" =>"Url","class" => ""),
					"empresa_id" 		=>	array("name" =>"Empresa","class" => ""),
					"pasarela_id" 		=>	array("name" =>"Pasarela","class" => ""),
					"cdate" 		=>	array("name" =>"Fecha de creacion","class" => ""),

		);
	
		
		return $lista;
	}
	
	protected function getDataCelda()
	{
	
		$lista = array(
					"transaccion_id"		=> array("type" => 1),
					"monto"		=> array("type" => 1),
					"concepto"		=> array("type" => 2),
					"estado"		=> array("type" => 2),
					"numero_orden_local"		=> array("type" => 1),
					"token"		=> array("type" => 2),
					"url"		=> array("type" => 2),
					"empresa_id"		=> array("lista" => Listas::Get("iso_vinculo_empresa"),"type" => 1),
					"pasarela_id"		=> array("lista" => Listas::Get("iso_vinculo_pasarela"),"type" => 1),
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
																			"view" => "TransaccionLista",
																			"format" => "xls",
																			"export" => "true",
																			"filter" => "FORM_FILTRO_TRANSACCIONLISTA",
																		),
																		
																
																),
																array(
																		"name"	=>"Pdf",
																		"icon"	 => "kt-nav__link-icon la la-file-pdf-o",
																		"extra" => array(
																			"view" => "TransaccionLista",
																			"format" => "pdf",
																			"export" => "true",
																			"filter" => "FORM_FILTRO_TRANSACCIONLISTA",
																		),
																		
																
																),
																array(
																		"name"	=>"Csv [ , ]",
																		"icon"	 => "kt-nav__link-icon la la-file-excel-o ",
																		"extra" => array(
																			"view" => "TransaccionLista",
																			"format" => "csvc",
																			"export" => "true",
																			"filter" => "FORM_FILTRO_TRANSACCIONLISTA",
																		),
																		
																
																),
																array(
																		"name"	=>"Csv [ ; ]",
																		"icon"	 => "kt-nav__link-icon la la-file-excel-o ",
																		"extra" => array(
																			"view" => "TransaccionLista",
																			"format" => "csvp",
																			"export" => "true",
																			"filter" => "FORM_FILTRO_TRANSACCIONLISTA",
																		),
																		
																
																),
																array(
																		"name"	=>"Txt [ , ]",
																		"icon"	 => "kt-nav__link-icon la la-file-code-o ",
																		"extra" => array(
																			"view" => "TransaccionLista",
																			"format" => "txtc",
																			"export" => "true",
																			"filter" => "FORM_FILTRO_TRANSACCIONLISTA",
																		),
																		
																
																),
																array(
																		"name"	=>"Txt [ ; ]",
																		"icon"	 => "kt-nav__link-icon la la-file-code-o ",
																		"extra" => array(
																			"view" => "TransaccionLista",
																			"format" => "txtp",
																			"export" => "true",
																			"filter" => "FORM_FILTRO_TRANSACCIONLISTA",
																		),
																		
																
																),
																array(
																		"name"	=>"Json",
																		"icon"	 => "kt-nav__link-icon la la-file-code-o ",
																		"extra" => array(
																			"view" => "TransaccionLista",
																			"format" => "json",
																			"export" => "true",
																			"filter" => "FORM_FILTRO_TRANSACCIONLISTA",
																		),
																		
																
																),
																array(
																		"name"	=>"Xml",
																		"icon"	 => "kt-nav__link-icon la la-file-code-o ",
																		"extra" => array(
																			"view" => "TransaccionLista",
																			"format" => "xml",
																			"export" => "true",
																			"filter" => "FORM_FILTRO_TRANSACCIONLISTA",
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

