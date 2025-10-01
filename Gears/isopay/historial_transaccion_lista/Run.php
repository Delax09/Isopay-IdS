<?php

class HistorialTransaccionListaRun extends HistorialTransaccionListaRunConfig
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

