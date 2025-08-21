<?php


abstract class EmpresaBaseDao 
{
	
	use GenericFunctionDaoObject;
	
	private $_info_dao 	= array(
								"pk"		=>	"empresa_id",
								"modulo"	=>	"isopay",
								"objeto"	=>	"Empresa",
								"tabla"		=>	"iso_empresa"
								);
	
	private $empresa_id;
	private $nombre;
	private $rut;
	private $tipo;
	private $cdate;

	
	
	public function setEmpresaId($val)
	{
		$this->empresa_id = $val;
	}
	
	public function getEmpresaId()
	{
		return $this->empresa_id;
	}
	
	public function setNombre($val)
	{
		$this->nombre = $val;
	}
	
	public function getNombre()
	{
		return $this->nombre;
	}
	
	public function setRut($val)
	{
		$this->rut = $val;
	}
	
	public function getRut()
	{
		return $this->rut;
	}
	
	public function setTipo($val)
	{
		$this->tipo = $val;
	}
	
	public function getTipo()
	{
		return $this->tipo;
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

