<?php

class Pasarela extends PasarelaBase implements DboObject  
{
	
	public function Save()
	{

		return parent::Save();
	}

	public function Delete()
	{

        $Db = Sql::getInstance();

        $Db->Delete()->From(array("iso_empresapasarela"))->Equal("pasarela_id",$this->getDao()->getPasarelaId())->Execute();

        return parent::Delete();
	}
	
	public function Filtrar(ManagementFilter $filtros , $orden = "")
	{
		
		return parent::Filtrar($filtros , $orden );
	
	}
	
	function __destruct() {
      
    }
	
	
}

