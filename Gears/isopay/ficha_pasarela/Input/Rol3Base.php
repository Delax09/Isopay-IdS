<?php

abstract class PasarelaFichaInputsBase extends ManagementInput
{
	public function getCampos($data = null)
	{

		$this->data 	 = $data;
		$this->table	 = "iso_pasarela";
		$this->form_name = "PasarelaFichaForm";
		
		if(!empty($this->grupo)):
			$this->table = $this->grupo."[".$this->table."]";
		endif;

		
		
		$campos = array(
					"nombre" =>  Form::Texto(
						array(
								"name"  => $this->table."[nombre]" , 
								"label" => "Nombre",
								"class" => "required" ,
								"form" => $this->getName() ,
								"icon" 	=> "" ,
								"default" => "" ,
								"title" => "" ,
								"id"	=> "iso_pasarela_nombre",
								"lista" => "",
								
								
							)
						),		
					"estado" =>  Form::Lista(
						array(
								"name"  => $this->table."[estado]" , 
								"label" => "Estado",
								"class" => "required" ,
								"form" => $this->getName() ,
								"icon" 	=> "" ,
								"default" => "" ,
								"title" => "" ,
								"id"	=> "iso_pasarela_estado",
								"lista" => Listas::Get("iso_pasarela","--",true),
								
								
							)
						),		
					"cdate" =>  Form::Hidden(
						array(
								"name"  => $this->table."[cdate]" , 
								"label" => "Fecha de creacion",
								"class" => "" ,
								"form" => $this->getName() ,
								"icon" 	=> "" ,
								"default" => "[DATE_TIME]" ,
								"title" => "" ,
								"id"	=> "iso_pasarela_cdate",
								"lista" => "",
								
								
							)
						),		
					"pasarela_id" =>  Form::Hidden(
						array(
								"name"  => $this->table."[pasarela_id]" , 
								"label" => "Id",
								"class" => "" ,
								"form" => $this->getName() ,
								"icon" 	=> "" ,
								"default" => "" ,
								"title" => "" ,
								"id"	=> "iso_pasarela_pasarela_id",
								"lista" => "",
								
								
							)
						),		

		);
		
		return $campos;
		

	
	}
	
	public function getAcciones()
	{	
			
        $this->table	 = "iso_pasarela";
		$this->form_name = "PasarelaFichaForm";
        
            $acciones = array(
				"save" 	=> Form::Submit(array(
												"name"	=> "save" ,
												"value"	=> "Guardar" ,
												"class"	=>"btn btn-sm ".Init::B_SAVE ,
												"icon"	=> Init::ICON_SAVE,
												"form" 	=> $this->getName(),
												"extra" => array("action" => "PasarelaFichaSave" ))
									),
				"delete" => Form::Submit(array(
													"name"	=> "delete" ,
													"class"	=>"btn btn-sm ".Init::B_DELETE,
													"value"	=> "Eliminar" ,
													"icon"	=> Init::ICON_DELETE,
													"form" 	=> $this->getName(),
													"extra" => array("action" => "PasarelaFichaDelete"))
											)
			);
		
			return $acciones;										
	}
	
	public function getName()
	{
		return $this->form_name;
	}	


}
