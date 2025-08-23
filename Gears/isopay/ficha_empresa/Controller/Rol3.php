<?php

if(Errores::hasError("Empresa"))	
{
	 $js = JS::MensaggeError(implode("<br>",Errores::hasError("Empresa")));
}
else
{
	
	if(Vars::req("_dialog_guid_"))	
	{
		if(Vars::req("action") == "EmpresaFichaDelete")
			$js[] = "$.sys.cerrarDialogWindow('".Vars::req("_dialog_guid_")."')";			
		else
			$js[] = "$.sys.refreshDialog('".Vars::req("_dialog_guid_")."',{'view':'EmpresaFicha','empresa_id':'".Crypt::Enc($objeto->getDao()->getEmpresaId())."'});";
	}
	else
	{
	
		if(Vars::req("action") == "EmpresaFichaDelete"):
			$js = "location.href='./?view=EmpresaLista';";
		endif;
		
		if(Vars::req("action") == "EmpresaFichaSave"):
			$js= "$.sys.loadInContent({'view':'EmpresaFicha','empresa_id':'".Crypt::Enc($objeto->getDao()->getEmpresaId())."'});";
		endif;
	}
}
$this->ExecuteJs($js);

