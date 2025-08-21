<?php


abstract class HistorialTransaccionBaseDao 
{
	
	use GenericFunctionDaoObject;
	
	private $_info_dao 	= array(
								"pk"		=>	"historial_transaccion_id",
								"modulo"	=>	"isopay",
								"objeto"	=>	"HistorialTransaccion",
								"tabla"		=>	"iso_historialtransaccion"
								);
	
	private $historial_transaccion_id;
	private $estado_anterior;
	private $estado_actual;
	private $cdate;
	private $transaccion_id;

	
	
	public function setHistorialTransaccionId($val)
	{
		$this->historial_transaccion_id = $val;
	}
	
	public function getHistorialTransaccionId()
	{
		return $this->historial_transaccion_id;
	}
	
	public function setEstadoAnterior($val)
	{
		$this->estado_anterior = $val;
	}
	
	public function getEstadoAnterior()
	{
		return $this->estado_anterior;
	}
	
	public function setEstadoActual($val)
	{
		$this->estado_actual = $val;
	}
	
	public function getEstadoActual()
	{
		return $this->estado_actual;
	}
	
	public function setCdate($val)
	{
		$this->cdate = $val;
	}
	
	public function getCdate()
	{
		return $this->cdate;
	}
	
	public function setTransaccionId($val)
	{
		$this->transaccion_id = $val;
	}
	
	public function getTransaccionId()
	{
		return $this->transaccion_id;
	}

	

}

