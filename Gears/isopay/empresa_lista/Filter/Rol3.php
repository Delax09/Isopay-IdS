<?php
class EmpresaListaFiltro extends EmpresaListaFiltroBase
{

	public function getCampos($empty_default = false)
	{
		
		$filtros   = parent::getCampos($empty_default);
		
		return (object) $filtros;
		
	}
	
	public function getOrderBy()
	{
			return parent::getOrderBy();
	}

}