<?php 
session_start();
include 'funciones.php';

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

  if (($_SESSION['tipoengranaje']!='recto') && ($_SESSION['tipoengranaje']!='helicoidal'))
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
            <div class="tile-body"><?php echo("Tipo de Engranaje: ". $_SESSION['tipoengranaje']); ?></div>
			<div class="tile-body"><?php echo("Corona/Piñón: ". $_SESSION['coronapinon']); ?></div>
			<div class="tile-body"><?php echo("Parámetro a Calcular: ". $_SESSION['parametro']); ?></div>
          </div>
        </div>
					
		<?php
		
		//calculo para cada parámetro
			switch($_SESSION['parametro']) {
				case "wt":
		?>
			<div class="col-md-6">
			  <div class="tile">
				<h3 class="tile-title">Resultado del cálculo del parámetro wt</h3>
				<div class="tile-body"><?php echo(calcular_wt($_POST['HP'],$_POST['n'],$_POST['dt']));?> lbs</div>
			  </div>
			</div>	
	    <?php
				break;
				case "k0":
		?>
			<div class="col-md-6">
			  <div class="tile">
				<h3 class="tile-title">Resultado del cálculo del parámetro k0</h3>
				<div class="tile-body"><?php echo(calcular_k0($_POST['transmision'],$_POST['carga_transmitida']));?></div>
			  </div>
			</div>		
	    <?php
				break;
				case "kv":
		?>
			<div class="col-md-6">
			  <div class="tile">
				<h3 class="tile-title">Resultado del cálculo del parámetro kv</h3>
				<div class="tile-body"><?php echo(calcular_kv($_POST['Qv'],$_POST['n'],$_POST['dt']));?></div>
			  </div>
			</div>	
	    <?php
				break;
				case "ks":
		?>
			<div class="col-md-6">
			  <div class="tile">
				<h3 class="tile-title">Resultado del cálculo del parámetro ks</h3>
				<div class="tile-body">
				<?php 
					if(isset($_POST['psi']))
						echo(calcular_ks($_POST['F'],$_POST['Z'],$_POST['Pt'],$_POST['psi']));
					else
						echo(calcular_ks($_POST['F'],$_POST['Z'],$_POST['Pt'],-1));
				?>			
				</div>
			  </div>
			</div>
	    <?php
				break;
				case "km":
		?>
			<div class="col-md-6">
			  <div class="tile">
				<h3 class="tile-title">Resultado del cálculo del parámetro km</h3>
				<div class="tile-body"><?php echo(calcular_km($_POST['cmc'],$_POST['F'],$_POST['cma'],$_POST['cpm'],$_POST['dt'],$_POST['ce']));?></div>
			  </div>
			</div>
	    <?php
				break;
				case "kb":
		?>
			<div class="col-md-6">
			  <div class="tile">
				<h3 class="tile-title">Resultado del cálculo del parámetro kb</h3>
				<div class="tile-body"><?php echo(calcular_kb($_POST['tr'],$_POST['ht']));?></div>
			  </div>
			</div>			
	    <?php
				break;
				case "st":
		?>
			<div class="col-md-6">
			  <div class="tile">
				<h3 class="tile-title">Resultado del cálculo del parámetro st</h3>
				<div class="tile-body"><?php echo(calcular_st($_POST['HB'],$_POST['material'],$_POST['grado']));?> psi</div>
			  </div>
			</div>				
	    <?php
				break;
				case "yn":
		?>
			<div class="col-md-6">
			  <div class="tile">
				<h3 class="tile-title">Resultado del cálculo del parámetro yn</h3>
				<div class="tile-body"><?php echo(calcular_yn($_POST['HB'],$_POST['N']));?> </div>
			  </div>
			</div>			
	    <?php
				break;
				case "kt":
		?>
			<div class="col-md-6">
			  <div class="tile">
				<h3 class="tile-title">Resultado del cálculo del parámetro kt</h3>
				<div class="tile-body"><?php echo(1);?></div>
			  </div>
			</div>		
	    <?php
				break;
				case "kr":
		?>
			<div class="col-md-6">
			  <div class="tile">
				<h3 class="tile-title">Resultado del cálculo del parámetro kr</h3>
				<div class="tile-body"><?php echo(calcular_kr($_POST['R']));?></div>
			  </div>
			</div>			
	    <?php
				break;
				case "cp":
		?>
			<div class="col-md-6">
			  <div class="tile">
				<h3 class="tile-title">Resultado del cálculo del parámetro cp</h3>
				<div class="tile-body">
				<?php 
				   $resultado=calcular_cp($_SESSION['coronapinon'],$_POST['material']);
				   echo($resultado["psi"]. " psi<br>");
				   echo($resultado["mpa"]. " Mpa");
				?></div>
			  </div>
			</div>		
	    <?php
				break;
				case "cf":
		?>
			<div class="col-md-6">
			  <div class="tile">
				<h3 class="tile-title">Resultado del cálculo del parámetro Cf</h3>
				<div class="tile-body"><?php echo(1);?></div>
			  </div>
			</div>					
	    <?php
				break;
				case "yn":
		?>
			<div class="col-md-6">
			  <div class="tile">
				<h3 class="tile-title">Resultado del cálculo del parámetro Yn</h3>
				<div class="tile-body"><?php echo(calcular_yn($_POST['HB'],$_POST['N']));?></div>
			  </div>
			</div>		
	    <?php
				break;
				case "sc":
		?>
			<div class="col-md-6">
			  <div class="tile">
				<h3 class="tile-title">Resultado del cálculo del parámetro Sc</h3>
				<div class="tile-body"><?php echo(calcular_sc($_POST['HB'],$_POST['grado']));?> psi</div>
			  </div>
			</div>			
	    <?php
				break;
				case "zn":
		?>
			<div class="col-md-6">
			  <div class="tile">
				<h3 class="tile-title">Resultado del cálculo del parámetro Zn</h3>
				<div class="tile-body"><?php echo(calcular_zn($_POST['N'],$_POST['nitrurado']));?></div>
			  </div>
			</div>			
	    <?php
				break;
				case "ch":
		?>
			<div class="col-md-6">
			  <div class="tile">
				<h3 class="tile-title">Resultado del cálculo del parámetro Ch</h3>
				<div class="tile-body"><?php echo(calcular_ch($_POST['hbp'],$_POST['hbg'],$_SESSION['coronapinon']));?></div>
			  </div>
			</div>
	    <?php
				break;
				case "j":
		?>
			<div class="col-md-6">
			  <div class="tile">
				<h3 class="tile-title">Resultado del cálculo del parámetro J</h3>
				<div class="tile-body">
				<?php 
					if($_SESSION["tipoengranaje"]=="recto" && $_SESSION["coronapinon"]=="corona")
					{
						echo (calcular_jrecto($_POST['zg'],$_POST['zp']));
					}
					elseif($_SESSION["tipoengranaje"]=="recto" && $_SESSION["coronapinon"]!="corona")
					{
						echo (calcular_jrecto($_POST['zp'],$_POST['zg']));
					}
					elseif($_SESSION["tipoengranaje"]=="helicoidal" && $_SESSION["coronapinon"]=="corona")
					{
						echo (calcular_jhelicoidal($_POST['zg'],$_POST['psi']));
					}			
					elseif($_SESSION["tipoengranaje"]=="helicoidal" && $_SESSION["coronapinon"]!="corona")
					{
						echo (calcular_jhelicoidal($_POST['zp'],$_POST['psi']));
					}				
				
				?>
				</div>
			  </div>
			</div>
	    <?php
				break;
				case "sf":
		?>
			<div class="col-md-6">
			  <div class="tile">
				<h3 class="tile-title">Resultado del cálculo del parámetro Sf</h3>
				<div class="tile-body">
				<?php 
					$J=0;
					if($_SESSION["tipoengranaje"]=="recto" && $_SESSION["coronapinon"]=="corona")
					{
						$J=calcular_jrecto($_POST['Zg'],$_POST['Z']);
					}
					elseif($_SESSION["tipoengranaje"]=="recto" && $_SESSION["coronapinon"]!="corona")
					{
						$J=calcular_jrecto($_POST['Z'],$_POST['Zg']);
					}
					elseif($_SESSION["tipoengranaje"]=="helicoidal" && $_SESSION["coronapinon"]=="corona")
					{
						$J=calcular_jhelicoidal($_POST['Zg'],$_POST['psi']);
					}			
					elseif($_SESSION["tipoengranaje"]=="helicoidal" && $_SESSION["coronapinon"]!="corona")
					{
						$J=calcular_jhelicoidal($_POST['Z'],$_POST['psi']);
					}				
		
		            echo (calcular_sf($_POST['HB'], $_POST['material'], $_POST['grado'], $_POST['N'], $_POST['F'], $J, $_POST['Z'], $_POST['n'], $_POST['ht'], $_POST['R'], $_POST['carga_transmitida'], $_POST['transmision'], $_POST['Qv'], $_POST['dt'],$_POST['Pt'],$_POST['cmc'],$_POST['cpf'],$_POST['cpm'], $_POST['cma'], $_POST['Ce'], $_POST['tr'],$_POST['psi'],));
				
				?>
				</div>
			  </div>
			</div>

			
		<?php
			}
		?>
	  
	  
	  </div>
    </div>
	<input type="button" onclick="location.href='./unparametro.php';" value="Volver"/>
	
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