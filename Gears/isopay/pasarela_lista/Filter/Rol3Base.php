<?php
abstract class PasarelaListaFiltroBase extends ManagementFilter
{

	public function getCampos($empty_default)
	{
		
		
		$this->table = "iso_pasarela";
		
		$get = $this->skypEmpty(Vars::req($this->table,true));
		
		$filtros   = array(
					"nombre" => Form::Texto(
						array(
								"name" => $this->table."[nombre]" , 
								"label" => "Nombre",
								"id" => "nombre",
								"lista" => "",
								"default" => "",
								"serial" => false
								
							)
						),
					"estado" => Form::ListaMultiple(
						array(
								"name" => $this->table."[estado]" , 
								"label" => "Estado",
								"id" => "estado",
								"lista" =>  Listas::Get("iso_pasarela",true),
								"default" => "",
								"serial" => false
								
							)
						),
					"cdate" => Form::Fecha(
						array(
								"name" => $this->table."[cdate]" , 
								"label" => "Fecha de creación",
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
			return array("orden" => "pasarela_id" , "direccion" => "DESC");
	}
	
}
