<?php

//Función que cargar un fichero de tablas
function cargar_fichero($nombre)
{
	$datos = file_get_contents($nombre);
	$resultado = json_decode($datos, true);
	return $resultado;
}
	
//Devuelve el resultado del parámetro k0	
function buscar_k0($fuente, $maquina, $valores)
{
	foreach ($valores as $valor)
	{
		if (($valor['fp']==$fuente)&&($valor['maquina']==$maquina))
			return $valor['valor'];
	}
}

//Divuelve el resultado de la tabla Y
function buscar_y($dientes, $valores)
{
	foreach ($valores as $valor)
	{
		if (($valor['numdientes']==$dientes))
			return $valor['Y'];
	}
}

//Devuelve el resultado de la tabla cma
function buscar_cma($condicion, $parametro, $valores)
{
	
	foreach ($valores as $valor)
	{
		if ($valor['condicion']==$condicion)		    
			return $valor["$parametro"];
	}
}

//Devuelve el resultado de la tabla kr
function buscar_kr($condicion, $valores)
{
	
	foreach ($valores as $valor)
	{
		if ($valor['confiabilidad']==$condicion)		    
			return $valor["KR"];
	}
}


//Devuelve el resultado de la tabla CP
function buscar_cp($tipo,$material,$valores)
{
  $resultado=null;
  foreach($valores as $valor)
  {
	  if(($tipo=="pinon")&&($valor["material"]==$material))
	  {
			$resultado["psi"]=$valor["eppsi"];
			$resultado["mpa"]=$valor["epmpa"];			  
	  } 
	  elseif(($tipo=="corona")&&($valor["material"]==$material))
	  {
			$indicepsi="egpsi_".$material;		
			$indicempa="egmpa_".$material;	  
			$resultado["psi"]=$valor["$indicepsi"];
			$resultado["mpa"]=$valor["$indicempa"];
	  }		
  }
  return($resultado);
  
}


//Devuelve el resultado de la tabla j_recto
function buscar_jrecto($z1, $z2, $valores)
{
	foreach ($valores as $valor)
	{
		if ($valor['geometricos']==$z1)		    
			return $valor["$z2"];
	}
}

//Devuelve el resultado de la tabla j_prima
function buscar_jprima($z1, $psi, $valores)
{
	foreach ($valores as $valor)
	{
		if ($valor['angulo']==$psi)		    
			return $valor["$z1"];
	}
}

//Devuelve el resultado de la tabla j_prima
function buscar_jmodif($z1, $psi, $valores)
{
	foreach ($valores as $valor)
	{
		if ($valor['angulo']==$psi)		    
			return $valor["$z1"];
	}
}


//Función que calcula el valor de j_helicoidal
function calcular_jhelicoidal($z1, $psi)
{
  $prima=cargar_fichero("./tablas/jprima.json");
  $modif=cargar_fichero("./tablas/jmodif.json");
  $res_prima=buscar_jprima($z1, $psi, $prima);
  $res_modif=buscar_jmodif($z1, $psi, $prima);
  $resultado=$res_prima*$res_modif;
  return $resultado;
}

//Función que calcula el valor de j_recto
function calcular_jrecto($z1, $z2)
{
  $fichero=cargar_fichero("./tablas/jrectos.json");
  $resultado=buscar_jrecto($z1, $z2, $fichero);
  return $resultado;
}



//Función que calcula el valor de wt
function calcular_wt($HP, $n, $dt)
{
	$pi=3.14159268;
	$v=($pi*$dt*$n)/12;
	$wt=(33000*$HP)/$v;	
	return $wt;
	//lbf
}

//Función que calcula el valor de k0
function calcular_k0($carga_transmitida, $transmision)
{
  $fichero=cargar_fichero("./tablas/k0.json");
  $resultado=buscar_k0($carga_transmitida, $transmision, $fichero);
  return $resultado;
}

//Función que calcula el valor de kv
function calcular_kv($Qv, $n, $dt)
{
	$pi=3.14159268;
	$B1=0.25*(12-$Qv)^(2/3);
	$A1=50+56*(1-$B1);
	$v=($pi*$dt*$n)/12;
	$kv=(($A1+($v)^(1/2))/$A1)^$B1;
	return $kv;
	//No tiene unidades, es adimensional
}

//Función que calcula el valor de ks
function calcular_ks($F, $Z, $Pt, $psi)
{
	$lewis=cargar_fichero("./tablas/factorlewis.json");	
	if($psi!=-1)
		$Zeq=$Z/((cos($psi))^3);	
	else
		$Zeq=$Z;
	
	$Y=buscar_y($Z, $lewis);
	$Ks=1.192*($F*sqrt($Y)/$Pt)^0.0535;
	return ($Ks);
}

//Función que calcula el valor de km
function calcular_km($cmc, $F, $cma, $cpm, $dt, $ce)
{
	$cpf=0;
	$f10=0;
	if(($F/(10*$dt))<=0.05)
		$f10=0.05;
	else
		$f10=$F/(10*$dt);	
	
	if($F<=1)
		$cpf=$f10-0.25;
	elseif($F>1 && $F<=17)
		$cpf=$f10-0.0375+0.0125*$F;
	elseif ($F>17 && $F<=40)
		$cpf=$f10-0.1109+0.0207*$F-0.000228*$F^2;
	
	$cmafichero=cargar_fichero("./tablas/cma.json");	
	
	$A=buscar_cma($cma, 'A', $cmafichero);
	$B=buscar_cma($cma, 'B', $cmafichero);
	$C=buscar_cma($cma, 'C', $cmafichero);
	$cma_final=$A+$B*$F+$B*$F^2;
	
	$km=1+$cmc*($cpf*$cpm+$cma_final*$ce);
	return($km);
	
}

//Función que calcula el valor de kb
function calcular_kb($tr, $ht)
{
	$mb=$tr/$ht;
	$kb=0;
	if($mb<1.2)
	{
		$kb=1.6*log(2.42/$mb);
	}
	else
	{
		$kb=1;
	}

	return $kb;
}


//Función que calcula el valor de st
function calcular_st($HB, $material, $grado)
{
    $st=0;

	if($material=="acero_completamente_endurecido")
	{
		if($grado==1)
			$st=77.3*$HB+12800;		
		else
			$st=102*$HB+16400;					
	}
	elseif($material=="acero_nitrurado_endurecido_completamente")
	{
		if($grado==1)
			$st=83.3*$HB+12150;		
		else
			$st=108.6*$HB+15890;			
	}
	elseif($material=="acero_nitrurado_nitroalloy")
	{
		if($grado==1)
			$st=86.2*$HB+12730;		
		else
			$st=113.8*$HB+16650;			
	}
	elseif($material=="acero_nitrurado_2,5%_Cr")
	{
		if($grado==1)
			$st=105.2*$HB+9280;		
		elseif($grado==2)
			$st=105.2*$HB+22280;			
		else
			$st=105.2*$HB+29280;	
	}	

    return($st);
}


//Función que calcula el valor de yn
function calcular_yn($HB, $N)
{
	$yn=0;
	if($HB==400)
	{
		$yn=(9.4518*$N)^-0.148;
	}
	elseif ($HB==310)
	{
		$yn=(6.1514*$N)^-0.1192;
	}
	elseif ($HB==250)
	{
		$yn=(4.9404*$N)^-0.1045;
	}
	elseif ($HB==210)
	{
		$yn=(3.517*$N)^-0.0817;
	}
	elseif ($HB==160)
	{
		$yn=(2.3194*$N)^-0.0538;
	}	
	return $yn;
}


//Función que calcula el valor de kr
function calcular_kr($R)
{
	$confiabilidad=cargar_fichero("./tablas/kr.json");	
	return (buscar_kr($R, $confiabilidad));
}

//Función que calcula el valor de cp
function calcular_cp($tipo,$material)
{
	$tabla_cp=cargar_fichero("./tablas/cp.json");	
	return (buscar_cp($tipo,$material,$tabla_cp));
}


//Función que calcula el valor de Sc
function calcular_sc($HB, $grado)
{
	$sc=0;
	if($grado==1)
	{
		$sc=349*$HB+34300;
	}
	elseif ($grado==2)
	{
		$sc=322*$HB+29100;
	}
	return $sc;
}

//Función que calcula el valor de Zn
function calcular_zn($N, $nitrurado)
{
	$zn=0;
	if($nitrurado==0)
	{
		$zn=(2.466*$N)^-0.056;
	}
	elseif ($nitrurado==1)
	{
		$zn=(1.249*$N)^-0.0138;
	}
	return $zn;
}

//Función que calcula el valor de Zn
function calcular_ch($hbp, $hbg, $corona)
{
	$ch=0;	
	if($corona=="corona")
	{
       	$division=$hbp/$hbg;
		if($division>=1.2 && $division<=1.7)
			$A=8.98*0.001*$division-8.29*0.001;
		elseif($division<1.2)
			$A=0;
		elseif($division>1.7)
			$A=0.00698;
	
	    $ch=1+$A*($division-1); 
	}
	else
	{
		$ch=1;
	}
	return $ch;
}

//Función para el cálculo de Sf
function calcular_sf($HB, $material, $grado, $N, $F, $J, $Z, $n, $ht, $R, $carga_transmitida, $transmision, $Qv, $dt,$Pt,$cmc,$cpf,$cpm, $cma, $Ce, $tr, $psi)
{
	$st=calcular_st($HB, $material, $grado);
	$yn=calcular_yn($HB,$N);
	$kr=calcular_kr($R);
	$k0=calcular_k0($carga_transmitida, $transmision);
	$kv=calcular_kv($Qv, $n, $dt);
	$ks=calcular_ks($F, $Z, $Pt, $psi);
	$km=calcular_km($cmc, $F, $cma, $cpm, $dt, $Ce);
    $pi=3.14159268;	
	$sf=($st*$yn*$F*$J*$pi*$Z*$n*$ht)/($kr*33000*$k0*$kv*$ks*($Pt^2)*$km*$tr);
	return ($sf);
}



?>