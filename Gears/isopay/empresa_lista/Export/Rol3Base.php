<?php

abstract class EmpresaListaExportBase extends ManagementLista
{
	
	public function getHeader()
	{
	
		$header = array(
					"empresa_id" 		=>	array("name" =>"Id","class" => ""),
					"nombre" 		=>	array("name" =>"Nombre","class" => ""),
					"rut" 		=>	array("name" =>"Rut","class" => ""),
					"tipo" 		=>	array("name" =>"Tipo","class" => ""),
					"cdate" 		=>	array("name" =>"Fecha de creación","class" => ""),

		);
	
		
		return $header;
	}
	
	protected function getDataCelda()
	{
	
		$filas = array(
					"empresa_id"		=> array("link" => "./?view=EmpresaFicha&empresa_id=(this.empresa_id)","type" => 1),
					"nombre"		=> array("link" => "./?view=EmpresaFicha&empresa_id=(this.empresa_id)","type" => 2),
					"rut"		=> array("type" => 2),
					"tipo"		=> array("lista" => Listas::Get("iso_empresa"),"type" => 1),
					"cdate"		=> array("type" => 6),

		);
		
		return $filas;
	}
	
	public function getConf($objeto)
	{
			return parent::getConf($objeto);
	}

}

