<?php 
//Inicio y destrucción de la sesión 
session_destroy();
session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="description" content="Herramienta para el cálculo de ecuaciones de esfuerzo AGMA">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>AGMA</title>
  </head>
  <body class="app sidebar-mini">
    <!-- Navbar-->
    <header class="app-header"><a class="app-header__logo" href="index.html">AGMA</a>
      <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar"></a>
      <!-- Navbar Right Menu-->
      <ul class="app-nav">
        <!-- User Menu-->
			<li><a class="dropdown-item" href="ayuda.php"><i class="fa fa-cog fa-lg"></i> Ayuda</a></li>
      </ul>
    </header>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="./images/logo.jpg" alt="Logo Aplicación">

      </div>
      <ul class="app-menu">
        <li><a class="app-menu__item active" href="index.php"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Inicio</span></a></li>
        <li><a class="app-menu__item active" href="unparametro.php"><i class="app-menu__icon fa fa-gears"></i><span class="app-menu__label">Un Parámetro</span></a></li>	
		
      </ul>
    </aside>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1>Cálculo de Ecuaciones de Esfuerzo AGMA</h1>
          <p>Opción para el cálculo de un parámetro</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="./index.php">Inicio</a></li>
        </ul>
      </div>
	  
<?php

  if (($_POST['tipoengranaje']!='recto') && ($_POST['tipoengranaje']!='helicoidal'))
  {
	
	echo('<meta http-equiv="refresh" content="0;url=./unparametro.php">');
  }
  else    
  {
?>
      <div class="row">
        <div class="col-md-12">
			
	    <div class="col-md-6">
          <div class="tile">
            <h3 class="tile-title">Parámetros Seleccionados</h3>
            <div class="tile-body"><?php echo("Tipo de Engranaje: ". $_POST['tipoengranaje']); $_SESSION['tipoengranaje']=$_POST['tipoengranaje'];?></div>
			<div class="tile-body"><?php echo("Corona/Piñón: ". $_POST['coronapinon']); $_SESSION['coronapinon']=$_POST['coronapinon'];?></div>
			<div class="tile-body"><?php echo("Parámetro a Calcular: ". $_POST['parametro']); $_SESSION['parametro']=$_POST['parametro'];?></div>
          </div>
        </div>
			
			
			<div class="col-lg-4 offset-lg-1">	
			
			
			
			<form action="./realizarcalculoparametro.php" method="post">		
		            
				
				<?php
				  switch ($_POST['parametro']) {
					case 'wt':// Carga Tangencial
						?>
						<div class="form-group has-success">
							<label class="form-control-label" for="inputSuccess1">Potencia Transmitida (HP)</label>
							<input class="form-control is-valid" id="inputValid" type="text" name="HP">							
						</div>
						<div class="form-group has-success">
							<label class="form-control-label" for="inputSuccess1">Velocidad de Giro (n)</label>
							<input class="form-control is-valid" id="inputValid" type="text" name="n">							
						</div>
						<div class="form-group has-success">
							<label class="form-control-label" for="inputSuccess1">Diámetro de paso transversal (dt)</label>
							<input class="form-control is-valid" id="inputValid" type="text" name="dt">							
						</div>					
						<?php
						break;
					case 'k0'://Factor de Sobrecarga
						?>
						<div class="form-group">
      					     <label for="seleccion_parametro">Carga Transmitida</label>
       					    <select class="form-control" id="seleccion_parametro" name="carga_transmitida">
                			    <option value="uniforme">Uniforme</option>
                  		        <option value="im"> Impacto Moderado</option>
                                <option value="ip"> Impacto Pesado</option>
							</select>
                        </div>
						<div class="form-group">
      					    <label for="seleccion_parametro">Transmisión de Potencia</label>
       					    <select class="form-control" id="seleccion_parametro" name="transmision">
                			    <option value="uniforme">Uniforme</option>
                  		        <option value="il"> Impacto Ligero</option>
                                <option value="im"> Impacto Medio</option>
                       		</select>
                        </div>
                        <?php											
						break;
					case 'kv'://Factor dinámico
						?>
						<div class="form-group has-success">
							<label class="form-control-label" for="inputSuccess1">Número de Calidad (Qv)</label>
							<input class="form-control is-valid" id="inputValid" type="text" name="Qv">							
						</div>
						<div class="form-group has-success">
							<label class="form-control-label" for="inputSuccess1">Velocidad de Giro (n)</label>
							<input class="form-control is-valid" id="inputValid" type="text" name="n">							
						</div>		
						<div class="form-group has-success">
							<label class="form-control-label" for="inputSuccess1">Diámetro de paso transversal (dt)</label>
							<input class="form-control is-valid" id="inputValid" type="text" name="dt">							
						</div>							
						<?php
						break;
					case 'ks': //Factor de Tamaño
						?>
						<div class="form-group has-success">
							<label class="form-control-label" for="inputSuccess1">Ancho de Cara (F)</label>
							<input class="form-control is-valid" id="inputValid" type="text" name="F">							
						</div>
						<div class="form-group has-success">
							<label class="form-control-label" for="inputSuccess1">Número de Dientes (Z)</label>
							<input class="form-control is-valid" id="inputValid" type="text" name="Z">													
						</div>	
						<div class="form-group has-success">
							<label class="form-control-label" for="inputSuccess1">Paso diametral transversal (Pt)</label>
							<input class="form-control is-valid" id="inputValid" type="text" name="Pt">							
						</div>						
						<?php	
						if($_SESSION['tipoengranaje']=="helicoidal")
						{
						?>	
						<div class="form-group has-success">
							<label class="form-control-label" for="inputSuccess1">Ángulo de Hélice Radianes (psi)</label>
							<input class="form-control is-valid" id="inputValid" type="text" name="psi">							
						</div>						
						<?php
						}						
						break;
					case 'km'://Factor de distribución de carga
						?>
  						<div class="form-group">
					        <label for="seleccion_parametro">Cmc</label>
					        <select class="form-control" id="seleccion_parametro" name="cmc">
			                    <option value="0.8">Parámetro (coronados)</option>
								<option value="1">Parámetro (sin coronar)</option>
                    		</select>
					    </div>
						<div class="form-group has-success">
							<label class="form-control-label" for="inputSuccess1">Ancho de Cara (F)</label>
							<input class="form-control is-valid" id="inputValid" type="text" name="F">							
						</div>
					       
					    <div class="form-group">
          					<label for="seleccion_parametro">Cma</label>
     						<select class="form-control" id="seleccion_parametro" name="cma">
         					    <option value="engranajes_abiertos">Parámetro (engranajes abiertos)</option>
              				    <option value="comerciales_cerradas">Parámetro (unidades comerciales cerradas)</option>
                      		    <option value="precision_cerradas">Parámetro (unidades de presición cerradas)</option>
							    <option value="precision_extrema_cerradas">Parámetro (unidades de presición extrema cerradas)</option>
                    		</select>
						</div>
						<div class="form-group">
          					<label for="seleccion_parametro">Cpm</label>
     						<select class="form-control" id="seleccion_parametro" name="cpm">
								<option value="1">Parámetro (S1/S&lt;0.175)</option>
								<option value="0.8">Parámetro (S1/S>=0.175)</option>
                    		</select>
  						</div>
						<div class="form-group has-success">
							<label class="form-control-label" for="inputSuccess1">Diámetro de paso transversal (dt)</label>
							<input class="form-control is-valid" id="inputValid" type="text" name="dt">							
						</div>
						<div class="form-group">
          					<label for="seleccion_parametro">Ce</label>
     						<select class="form-control" id="seleccion_parametro" name="ce">
         					    <option value="0.8">Ajustados o Lapeados (0.8)</option>
              				    <option value="1"> Otras Condiciones (1)</option>
                    		</select>
  						</div>
						<?php					
						break;
					case 'kb'://Factor de espesor de aro
						?>
						<div class="form-group has-success">
							<label class="form-control-label" for="inputSuccess1">Espesor del aro debajo del diente (tr)</label>
							<input class="form-control is-valid" id="inputValid" type="text" name="tr">							
						</div>
						<div class="form-group has-success">
							<label class="form-control-label" for="inputSuccess1">Profundidad Total (ht)</label>
							<input class="form-control is-valid" id="inputValid" type="text" name="ht">							
						</div>						
						<?php					
						break;
					case 'j'://Parámetro J
						?>
						<div class="form-group has-success">
							<label class="form-control-label" for="inputSuccess1">Número de Dientes Piñon (Zp)</label>
							<input class="form-control is-valid" id="inputValid" type="text" name="zp">							
						</div>
						<div class="form-group has-success">
							<label class="form-control-label" for="inputSuccess1">Número de Dientes Corona (Zg)</label>
							<input class="form-control is-valid" id="inputValid" type="text" name="zg">													
						</div>					
						<?php
						if($_SESSION['tipoengranaje']=="helicoidal")
						{
						?>	
						<div class="form-group has-success">
							<label class="form-control-label" for="inputSuccess1">Ángulo de Hélice Radianes (psi)</label>
							<input class="form-control is-valid" id="inputValid" type="text" name="psi">							
						</div>						
						<?php
						}												
						break;
					case 'st'://Parámetro St
						?>
						<div class="form-group has-success">
							<label class="form-control-label" for="inputSuccess1">Dureza Brinell (HB)</label>
							<input class="form-control is-valid" id="inputValid" type="text" name="HB">							
						</div>	

						 <div class="form-group">
          					<label for="seleccion_parametro">Material</label>
     						<select class="form-control" id="seleccion_parametro" name="material">
         					    <option value="acero_completamente_endurecido">Acero completamente endurecido</option>
								<option value="acero_nitrurado_endurecido_completamente">Acero nitrurado endurecido</option>
								<option value="acero_nitrurado_nitroalloy">Acero nitrurado-nitroalloy</option>
						        <option value="acero_nitrurado_2,5%_Cr">Acero nitrurado-2,5 Cr</option>
							</select>	
						</div>
						<div class="form-group">
          						<label for="seleccion_parametro">Grado</label>
     						   	<select class="form-control" id="seleccion_parametro" name="grado">
         					    	<option value="1">Grado 1</option>
              				    	<option value="2">Grado 2</option>
									<option value="3">Grado 3 (Solo Acero nitrurado-2,5 Cr)</option>
								</select>
  						</div>
              				       	             					
						<?php						
						break;
					case 'yn'://Factor de ciclos de esfuerzo de presión
						?>
          				<label for="seleccion_parametro">Dureza Brinell</label>
     					<select class="form-control" id="seleccion_parametro" name="HB">
         				   	<option value="400">400 HB</option>
              			   	<option value="310">Superficie Carburizada</option>
							<option value="250">250 HB</option>
							<option value="210">Nitrurado</option>
							<option value="160">160 HB</option>
						</select>
						
						<div class="form-group has-success">
							<label class="form-control-label" for="inputSuccess1">Número de Ciclos de Carga (N)</label>
							<input class="form-control is-valid" id="inputValid" type="text" name="N">							
							
						</div>						
						<?php						
						break;
					case 'kt':
						?>
						<div class="form-group has-success">
							<label class="form-control-label" for="inputSuccess1">No es necesario ningún parámetro</label>
							
						</div>				
						<?php
						break;
					case 'kr':// Factor de confiabilidad
						?>
						<div class="form-group">
							<label for="seleccion_parametro">Confiabilidad (R)</label>
							<select class="form-control" id="seleccion_parametro" name="R">
								<option value="0.9999">0.9999</option>
								<option value="0.999">0.999</option>
								<option value="0.99">0.99</option>
								<option value="0.90">0.90</option>
								<option value="0.50">0.50</option>
							</select>
						</div>
						<?php							
						break;
					case 'sf': //Factor de seguridad
						?>
						<div class="form-group">
      					    <label for="seleccion_parametro">Carga transmitida</label>
       					    <select class="form-control" id="seleccion_parametro" name="carga_transmitida">
                			    <option value="uniforme">Uniforme</option>
                  		        <option value="impacto_moderado">Impacto moderado</option>
                                <option value="impacto_pesado">Impacto pesado</option>
                       		</select>
                        </div>
						<div class="form-group">
      					    <label for="seleccion_parametro">Transmisión de potencia</label>
       					    <select class="form-control" id="seleccion_parametro" name="transmision">
                			    <option value="uniforme">Uniforme</option>
                  		        <option value="impacto_ligero">Impacto ligero</option>
                                <option value="impacto_medio">Impacto medio</option>
                       		</select>
                        </div>                        										
						<div class="form-group has-success">
							<label class="form-control-label" for="inputSuccess1">Potencia Transmitida (HP)</label>
							<input class="form-control is-valid" id="inputValid" type="text" name="Pt">							
						</div>
						<div class="form-group has-success">
							<label class="form-control-label" for="inputSuccess1">Velocidad de Giro (n)</label>
							<input class="form-control is-valid" id="inputValid" type="text" name="n">							
						</div>	
                                                <div class="form-group has-success">
							<label class="form-control-label" for="inputSuccess1">Espesor del aro debajo del diente (tr)</label>
							<input class="form-control is-valid" id="inputValid" type="text" name="tr">							
						</div>
						<div class="form-group has-success">
							<label class="form-control-label" for="inputSuccess1">Profundidad Total (ht)</label>
							<input class="form-control is-valid" id="inputValid" type="text" name="ht">							
						</div>		
                        <div class="form-group has-success">
							<label class="form-control-label" for="inputSuccess1">Dureza Brinell (HB)</label>
							<input class="form-control is-valid" id="inputValid" type="text" name="HB">							
						</div>
						<div class="form-group has-success">
							<label class="form-control-label" for="inputSuccess1">Número de Ciclos de Carga (N)</label>
							<input class="form-control is-valid" id="inputValid" type="text" name="N">							
						</div>	
                        
						<div class="form-group has-success">
							<label class="form-control-label" for="inputSuccess1">Ángulo de Hélice Radianes (psi)</label>
							<input class="form-control is-valid" id="inputValid" type="text" name="psi">							
						</div>						
	
						<div class="form-group has-success">
							<label class="form-control-label" for="inputSuccess1">Número de Dientes del Piñon (Z)</label>
							<input class="form-control is-valid" id="inputValid" type="text" name="Z">													
						</div>	
						<div class="form-group has-success">
							<label class="form-control-label" for="inputSuccess1">Número de Dientes de la Corona(Zg)</label>
							<input class="form-control is-valid" id="inputValid" type="text" name="Zg">													
						</div>	
						<div class="form-group has-success">
							<label class="form-control-label" for="inputSuccess1">Número de Calidad (Qv)</label>
							<input class="form-control is-valid" id="inputValid" type="text" name="Qv">							
						</div>	
					    <div class="form-group">
          					<label for="seleccion_parametro">Cma</label>
     						<select class="form-control" id="seleccion_parametro" name="cma">
         					    <option value="engranajes_abiertos">Engranajes abiertos</option>
              				    <option value="comerciales_cerradas">Unidades comerciales cerradas</option>
								<option value="precision_cerradas">Unidades de presición cerradas</option>
							    <option value="precisión_extrema_cerradas">Unidades de presición extrema cerradas</option>
                    		</select>
						</div>				
						<div class="form-group">
							<label for="seleccion_parametro">Confiabilidad (R)</label>
							<select class="form-control" id="seleccion_parametro" name="R">
								<option value="0.9999">0.9999</option>
								<option value="0.999">0.999</option>
								<option value="0.99">0.99</option>
								<option value="0.90">0.90</option>
								<option value="0.50">0.50</option>
							</select>
						</div>					
						<div class="form-group">
          					<label for="seleccion_parametro">Material</label>
     						<select class="form-control" id="seleccion_parametro" name="material">
         					    <option value="acero_completamente_endurecido">Acero completamente endurecido</option>
								<option value="acero_nitrurado_endurecido_completamente">Acero nitrurado endurecido</option>
								<option value="acero_nitrurado_nitroalloy">Acero nitrurado-nitroalloy</option>
						        <option value="acero_nitrurado_2,5%_Cr">Acero nitrurado-2,5 Cr</option>
							</select>
						</div>
				
						<div class="form-group">
          					<label for="seleccion_parametro">Grado</label>
     						<select class="form-control" id="seleccion_parametro" name="grado">
         					   	<option value="1">Grado 1</option>
              				   	<option value="2">Grado 2</option>
								<option value="3">Grado 3 (Solo Acero nitrurado-2,5 Cr)</option>
							</select>
  						</div>	
						<div class="form-group">
          					<label for="seleccion_parametro">Cpm</label>
     						<select class="form-control" id="seleccion_parametro" name="cpm">
         					    <option value="1">Parámetro (S1/S &lt; 0.175)</option>
              				   	<option value="0.8">Parámetro (S1/S>=0.175)</option>
                    		</select>
  						</div>
						<div class="form-group">
          					<label for="seleccion_parametro">Ce</label>
     						<select class="form-control" id="seleccion_parametro" name="Ce">
         					    <option value="0.8">Ajustados o lapeados (0.8)</option>
              				    <option value="1">Otras condiciones (1)</option>
                    		</select>
  						</div>
						<div class="form-group has-success">
							<label class="form-control-label" for="inputSuccess1">Diámetro de paso transversal (dt)</label>
							<input class="form-control is-valid" id="inputValid" type="text" name="dt">							
						</div>	
  						<div class="form-group">
					        <label for="seleccion_parametro">Cmc</label>
					        <select class="form-control" id="seleccion_parametro" name="cmc">
			                    <option value="0.8">Parámetro (coronados)</option>
                      			<option value="1">Parámetro (sin coronar)</option>
                    		</select>
					    </div>
						<div class="form-group has-success">
							<label class="form-control-label" for="inputSuccess1">Factor de Proporción del Piñón (cpf)</label>
							<input class="form-control is-valid" id="inputValid" type="text" name="cpf">							
						</div>	
						<div class="form-group has-success">
							<label class="form-control-label" for="inputSuccess1">Ancho de Cara (F)</label>
							<input class="form-control is-valid" id="inputValid" type="text" name="F">							
						</div>						
						
						<?php						
						break;
					case 'cp'://Coeficiente Elástico
						if($_SESSION['coronapinon']=="pinon")
						{
						
						?>
					    <div class="form-group">
					        <label for="seleccion_parametro">Material del piñón</label>
					        <select class="form-control" id="seleccion_parametro" name="material">
				                <option value="acero">Acero</option>
				                <option value="hierro_maleable">Hierro maleable</option>
				                <option value="hierro_nodular">Hierro nodular</option>
				                <option value="hierro_fundido">Hierro fundido</option>
				                <option value="bronce_al_aluminio">Bronce al aluminio</option>
				                <option value="bronce_al_estano">Bronce al estaño</option>
				            </select>
					    </div>
						<?php
						}
						else
						{
						?>	
						<div class="form-group">
					        <label for="seleccion_parametro">Material de la corona</label>
					        <select class="form-control" id="seleccion_parametro" name="material">
				                <option value="acero">Acero</option>
				                <option value="hierro_maleable">Hierro maleable</option>
				                <option value="hierro_nodular">Hierro nodular</option>
				                <option value="hierro_fundido">Hierro fundido</option>
				                <option value="bronce_al_aluminio">Bronce al aluminio</option>
				                <option value="bronce_al_estaño">Bronce al estaño</option>
				            </select>
					    </div>
					<?php		
						}
						break;
					case 'cf':// Factor de condición superficial
						?>
						<div class="form-group has-success">
							<label class="form-control-label" for="inputSuccess1">No es necesario ningún parámetro</label>
							
						</div>				
						<?php						
						break;
					case 'i':
						?>
						<div class="form-group has-success">
							<label class="form-control-label" for="inputSuccess1">Ángulo de Presión Transversal (phi)</label>
							<input class="form-control is-valid" id="inputValid" type="text" name="phi">							
						</div>
 						<div class="form-group has-success">
							<label class="form-control-label" for="inputSuccess1">Número de Dientes del piñón (Zp)</label>
							<input class="form-control is-valid" id="inputValid" type="text" name="zp">	
						</div>	
						<div class="form-group has-success">
							<label class="form-control-label" for="inputSuccess1">Número de Dientes de la corona (Zg)</label>
							<input class="form-control is-valid" id="inputValid" type="text" name="zg">					
						</div>	
						<div class="form-group has-success">
							<label class="form-control-label" for="inputSuccess1">Paso diametral transversal corona (Ptg)</label>
							<input class="form-control is-valid" id="inputValid" type="text" name="ptg">
						</div>
						<div class="form-group has-success">
							<label class="form-control-label" for="inputSuccess1">Paso diametral transversal piñon (Ptp)</label>
							<input class="form-control is-valid" id="inputValid" type="text" name="ptp">							
													
						</div>
                        <div class="form-group has-success">
							<label class="form-control-label" for="inputSuccess1">Ángulo de la Hélice (psi)</label>
							<input class="form-control is-valid" id="inputValid" type="text" name="psi">							
						</div>						
						<?php						
						break;
					case 'sc'://Esfuerzo de contacto permisible
						?>
						<div class="form-group has-success">
							<label class="form-control-label" for="inputSuccess1">Dureza Brinell (HB)</label>
							<input class="form-control is-valid" id="inputValid" type="text" name="HB">							
						</div>
						<div class="form-group">
							<label for="seleccion_parametro">Grado</label>
     						<select class="form-control" id="seleccion_parametro" name="grado">
         					    <option value="1">Grado 1</option>
              				    <option value="2">Grado 2</option>
		                    </select>
  						</div>																	
						<?php						
						break;
					case 'zn':
						?>
						<div class="form-group has-success">
							<label class="form-control-label" for="inputSuccess1">Número de Ciclos de Carga (N)</label>
							<input class="form-control is-valid" id="inputValid" type="text" name="N">														
						</div>						
						<div class="form-group">
          					<label for="seleccion_parametro">Nitrurado</label>
     						<select class="form-control" id="seleccion_parametro" name="nitrurado">
         					   	<option value="0">No nitrurado</option>
								<option value="1">Nitrurado</option>
              				</select>
  						</div>						
						<?php
						break;
					case 'ch'://Factor de relación de durezas de resistencia a picadura
						?>
						<div class="form-group has-success">
							<label class="form-control-label" for="inputSuccess1">Dureza Brinell del piñón (HBP)</label>
							<input class="form-control is-valid" id="inputValid" type="text" name="hbp">							
						</div>
						<div class="form-group has-success">
							<label class="form-control-label" for="inputSuccess1">Dureza Brinell de la corona (HBG)</label>
							<input class="form-control is-valid" id="inputValid" type="text" name="hbg">							
						</div>
												
						<?php						
						break;
					case 'sh': //Factor de seguridad
						?>
						<div class="form-group has-success">
							<label class="form-control-label" for="inputSuccess1">Número de Ciclos de Carga (N)</label>
							<input class="form-control is-valid" id="inputValid" type="text" name="N">							
							
						</div>	
						<div class="form-group has-success">
							<label class="form-control-label" for="inputSuccess1">Dureza Brinell del piñón (HBP)</label>
							<input class="form-control is-valid" id="inputValid" type="text" name="HBp">							
						</div>
						<div class="form-group has-success">
							<label class="form-control-label" for="inputSuccess1">Dureza Brinell de la corona (HBP)</label>
							<input class="form-control is-valid" id="inputValid" type="text" name="HBg">							
						</div>
						<div class="form-group has-success">
							<label class="form-control-label" for="inputSuccess1">Potencia Transmitida (HP)</label>
							<input class="form-control is-valid" id="inputValid" type="text" name="HP">							
						</div>
						<div class="form-group has-success">
							<label class="form-control-label" for="inputSuccess1">Velocidad de Giro (n)</label>
							<input class="form-control is-valid" id="inputValid" type="text" name="n">							
						</div>	
						<div class="form-group has-success">
							<label class="form-control-label" for="inputSuccess1">Número de Calidad (Qv)</label>
							<input class="form-control is-valid" id="inputValid" type="text" name="Qv">							
						</div>
						<div class="form-group has-success">
							<label class="form-control-label" for="inputSuccess1">Ángulo de la Hélice (psi)</label>
							<input class="form-control is-valid" id="inputValid" type="text" name="psi">							
						</div>
						<div class="form-group has-success">
							<label class="form-control-label" for="inputSuccess1">Ancho de Cara (F)</label>
							<input class="form-control is-valid" id="inputValid" type="text" name="F">							
						</div>
						<div class="form-group has-success">
							<label class="form-control-label" for="inputSuccess1">Ángulo de Presión Transversal (phi)</label>
							<input class="form-control is-valid" id="inputValid" type="text" name="phi">							
						</div>
 						<div class="form-group has-success">
							<label class="form-control-label" for="inputSuccess1">Número de Dientes del piñón (Zp)</label>
							<input class="form-control is-valid" id="inputValid" type="text" name="Zp">	
						</div>	
						<div class="form-group has-success">
							<label class="form-control-label" for="inputSuccess1">Número de Dientes de la corona (Zg)</label>
							<input class="form-control is-valid" id="inputValid" type="text" name="Zg">					
						</div>							
						<div class="form-group">
							<label for="seleccion_parametro">Confiabilidad (R)</label>
							<select class="form-control" id="seleccion_parametro" name="R">
								<option value="R=0.9999">Parámetro (R0.9999)</option>
								<option value="R=0.999"> Parámetro (R0.999)</option>
								<option value="R=0.99"> Parámetro (R0.99)</option>
								<option value="R=0.90"> Parámetro (R0.90)</option>
								<option value="R=0.50"> Parámetro (R0.50)</option>
							</select>
						</div>		
						<div class="form-group">
							<label for="seleccion_parametro">Grado</label>
     						<select class="form-control" id="seleccion_parametro" name="grado">
         					    <option value="1">grado (grado1)</option>
              				    <option value="2">grado (grado2)</option>
		                    </select>
  						</div>																	
						<div class="form-group">
          					<label for="seleccion_parametro">Nitrurado</label>
     						<select class="form-control" id="seleccion_parametro" name="nitrurado">
         					   	<option value="0">No nitrurado</option>
								<option value="1">Nitrurado</option>
              				</select>
  						</div>						
						<div class="form-group">
      					    <label for="seleccion_parametro">Carga transmitida</label>
       					    <select class="form-control" id="seleccion_parametro" name="carga_transmitida">
                			    <option value="uniforme">Parámetro (uniforme)</option>
                  		        <option value="impacto_moderado">Parámetro (impacto moderado)</option>
                                <option value="impacto_pesado">Parámetro (impacto pesado)</option>
                       		</select>
                        </div>
						<div class="form-group">
      					    <label for="seleccion_parametro">Transmisión de potencia</label>
       					    <select class="form-control" id="seleccion_parametro" name="transmision">
                			    <option value="uniforme">Parámetro (uniforme)</option>
                  		        <option value="impacto_ligero">Parámetro (impacto ligero)</option>
                                <option value="impacto_medio">Parámetro (impacto medio)</option>
                       		</select>
                        </div>
  						<div class="form-group">
					        <label for="seleccion_parametro">Cmc</label>
					        <select class="form-control" id="seleccion_parametro" name="cmc">
			                    <option value="dientes_coronados">Parámetro (coronados)</option>
								<option value="dientes_sin_coronar">Parámetro (sin coronar)</option>
                    		</select>
					    </div>
					       
					    <div class="form-group">
          					<label for="seleccion_parametro">Cma</label>
     						<select class="form-control" id="seleccion_parametro" name="cma">
         					    <option value="engranajes_abiertos">Parámetro (engranajes abiertos)</option>
              				    <option value="unidades_comerciales_cerradas">Parámetro (unidades comerciales cerradas)</option>
                      		    <option value="unidades_precision_cerradas">Parámetro (unidades de presición cerradas)</option>
							    <option value="unidades_precision_extrema_cerradas">Parámetro (unidades de presición extrema cerradas)</option>
                    		</select>
						</div>
						<div class="form-group">
          					<label for="seleccion_parametro">Cpm</label>
     						<select class="form-control" id="seleccion_parametro" name="cpm">
								<option value="s1/S<0.175">Parámetro (S1/S&lt;0.175)</option>
								<option value="S1/S>=0.175">Parámetro (S1/S>=0.175)</option>
                    		</select>
  						</div>
						<div class="form-group">
          					<label for="seleccion_parametro">Ce</label>
     						<select class="form-control" id="seleccion_parametro" name="ce">
         					    <option value="ajustados_lapeados">ajustados o lapeados (0.8)</option>
              				    <option value="otras_condiciones"> otras condiciones (1)</option>
                    		</select>
  						</div>
					
						<?php						
						break;						
				}
				
				?>  
				  

				<button class="btn btn-primary btn-lg" type="submit">Enviar</button>
			</div>
			
			</form>  
		  
        </div>
      </div>
    </main>
 <?php
   //ISSET	
  }
  
 
 ?>

    <!-- Essential javascripts for application to work-->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="js/plugins/pace.min.js"></script>
    <!-- Page specific javascripts-->
    <script type="text/javascript" src="js/plugins/chart.js"></script>
    <script type="text/javascript">
      var data = {
      	labels: ["January", "February", "March", "April", "May"],
      	datasets: [
      		{
      			label: "My First dataset",
      			fillColor: "rgba(220,220,220,0.2)",
      			strokeColor: "rgba(220,220,220,1)",
      			pointColor: "rgba(220,220,220,1)",
      			pointStrokeColor: "#fff",
      			pointHighlightFill: "#fff",
      			pointHighlightStroke: "rgba(220,220,220,1)",
      			data: [65, 59, 80, 81, 56]
      		},
      		{
      			label: "My Second dataset",
      			fillColor: "rgba(151,187,205,0.2)",
      			strokeColor: "rgba(151,187,205,1)",
      			pointColor: "rgba(151,187,205,1)",
      			pointStrokeColor: "#fff",
      			pointHighlightFill: "#fff",
      			pointHighlightStroke: "rgba(151,187,205,1)",
      			data: [28, 48, 40, 19, 86]
      		}
      	]
      };
      var pdata = [
      	{
      		value: 300,
      		color: "#46BFBD",
      		highlight: "#5AD3D1",
      		label: "Complete"
      	},
      	{
      		value: 50,
      		color:"#F7464A",
      		highlight: "#FF5A5E",
      		label: "In-Progress"
      	}
      ]
      
      var ctxl = $("#lineChartDemo").get(0).getContext("2d");
      var lineChart = new Chart(ctxl).Line(data);
      
      var ctxp = $("#pieChartDemo").get(0).getContext("2d");
      var pieChart = new Chart(ctxp).Pie(pdata);
    </script>
    <!-- Google analytics script-->
    <script type="text/javascript">
      if(document.location.hostname == 'pratikborsadiya.in') {
      	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
      	ga('create', 'UA-72504830-1', 'auto');
      	ga('send', 'pageview');
      }
    </script>
 


 </body>
</html>