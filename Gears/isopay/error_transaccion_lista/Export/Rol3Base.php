<?php

abstract class ErrorTransaccionListaExportBase extends ManagementLista
{
	
	public function getHeader()
	{
	
		$header = array(
					"error_transaccion_id" 		=>	array("name" =>"Id","class" => ""),
					"codigo_error" 		=>	array("name" =>"Codigo error","class" => ""),
					"descripcion" 		=>	array("name" =>"Descripcion","class" => ""),
					"cdate" 		=>	array("name" =>"Fecha de creacion","class" => ""),
					"numero_orden_local" 		=>	array("name" =>"Numero Orden Isocrates","class" => ""),
					"transaccion_id" 		=>	array("name" =>"Transaccion Id","class" => ""),

		);
	
		
		return $header;
	}
	
	protected function getDataCelda()
	{
	
		$filas = array(
					"error_transaccion_id"		=> array("type" => 1),
					"codigo_error"		=> array("type" => 2),
					"descripcion"		=> array("type" => 2),
					"cdate"		=> array("type" => 6),
					"numero_orden_local"		=> array("type" => 1),
					"transaccion_id"		=> array("type" => 1),

		);
		
		return $filas;
	}
	
	public function getConf($objeto)
	{
			return parent::getConf($objeto);
	}

}

