<?php

abstract class EmpresaFichaInputsBase extends ManagementInput
{
	public function getCampos($data = null)
	{

		$this->data 	 = $data;
		$this->table	 = "iso_empresa";
		$this->form_name = "EmpresaFichaForm";
		
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
								"id"	=> "iso_empresa_nombre",
								"lista" => "",
								
								
							)
						),		
					"rut" =>  Form::Texto(
						array(
								"name"  => $this->table."[rut]" , 
								"label" => "Rut",
								"class" => "required" ,
								"form" => $this->getName() ,
								"icon" 	=> "" ,
								"default" => "" ,
								"title" => "" ,
								"id"	=> "iso_empresa_rut",
								"lista" => "",
								
								
							)
						),		
					"tipo" =>  Form::Lista(
						array(
								"name"  => $this->table."[tipo]" , 
								"label" => "Tipo",
								"class" => "required" ,
								"form" => $this->getName() ,
								"icon" 	=> "" ,
								"default" => "" ,
								"title" => "" ,
								"id"	=> "iso_empresa_tipo",
								"lista" => Listas::Get("iso_empresa","--",true),
								
								
							)
						),		
					"cdate" =>  Form::Hidden(
						array(
								"name"  => $this->table."[cdate]" , 
								"label" => "Fecha de creación",
								"class" => "" ,
								"form" => $this->getName() ,
								"icon" 	=> "" ,
								"default" => "[DATE_TIME]" ,
								"title" => "" ,
								"id"	=> "iso_empresa_cdate",
								"lista" => "",
								
								
							)
						),		
					"empresa_id" =>  Form::Hidden(
						array(
								"name"  => $this->table."[empresa_id]" , 
								"label" => "",
								"class" => "" ,
								"form" => $this->getName() ,
								"icon" 	=> "" ,
								"default" => "" ,
								"title" => "" ,
								"id"	=> "iso_empresa_empresa_id",
								"lista" => "",
								
								
							)
						),		

		);
		
		return $campos;
		

	
	}
	
	public function getAcciones()
	{	
			
        $this->table	 = "iso_empresa";
		$this->form_name = "EmpresaFichaForm";
        
            $acciones = array(
				"save" 	=> Form::Submit(array(
												"name"	=> "save" ,
												"value"	=> "Guardar" ,
												"class"	=>"btn btn-sm ".Init::B_SAVE ,
												"icon"	=> Init::ICON_SAVE,
												"form" 	=> $this->getName(),
												"extra" => array("action" => "EmpresaFichaSave" ))
									),
				"delete" => Form::Submit(array(
													"name"	=> "delete" ,
													"class"	=>"btn btn-sm ".Init::B_DELETE,
													"value"	=> "Eliminar" ,
													"icon"	=> Init::ICON_DELETE,
													"form" 	=> $this->getName(),
													"extra" => array("action" => "EmpresaFichaDelete"))
											)
			);
		
			return $acciones;										
	}
	
	public function getName()
	{
		return $this->form_name;
	}	


}
