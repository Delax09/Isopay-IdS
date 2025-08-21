<?php

class Empresa extends EmpresaBase implements DboObject  
{

    public function Save()
	{

		return parent::Save();
	}

	public function Delete()
	{

		$Db = Sql::getInstance();

		$Db->Delete()->From(array("iso_empresapasarela"))->Equal("empresa_id",$this->getDao()->getEmpresaId())->Execute();

		return parent::Delete();
	}
	
	public function Filtrar(ManagementFilter $filtros , $orden = "")
	{
		
		return parent::Filtrar($filtros , $orden );
	
	}
	
	function __destruct() {
      
    }
	
	
}

