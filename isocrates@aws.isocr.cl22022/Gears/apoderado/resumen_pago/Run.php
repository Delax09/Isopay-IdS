<?php

class ResumenPagoApoderadoRun extends ResumenPagoApoderadoRunConfig
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

