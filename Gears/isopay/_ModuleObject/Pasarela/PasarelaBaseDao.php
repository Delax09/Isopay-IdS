<?php


abstract class PasarelaBaseDao 
{
	
	use GenericFunctionDaoObject;
	
	private $_info_dao 	= array(
								"pk"		=>	"pasarela_id",
								"modulo"	=>	"isopay",
								"objeto"	=>	"Pasarela",
								"tabla"		=>	"iso_pasarela"
								);
	
	private $pasarela_id;
	private $nombre;
	private $estado;
	private $cdate;

	
	
	public function setPasarelaId($val)
	{
		$this->pasarela_id = $val;
	}
	
	public function getPasarelaId()
	{
		return $this->pasarela_id;
	}
	
	public function setNombre($val)
	{
		$this->nombre = $val;
	}
	
	public function getNombre()
	{
		return $this->nombre;
	}
	
	public function setEstado($val)
	{
		$this->estado = $val;
	}
	
	public function getEstado()
	{
		return $this->estado;
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

