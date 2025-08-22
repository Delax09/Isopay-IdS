<?php
	Manager::Load("isopay","Pasarela");
	$Pasarela = Pasarela::getInstance();
	
	$filtro = $this->getFiltro();//CONFIURACION FILTROS
	$filtros = $filtro->getCampos();//CONFIURACION CAMPOS FILTRO
	
	$filtro->export = $export = $this->getExport(); //LINEA NUEVA

	$data = $Pasarela->Filtrar($filtro);//OBTTENER RESULTADO EN BASE A LOS FILTOS INGRESADOS

	
	$resultado = array();
	
	if($data)
	{
	
		foreach($data->resultado as $key => $objeto):
	
				array_push($resultado, array_values($export->getConf($objeto)));
		endforeach;
	
	}
	
	
	$header = array();
	
	foreach($export->getHeader() as $data):
		
		array_push($header,$data["name"]);
		
	endforeach;
	
	$titulo = $this->getTitulo();
	$Excel = new Excel;
	
	$Excel->setHeader($header)
	->setData($resultado)
	->setTitle(@$titulo[0]);
	
	if(Vars::req("format") == "xls")
		 $file = $Excel->getExcel(Init::secureExport());
	if(Vars::req("format") == "pdf")
		 $file = $Excel->getPdf(Init::secureExport());
	
	$html = '<div class="pull-center"><a class="btn btn-lg btn-primary" href="./download.php?file='.$file.'"  target="_blank"  ><i class="fa fa-download fa-3x pull-left"></i> Descargar Archivo<br><small></small></a></div>';
	
	exit($html);