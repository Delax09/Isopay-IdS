<?php


abstract class ConsultaBaseDao 
{
	
	use GenericFunctionDaoObject;
	
	private $_info_dao 	= array(
								"pk"		=>	"consulta_id",
								"modulo"	=>	"isopay",
								"objeto"	=>	"Consulta",
								"tabla"		=>	"iso_consulta"
								);
	
	private $consulta_id;
	private $numero_transaccion;
	private $cdate;

	
	
	public function setConsultaId($val)
	{
		$this->consulta_id = $val;
	}
	
	public function getConsultaId()
	{
		return $this->consulta_id;
	}
	
	public function setNumeroTransaccion($val)
	{
		$this->numero_transaccion = $val;
	}
	
	public function getNumeroTransaccion()
	{
		return $this->numero_transaccion;
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

