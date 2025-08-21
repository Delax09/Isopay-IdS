<?php


abstract class ErrorTransaccionBaseDao 
{
	
	use GenericFunctionDaoObject;
	
	private $_info_dao 	= array(
								"pk"		=>	"error_transaccion_id",
								"modulo"	=>	"isopay",
								"objeto"	=>	"ErrorTransaccion",
								"tabla"		=>	"iso_errortransaccion"
								);
	
	private $error_transaccion_id;
	private $codigo_error;
	private $descripcion;
	private $cdate;
	private $transaccion_id;

	
	
	public function setErrorTransaccionId($val)
	{
		$this->error_transaccion_id = $val;
	}
	
	public function getErrorTransaccionId()
	{
		return $this->error_transaccion_id;
	}
	
	public function setCodigoError($val)
	{
		$this->codigo_error = $val;
	}
	
	public function getCodigoError()
	{
		return $this->codigo_error;
	}
	
	public function setDescripcion($val)
	{
		$this->descripcion = $val;
	}
	
	public function getDescripcion()
	{
		return $this->descripcion;
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

