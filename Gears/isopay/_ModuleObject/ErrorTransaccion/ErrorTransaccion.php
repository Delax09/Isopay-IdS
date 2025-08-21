<?php

class ErrorTransaccion extends ErrorTransaccionBase implements DboObject  
{
	
	public function Save()
	{

		return parent::Save();
	}

	public function Delete()
	{
		return parent::Delete();
	}
	
	public function Filtrar(ManagementFilter $filtros , $orden = "")
	{
		
		return parent::Filtrar($filtros , $orden );
	
	}
	
	function __destruct() {
      
    }
	
	
}

