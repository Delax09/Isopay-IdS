<?php


abstract class EmpresaPasarelaBaseDao 
{
	
	use GenericFunctionDaoObject;
	
	private $_info_dao 	= array(
								"pk"		=>	"empresa_pasarela_id",
								"modulo"	=>	"isopay",
								"objeto"	=>	"EmpresaPasarela",
								"tabla"		=>	"iso_empresapasarela"
								);
	
	private $empresa_pasarela_id;
	private $empresa_id;
	private $pasarela_id;
	private $habilitada;
	private $cdate;

	
	
	public function setEmpresaPasarelaId($val)
	{
		$this->empresa_pasarela_id = $val;
	}
	
	public function getEmpresaPasarelaId()
	{
		return $this->empresa_pasarela_id;
	}
	
	public function setEmpresaId($val)
	{
		$this->empresa_id = $val;
	}
	
	public function getEmpresaId()
	{
		return $this->empresa_id;
	}
	
	public function setPasarelaId($val)
	{
		$this->pasarela_id = $val;
	}
	
	public function getPasarelaId()
	{
		return $this->pasarela_id;
	}
	
	public function setHabilitada($val)
	{
		$this->habilitada = $val;
	}
	
	public function getHabilitada()
	{
		return $this->habilitada;
	}
	
	public function setCdate($val)
	{
		$this->cdate = $val;
	}
	
	public function getCdate()
	{
		return $this->cdate;
	}

	

}

