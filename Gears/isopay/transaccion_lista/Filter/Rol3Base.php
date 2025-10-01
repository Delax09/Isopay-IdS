<?php
abstract class TransaccionListaFiltroBase extends ManagementFilter
{

	public function getCampos($empty_default)
	{
		
		
		$this->table = "iso_transaccion";
		
		$get = $this->skypEmpty(Vars::req($this->table,true));
		
		$filtros   = array(
					"monto" => Form::Texto(
						array(
								"name" => $this->table."[monto]" , 
								"label" => "Monto",
								"id" => "monto",
								"lista" => "",
								"default" => "",
								"serial" => false
								
							)
						),
					"concepto" => Form::Texto(
						array(
								"name" => $this->table."[concepto]" , 
								"label" => "Concepto",
								"id" => "concepto",
								"lista" => "",
								"default" => "",
								"serial" => false
								
							)
						),
					"estado" => Form::Texto(
						array(
								"name" => $this->table."[estado]" , 
								"label" => "Estado",
								"id" => "estado",
								"lista" => "",
								"default" => "",
								"serial" => false
								
							)
						),
					"numero_orden_local" => Form::Texto(
						array(
								"name" => $this->table."[numero_orden_local]" , 
								"label" => "N. Orden local",
								"id" => "numero_orden_local",
								"lista" => "",
								"default" => "",
								"serial" => false
								
							)
						),
					"token" => Form::Texto(
						array(
								"name" => $this->table."[token]" , 
								"label" => "Token",
								"id" => "token",
								"lista" => "",
								"default" => "",
								"serial" => false
								
							)
						),
					"url" => Form::Texto(
						array(
								"name" => $this->table."[url]" , 
								"label" => "Url",
								"id" => "url",
								"lista" => "",
								"default" => "",
								"serial" => false
								
							)
						),
					"empresa_id" => Form::ListaMultiple(
						array(
								"name" => $this->table."[empresa_id]" , 
								"label" => "Empresa",
								"id" => "empresa_id",
								"lista" =>  Listas::Get("iso_vinculo_empresa",true),
								"default" => "",
								"serial" => false
								
							)
						),
					"pasarela_id" => Form::ListaMultiple(
						array(
								"name" => $this->table."[pasarela_id]" , 
								"label" => "Pasarela",
								"id" => "pasarela_id",
								"lista" =>  Listas::Get("iso_vinculo_pasarela",true),
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
			return array("orden" => "transaccion_id" , "direccion" => "DESC");
	}
	
}
