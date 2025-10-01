<?php
Manager::Load("isopay","ErrorTransaccion");
$ErrorTransaccion = ErrorTransaccion::getInstance();

if(Vars::post(Init::ACTION))
{
	
	if(Vars::post(Init::ACTION) ==  Init::JEDIT):
		$ErrorTransaccion->Save();
	endif;	

	if(Vars::post(Init::ACTION) ==  Init::JDELETE):
		$delete = explode(",",Vars::post(Init::JID));
		foreach($delete as $id):
		$ErrorTransaccion->setDao($ErrorTransaccion->getId($id));
			$ErrorTransaccion->Delete();
			
		endforeach;
		
	endif;	
		
}
else
{

	$draw = Vars::post('draw');
	$row = Vars::post('start');
	$rowperpage = Vars::post('length'); // Rows display per page
	
	$columnIndex = @$_POST['order'][0]['column']; // Column index
	$columnName = @$_POST['columns'][$columnIndex]['data']; // Column name
	$columnSortOrder = @$_POST['order'][0]['dir']; // asc or desc

	
	
	$filtro = $this->getFiltro();//CONFIURACION FILTROS
	$filtros = $filtro->getCampos();//CONFIURACION CAMPOS FILTRO

	if($rowperpage > -1):

		$filtro->setLimit($rowperpage);//SETEAR LIMITE
		$filtro->setPage($row);//SETEAR OFFSET
	
	endif;
	
	$filtro->setListOrderBy($columnName." ".$columnSortOrder);
	
	
	$filtro->setOffset(0);//SETEAR OFFSET

	$data = $ErrorTransaccion->Filtrar($filtro);//OBTTENER RESULTADO EN BASE A LOS FILTOS INGRESADOS
	
	$lista = $this->getLista();
	
	$resultado = array();

	if($data)
	{

		
		$resultado["draw"]= intval($draw);
		$resultado["iTotalRecords"]= $data->total;
		$resultado["iTotalDisplayRecords"]=  $data->total;
	
		foreach($data->resultado as $key => $objeto):
	
				$row = array();
				$row+= $lista->getConf($objeto);
				
				
				foreach($row  as $name => $value):
						
						if(is_array($value)):
							
							$row[$name] = implode(", ",$value);
							
						endif;
	

						
				endforeach;
				
				$resultado["aaData"][] = $row; 
				
		endforeach;
		
	}
	else
	{
	
		$resultado["draw"]= intval($draw);
		$resultado["iTotalRecords"]= 0;
		$resultado["iTotalDisplayRecords"]=  0;
		$resultado["aaData"] = array();
		
	}
	header('Content-type: application/json');
	
		
	exit( json_encode($resultado));
}


