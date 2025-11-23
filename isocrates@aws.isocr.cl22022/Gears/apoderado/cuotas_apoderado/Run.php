<?php

class CuotasApoderadoRun extends CuotasApoderadoRunConfig
{

	public function BeforeLoad()		
	{

        //Arr::view($_REQUEST);die;

        if(Vars::req("pagar") == 1):

            parent::Execute("Pagar");

        elseif(Vars::req("token")): //FLOW

			parent::Execute("Flow");

		elseif(Vars::req("token_ws")):

			parent::Execute("Transbank");

        elseif(Vars::req("preference_id")):

            parent::Execute("MercadoPago");

        elseif(Vars::req("pendiente") == 1):

            parent::Execute("Khipu");


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

