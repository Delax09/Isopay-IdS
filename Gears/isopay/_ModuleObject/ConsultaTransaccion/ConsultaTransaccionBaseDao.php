<?php


abstract class ConsultaTransaccionBaseDao 
{
	
	use GenericFunctionDaoObject;
	
	private $_info_dao 	= array(
								"pk"		=>	"consulta_transaccion_id",
								"modulo"	=>	"isopay",
								"objeto"	=>	"ConsultaTransaccion",
								"tabla"		=>	"iso_consultatransaccion"
								);
	
	private $consulta_transaccion_id;
	private $consulta_id;
	private $transaccion_id;
	private $cdate;

	
	
	public function setConsultaTransaccionId($val)
	{
		$this->consulta_transaccion_id = $val;
	}
	
	public function getConsultaTransaccionId()
	{
		return $this->consulta_transaccion_id;
	}
	
	public function setConsultaId($val)
	{
		$this->consulta_id = $val;
	}
	
	public function getConsultaId()
	{
		return $this->consulta_id;
	}
	
	public function setTransaccionId($val)
	{
		$this->transaccion_id = $val;
	}
	
	public function getTransaccionId()
	{
		return $this->transaccion_id;
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

