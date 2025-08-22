<?php
include("registrar_empresa_CONFIG_.php");
class registrar_empresa_METHOD_ extends registrar_empresa_CONFIG_
{
	
	
	public function Run($req_objeto)
	{	

		$data = $req_objeto->request;
		
		$response = true;

		//Arr::View($data);#IMPRIMIR UN ARREGLO

		$rut = $data->rut;

		//LOS HELPER ESTAN EN LA RAIZ => Carpeta Helper
		if(!Validar::Rut($rut)):

			$response = array(
								"estatus" => false,
								"msg"	=> "Rut incorrecto"

			);


		else:

			$rut = Validar::FormatearRut($rut,"","" );

			Manager::Load("isopay","Empresa");
			$Empresa = Empresa::getInstance();

			$Check = $Empresa->Find(array(
											"rut" => $rut,
                                            "tipo" => $data->tipo


			));

			if($Check):

				$response = array(
					"estatus" => false,
					"msg"	=> "La empresa ya existe"

				);

			else:

				$DaoE = $Empresa->getEmptyDao();
				$DaoE->setNombre(trim($data->nombre));
				$DaoE->setTipo(trim($data->tipo));
				$DaoE->setRut($rut);
				$DaoE->setCdate(date("YmdHis"));

				$Empresa->setDao($DaoE)->Save();

				$response = array(
					"estatus" => true,
					"msg"	=> "Empresa registrada",
					"data"	=> $DaoE->_getDaoDescription()

				);


			endif;









		endif;


		
		
		return $this->Reponse($req_objeto ,$response);
		
		
	
	}
	
	
	
}