<?php
include("actualizar_empresa_CONFIG_.php");
class actualizar_empresa_METHOD_ extends actualizar_empresa_CONFIG_
{
	
	
	public function Run($req_objeto)
	{

		$data = $req_objeto->request;

		$rut = $data->rut;

		if(!Validar::Rut($rut)):

			$response = array(
				"estatus" => false,
				"msg"	=> "Rut incorrecto"

			);


		else:

			$rut = Validar::FormatearRut($rut,"","" );

			Manager::Load("isopay","Empresa");
			$Empresa = Empresa::getInstance();


			$DaoE = $Empresa->getId($data->empresa_id);

			if(!$DaoE):

				$response = array(
					"estatus" => false,
					"msg"	=> "Empresa no registrada"

				);

			else:


				$DaoE->setNombre(trim($data->nombre));
				$DaoE->setTipo(trim($data->tipo));
				$DaoE->setRut($rut);

				$Empresa->setDao($DaoE)->Save();

				$response = array(
					"estatus" => true,
					"msg"	=> "Empresa actualizada correctamente",
					"data"	=> $DaoE->_getDaoDescription()

				);


			endif;











		endif;



		return $this->Reponse($req_objeto ,$response);
		
		
	
	}
	
	
	
}