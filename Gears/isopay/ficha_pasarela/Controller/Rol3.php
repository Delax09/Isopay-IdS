<?php

if(Errores::hasError("Pasarela"))	
{
	 $js = JS::MensaggeError(implode("<br>",Errores::hasError("Pasarela")));
}
else
{
	
	if(Vars::req("_dialog_guid_"))	
	{
		if(Vars::req("action") == "PasarelaFichaDelete")
			$js[] = "$.sys.cerrarDialogWindow('".Vars::req("_dialog_guid_")."')";			
		else
			$js[] = "$.sys.refreshDialog('".Vars::req("_dialog_guid_")."',{'view':'PasarelaFicha','pasarela_id':'".Crypt::Enc($objeto->getDao()->getPasarelaId())."'});";
	}
	else
	{
	
		if(Vars::req("action") == "PasarelaFichaDelete"):
			$js = "location.href='./?view=PasarelaLista';";
		endif;
		
		if(Vars::req("action") == "PasarelaFichaSave"):
			$js= "$.sys.loadInContent({'view':'PasarelaFicha','pasarela_id':'".Crypt::Enc($objeto->getDao()->getPasarelaId())."'});";
		endif;
	}
}
$this->ExecuteJs($js);

