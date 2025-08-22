<?php

abstract class EmpresaListaListaBase extends ManagementLista
{
	
	public function getHeader()
	{
	
		$lista = array(
					"empresa_id" 		=>	array("name" =>"Id","class" => ""),
					"nombre" 		=>	array("name" =>"Nombre","class" => ""),
					"rut" 		=>	array("name" =>"Rut","class" => ""),
					"tipo" 		=>	array("name" =>"Tipo","class" => ""),
					"cdate" 		=>	array("name" =>"Fecha de creación","class" => ""),

		);
	
		
		return $lista;
	}
	
	protected function getDataCelda()
	{
	
		$lista = array(
					"empresa_id"		=> array("link" => "./?view=EmpresaFicha&empresa_id=(this.empresa_id)","type" => 1),
					"nombre"		=> array("link" => "./?view=EmpresaFicha&empresa_id=(this.empresa_id)","type" => 2),
					"rut"		=> array("type" => 2),
					"tipo"		=> array("lista" => Listas::Get("iso_empresa"),"type" => 1),
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
																			"view" => "EmpresaLista",
																			"format" => "xls",
																			"export" => "true",
																			"filter" => "FORM_FILTRO_EMPRESALISTA",
																		),
																		
																
																),
																array(
																		"name"	=>"Pdf",
																		"icon"	 => "kt-nav__link-icon la la-file-pdf-o",
																		"extra" => array(
																			"view" => "EmpresaLista",
																			"format" => "pdf",
																			"export" => "true",
																			"filter" => "FORM_FILTRO_EMPRESALISTA",
																		),
																		
																
																),
																array(
																		"name"	=>"Csv [ , ]",
																		"icon"	 => "kt-nav__link-icon la la-file-excel-o ",
																		"extra" => array(
																			"view" => "EmpresaLista",
																			"format" => "csvc",
																			"export" => "true",
																			"filter" => "FORM_FILTRO_EMPRESALISTA",
																		),
																		
																
																),
																array(
																		"name"	=>"Csv [ ; ]",
																		"icon"	 => "kt-nav__link-icon la la-file-excel-o ",
																		"extra" => array(
																			"view" => "EmpresaLista",
																			"format" => "csvp",
																			"export" => "true",
																			"filter" => "FORM_FILTRO_EMPRESALISTA",
																		),
																		
																
																),
																array(
																		"name"	=>"Txt [ , ]",
																		"icon"	 => "kt-nav__link-icon la la-file-code-o ",
																		"extra" => array(
																			"view" => "EmpresaLista",
																			"format" => "txtc",
																			"export" => "true",
																			"filter" => "FORM_FILTRO_EMPRESALISTA",
																		),
																		
																
																),
																array(
																		"name"	=>"Txt [ ; ]",
																		"icon"	 => "kt-nav__link-icon la la-file-code-o ",
																		"extra" => array(
																			"view" => "EmpresaLista",
																			"format" => "txtp",
																			"export" => "true",
																			"filter" => "FORM_FILTRO_EMPRESALISTA",
																		),
																		
																
																),
																array(
																		"name"	=>"Json",
																		"icon"	 => "kt-nav__link-icon la la-file-code-o ",
																		"extra" => array(
																			"view" => "EmpresaLista",
																			"format" => "json",
																			"export" => "true",
																			"filter" => "FORM_FILTRO_EMPRESALISTA",
																		),
																		
																
																),
																array(
																		"name"	=>"Xml",
																		"icon"	 => "kt-nav__link-icon la la-file-code-o ",
																		"extra" => array(
																			"view" => "EmpresaLista",
																			"format" => "xml",
																			"export" => "true",
																			"filter" => "FORM_FILTRO_EMPRESALISTA",
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

