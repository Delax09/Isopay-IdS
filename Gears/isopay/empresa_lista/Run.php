<?php

class EmpresaListaRun extends EmpresaListaRunConfig
{

	public function BeforeLoad()		
	{
		
		
	}
	
	public function Load()
	{
		
		parent::Load();		
		parent::Execute();
		
	}
	
	public function AfterLoad()		
	{
		
		
	}

}

