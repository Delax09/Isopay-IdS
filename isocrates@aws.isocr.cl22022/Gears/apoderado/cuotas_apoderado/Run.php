<?php

class CuotasApoderadoRun extends CuotasApoderadoRunConfig
{

	public function BeforeLoad()		
	{
        


		if(Vars::req("token")): //FLOW

			parent::Execute("Flow");

		elseif(Vars::req("token_ws")):

			parent::Execute("Transbank");

		endif;


		
	}
	
	public function Load()
	{

		parent::Load();

		if(Vars::req("pagar") == 1):

			parent::Execute("Pagar");

		else:

			parent::Execute();

		endif;


		
	}
	
	public function AfterLoad()		
	{
		
		
	}

}

