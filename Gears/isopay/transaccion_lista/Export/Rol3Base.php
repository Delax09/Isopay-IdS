<?php

abstract class TransaccionListaExportBase extends ManagementLista
{
	
	public function getHeader()
	{
	
		$header = array(
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
	
		
		return $header;
	}
	
	protected function getDataCelda()
	{
	
		$filas = array(
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
		
		return $filas;
	}
	
	public function getConf($objeto)
	{
			return parent::getConf($objeto);
	}

}

