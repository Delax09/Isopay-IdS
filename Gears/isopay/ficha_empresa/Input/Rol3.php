<?php

class EmpresaFichaInputs extends EmpresaFichaInputsBase
{
	public function getCampos($data = null)
	{

		$this->campos = parent::getCampos($data);
		
		return parent::setValues();
		

	
	}
	
	public function getAcciones()
	{	
			$acciones = parent::getAcciones();
		
			$acciones["back"] = Form::Submit(
												array(
													
													"class"	=>"btn btn-sm back btn-info btn-corner",
													"value"	=> "Volver" ,
													"icon"	=> "fa fa-arrow-left",
													
													)
											);

			if(UserAgent::esMobile()):
		
				foreach($acciones as $obj):
					
						$obj->setValue("");
						$obj->setClass("btn-icon");
		
				endforeach;
		
			endif;

			return $acciones;
	}
	
	
	public function getName()
	{
		return $this->form_name;
	}	


}