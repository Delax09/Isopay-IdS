<?php

class Validar
{

	static function esContacto($celular,$persona_id,$phone_id)
	{

		if(self::getTipoTelefono($celular) == "movil" ) :

			$celular = self::NormalizarTelefonos($celular);

			$Db = Sql::getInstance();
			$Db->Select(array("celular"))
				->From(array("api_wspcontacto"))
				->Equal("celular",$celular)
			->Execute();

			$Res = $Db->getResult();

			if(!$Res):

				$Db->Insert("api_wspcontacto")
				->Values(array(
									"celular"		=> 	$celular,
									"cdate"			=>	date("YmdHis"),
									"persona_id"	=>	$persona_id,
									"phone_id"		=> 	$phone_id


				))
				->Execute();

				return "nuevo";
			else:

				return "viejo";

			endif;




		else:

			return false;

		endif;


	}

	static function NumeroContrato($num)
	{
		
		$num = explode("-",$num);
		$num_1 = $num[0];
		$num_2 = $num[1];
		
		return str_pad($num_1, 5, '0', STR_PAD_LEFT)."-".$num_2;
		
	}
		
	
	static function getTipoTelefono($telefono)
	{
		
        if($telefono == ""):
        
            return false;
        
        endif;
		$telefono = self::NormalizarTelefonos($telefono);
		
		$tipo ="movil";
		
		if(substr($telefono,0,1)==2):
		
			$tipo = "fijo";	
		
		endif;
		
		return $tipo;
			
	}
	
	static function NormalizarTelefonos($telefono,$format = false)
	{
		
		$nueva_cadena = preg_replace('/[^0-9]/i', '', $telefono);
		$nueva_cadena = strrev($nueva_cadena);
		$nueva_cadena = substr($nueva_cadena,0,9);
		$nueva_cadena = strrev($nueva_cadena);
		
		if(strlen($nueva_cadena) == 8):
			
			if(substr($nueva_cadena,0,1)>=3):
			
					$nueva_cadena="9".$nueva_cadena;		
			
			else:
			
				$nueva_cadena="2".$nueva_cadena;		
				
			endif;
			
			$nueva_cadena = $nueva_cadena;
        elseif(strlen($nueva_cadena)!= 9):
        
            return false;
        
		endif;
		
		if($format == true):
			
			$nueva_cadena = substr($nueva_cadena,0,1)." ".substr($nueva_cadena,1,4)." ".substr($nueva_cadena,5,4);
		
		endif;
		
		return $nueva_cadena;
			
	}
	
	public static function TimeStamp($timestamp)
	{
		 
		$timestamp = (int) date("Y",$timestamp) ;

			if($timestamp <= 1969 ):

				return false;

			endif;
		
		return true;
		
	}
	
	public static function Email($str,$dns = null)
	{
	  $result = (false !== filter_var($str, FILTER_VALIDATE_EMAIL));

	  if ($result)
	  {
		
		  if($dns != null):
		  
		  	list($user, $domain) = split('@', $str);
		  	$result = checkdnsrr($domain, $dns);
		  
		  endif;
		  
	  }

	  return $result;
	}	

	public static function Rut($rut)
	{

		if($rut == ""):

			return false;
		
		endif;

		$rut = preg_replace('/[^k0-9]/i', '', $rut);
		$dv  = substr($rut, -1);
		$numero = substr($rut, 0, strlen($rut)-1);
		$i = 2;
		$suma = 0;
		
		foreach(array_reverse(str_split($numero)) as $v)
		{
			if($i==8)
				$i = 2;

			$suma += $v * $i;
			++$i;
		}

		$dvr = 11 - ($suma % 11);

		if($dvr == 11)
			$dvr = 0;
		if($dvr == 10)
			$dvr = 'K';

		if($dvr == strtoupper($dv))
			return true;
		else
			return false;
	}
	
	public static function FormatearRut($rut,$separador=".",$guion="-" ) {

		if(trim($rut) == ""):

			return "";

		endif;

		$rut = preg_replace('/[^k0-9]/i', '', $rut);
		$formatear = substr ( $rut, 0 , -1 );

		if(is_numeric($formatear))
		return number_format( $formatear*1 , 0, "", $separador) . $guion . substr ( $rut, strlen($rut) -1 , 1 );
		
	}

}