<?php

class TransaccionListaExport extends TransaccionListaExportBase
{
	
	public function getHeader()
	{
	
		$header = parent::getHeader();
	
		return $header;
	}
	
	protected function getDataCelda()
	{
	
		$filas = parent::getDataCelda();
		
		return $filas;
	}
	
	public function getConf($objeto)
	{
			return parent::getConf($objeto);
	}

}