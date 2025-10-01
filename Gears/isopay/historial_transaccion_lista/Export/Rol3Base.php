<?php

abstract class HistorialTransaccionListaExportBase extends ManagementLista
{
	
	public function getHeader()
	{
	
		$header = array(
					"historial_transaccion_id" 		=>	array("name" =>"Id","class" => ""),
					"estado_anterior" 		=>	array("name" =>"Estado anterior","class" => ""),
					"estado_actual" 		=>	array("name" =>"Estado actual","class" => ""),
					"cdate" 		=>	array("name" =>"Fecha de creacion","class" => ""),
					"transaccion_id" 		=>	array("name" =>"Transaccion","class" => ""),

		);
	
		
		return $header;
	}
	
	protected function getDataCelda()
	{
	
		$filas = array(
					"historial_transaccion_id"		=> array("type" => 1),
					"estado_anterior"		=> array("type" => 2),
					"estado_actual"		=> array("type" => 2),
					"cdate"		=> array("type" => 6),
					"transaccion_id"		=> array("type" => 1),

		);
		
		return $filas;
	}
	
	public function getConf($objeto)
	{
			return parent::getConf($objeto);
	}

}

