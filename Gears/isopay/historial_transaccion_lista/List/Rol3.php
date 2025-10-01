<?php

class HistorialTransaccionListaLista extends HistorialTransaccionListaListaBase
{
	
	public function getHeader()
	{
	
		$lista = parent::getHeader();
	
		return $lista;
	}
	
	public function getDataCelda()
	{
	
		$lista = parent::getDataCelda();
		
		return $lista;
	}
	
	public function getExport()
	{
		
		$export = parent::getExport();
		
		return $export;
	}
	
	public function getConf($objeto)
	{
			return parent::getConf($objeto);
	}

}