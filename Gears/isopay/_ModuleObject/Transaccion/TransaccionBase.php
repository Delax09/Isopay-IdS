<?php

abstract class TransaccionBase extends Manager implements DboBaseObject
{
	
	use TraitDboBaseObject;	
	
	public function __construct()
	{
		$dao = null;
		$this->clave 	= "transaccion_id";
		$this->tabla 	= "iso_transaccion";
		$this->name 	= "Transaccion";
		$this->status	= false;
		$this->setDao(null);

		
		$this->fields = array(
					"transaccion_id"		=> array("int",11,true,false,false,null), /*TIPO , LARGO , ES PK? (true), Es Serializado , Es Html,ListaBack*/
					"monto"		=> array("int",255,false,false,false,null), /*TIPO , LARGO , ES PK? (true), Es Serializado , Es Html,ListaBack*/
					"concepto"		=> array("varchar",255,false,false,false,null), /*TIPO , LARGO , ES PK? (true), Es Serializado , Es Html,ListaBack*/
					"estado"		=> array("varchar",20,false,false,false,null), /*TIPO , LARGO , ES PK? (true), Es Serializado , Es Html,ListaBack*/
					"numero_orden_local"		=> array("int",255,false,false,false,null), /*TIPO , LARGO , ES PK? (true), Es Serializado , Es Html,ListaBack*/
					"numero_orden_pasarela"		=> array("varchar",255,false,false,false,null), /*TIPO , LARGO , ES PK? (true), Es Serializado , Es Html,ListaBack*/
					"token"		=> array("varchar",255,false,false,false,null), /*TIPO , LARGO , ES PK? (true), Es Serializado , Es Html,ListaBack*/
					"url"		=> array("varchar",255,false,false,false,null), /*TIPO , LARGO , ES PK? (true), Es Serializado , Es Html,ListaBack*/
					"empresa_id"		=> array("int",11,false,false,false,null), /*TIPO , LARGO , ES PK? (true), Es Serializado , Es Html,ListaBack*/
					"pasarela_id"		=> array("int",11,false,false,false,null), /*TIPO , LARGO , ES PK? (true), Es Serializado , Es Html,ListaBack*/
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
