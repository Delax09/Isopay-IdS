<?php

class ErrorTransaccionListaRun extends ErrorTransaccionListaRunConfig
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

