<?php
abstract class HistorialTransaccionListaFiltroBase extends ManagementFilter
{

	public function getCampos($empty_default)
	{
		
		
		$this->table = "iso_historialtransaccion";
		
		$get = $this->skypEmpty(Vars::req($this->table,true));
		
		$filtros   = array(
					"estado_anterior" => Form::Texto(
						array(
								"name" => $this->table."[estado_anterior]" , 
								"label" => "Estado anterior",
								"id" => "estado_anterior",
								"lista" => "",
								"default" => "",
								"serial" => false
								
							)
						),
					"estado_actual" => Form::Texto(
						array(
								"name" => $this->table."[estado_actual]" , 
								"label" => "Estado actual",
								"id" => "estado_actual",
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
					"transaccion_id" => Form::Texto(
						array(
								"name" => $this->table."[transaccion_id]" , 
								"label" => "Transaccion",
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
			return array("orden" => "historial_transaccion_id" , "direccion" => "DESC");
	}
	
}
