<?php

abstract class EmpresaBase extends Manager implements DboBaseObject
{
	
	use TraitDboBaseObject;	
	
	public function __construct()
	{
		$dao = null;
		$this->clave 	= "empresa_id";
		$this->tabla 	= "iso_empresa";
		$this->name 	= "Empresa";
		$this->status	= false;
		$this->setDao(null);

		
		$this->fields = array(
					"empresa_id"		=> array("int",11,true,false,false,null), /*TIPO , LARGO , ES PK? (true), Es Serializado , Es Html,ListaBack*/
					"nombre"		=> array("varchar",50,false,false,false,null), /*TIPO , LARGO , ES PK? (true), Es Serializado , Es Html,ListaBack*/
					"rut"		=> array("varchar",20,false,false,false,null), /*TIPO , LARGO , ES PK? (true), Es Serializado , Es Html,ListaBack*/
					"tipo"		=> array("int",1,false,false,false,null), /*TIPO , LARGO , ES PK? (true), Es Serializado , Es Html,ListaBack*/
					"cdate"		=> array("datetime",null,false,false,false,null), /*TIPO , LARGO , ES PK? (true), Es Serializado , Es Html,ListaBack*/

		);

        if(self::$skyp == false):

            $this->object_vars = is_array(Vars::req($this->tabla)) ? Vars::req($this->tabla , $this->fieldConf()) : false;

            if(Vars::req($this->clave) && !Vars::req("_system_json_"))
            {
                if(!Crypt::Check(Vars::req($this->clave))):

                    exit("Clave de objeto inválida.");

                endif;

                $dao = $this->GetId(Vars::req($this->clave));


            }
            elseif(!empty($this->object_vars[$this->clave]) && !Vars::req("_system_json_"))
            {

                if(!Crypt::Check($this->object_vars[$this->clave])):

                        exit("Clave de objeto inválida.");

                endif;

                $dao = $this->GetId($this->object_vars[$this->clave]);



            }
		endif;
		$this->setDao($dao);
		
		if(is_array($this->object_vars)):
			$this->setVarsDao();
		endif;
		
	}
	

}
