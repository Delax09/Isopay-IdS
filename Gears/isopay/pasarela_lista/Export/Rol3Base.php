<?php

abstract class PasarelaListaExportBase extends ManagementLista
{
	
	public function getHeader()
	{
	
		$header = array(
					"pasarela_id" 		=>	array("name" =>"Id","class" => ""),
					"nombre" 		=>	array("name" =>"Nombre","class" => ""),
					"estado" 		=>	array("name" =>"Estado","class" => ""),
					"cdate" 		=>	array("name" =>"Fecha de creación","class" => ""),

		);
	
		
		return $header;
	}
	
	protected function getDataCelda()
	{
	
		$filas = array(
					"pasarela_id"		=> array("link" => "./?view=PasarelaFicha&pasarela_id=(this.pasarela_id)","type" => 1),
					"nombre"		=> array("link" => "./?view=PasarelaFicha&pasarela_id=(this.pasarela_id)","type" => 2),
					"estado"		=> array("lista" => Listas::Get("iso_pasarela"),"type" => 22),
					"cdate"		=> array("type" => 6),

		);
		
		return $filas;
	}
	
	public function getConf($objeto)
	{
			return parent::getConf($objeto);
	}

}

