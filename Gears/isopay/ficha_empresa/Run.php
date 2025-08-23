<?php

class EmpresaFichaRun extends EmpresaFichaRunConfig
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

