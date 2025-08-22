<?php

class PasarelaFichaRunConfig extends PasarelaFichaHelper
{

	protected function Load()
	{
		

			if(Vars::req(Init::_SYSTEM_EXPORT_,true) == true):

                    set_time_limit(Init::_SYSTEM_EXPORT_TIME_LIMIT_);
                    return parent::Export();

            endif;
		
	}

}

