<?php


abstract class TransaccionBaseDao 
{
	
	use GenericFunctionDaoObject;
	
	private $_info_dao 	= array(
								"pk"		=>	"transaccion_id",
								"modulo"	=>	"isopay",
								"objeto"	=>	"Transaccion",
								"tabla"		=>	"iso_transaccion"
								);
	
	private $transaccion_id;
	private $monto;
	private $concepto;
	private $estado;
	private $numero_orden_local;
	private $numero_orden_pasarela;
	private $token;
	private $url;
	private $empresa_id;
	private $pasarela_id;
	private $cdate;

	
	
	public function setTransaccionId($val)
	{
		$this->transaccion_id = $val;
	}
	
	public function getTransaccionId()
	{
		return $this->transaccion_id;
	}
	
	public function setMonto($val)
	{
		$this->monto = $val;
	}
	
	public function getMonto()
	{
		return $this->monto;
	}
	
	public function setConcepto($val)
	{
		$this->concepto = $val;
	}
	
	public function getConcepto()
	{
		return $this->concepto;
	}
	
	public function setEstado($val)
	{
		$this->estado = $val;
	}
	
	public function getEstado()
	{
		return $this->estado;
	}
	
	public function setNumeroOrdenLocal($val)
	{
		$this->numero_orden_local = $val;
	}
	
	public function getNumeroOrdenLocal()
	{
		return $this->numero_orden_local;
	}
	
	public function setNumeroOrdenPasarela($val)
	{
		$this->numero_orden_pasarela = $val;
	}
	
	public function getNumeroOrdenPasarela()
	{
		return $this->numero_orden_pasarela;
	}
	
	public function setToken($val)
	{
		$this->token = $val;
	}
	
	public function getToken()
	{
		return $this->token;
	}
	
	public function setUrl($val)
	{
		$this->url = $val;
	}
	
	public function getUrl()
	{
		return $this->url;
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
	
	public function setCdate($val)
	{
		$this->cdate = $val;
	}
	
	public function getCdate()
	{
		return $this->cdate;
	}

	

}

