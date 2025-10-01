<?php
abstract class ErrorTransaccionListaFiltroBase extends ManagementFilter
{

	public function getCampos($empty_default)
	{
		
		
		$this->table = "iso_errortransaccion";
		
		$get = $this->skypEmpty(Vars::req($this->table,true));
		
		$filtros   = array(
					"codigo_error" => Form::Texto(
						array(
								"name" => $this->table."[codigo_error]" , 
								"label" => "Codigo error",
								"id" => "codigo_error",
								"lista" => "",
								"default" => "",
								"serial" => false
								
							)
						),
					"descripcion" => Form::Texto(
						array(
								"name" => $this->table."[descripcion]" , 
								"label" => "Descripcion",
								"id" => "descripcion",
								"lista" => "",
								"default" => "",
								"serial" => false
								
							)
						),
					"cdate" => Form::RangoFecha(
						array(
								"name" => $this->table."[cdate]" , 
								"label" => "Fecha de creacion",
								"id" => "cdate",
								"lista" => "",
								"default" => "",
								"serial" => false
								
							)
						),
					"numero_orden_local" => Form::Texto(
						array(
								"name" => $this->table."[numero_orden_local]" , 
								"label" => "Numero Orden Isocrates",
								"id" => "numero_orden_local",
								"lista" => "",
								"default" => "",
								"serial" => false
								
							)
						),
					"transaccion_id" => Form::Texto(
						array(
								"name" => $this->table."[transaccion_id]" , 
								"label" => "Transaccion Id",
								"id" => "transaccion_id",
								"lista" => "",
								"default" => "",
								"serial" => false
								
							)
						),


		);
		
		foreach($filtros as $nombre => $campo):
			
			$empty = true;
			
			if(isset($get[$nombre])):
			
				$empty = false;
				$campo->setValue($get[$nombre]);

			endif;
			
			if($empty_default === true):
					
					$campo->setDefault("");
			
			endif;
			
			if($campo->getDefault() && $empty === true):
				Manager::Load("maker","Tags");
				$campo->setValue(Tags::processDefault($campo->getDefault()));
			
			endif;
			
		endforeach;
		
		return $filtros;
		
	}
	
	public function getOrderBy()
	{
			return array("orden" => "error_transaccion_id" , "direccion" => "DESC");
	}
	
}
