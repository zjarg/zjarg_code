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
        <li><a class="app-menu__item active" href="unparametro.php"><i class="app-menu__icon fa fa-gears"></i><span class="app-menu__label">Parámetro</span></a></li>
		
		
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

      <div class="row">
        <div class="col-md-12">
			<div class="col-lg-4 offset-lg-1">	
			<form action="./calculounparametro.php" method="post">		
				<fieldset class="form-group">
                    <legend>Tipo de Engranaje</legend>
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="form-check-input" id="recto" type="radio" name="tipoengranaje" value="recto" checked="">Engranaje Recto
                      </label>
                    </div>
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="form-check-input" id="recto" type="radio" name="tipoengranaje" value="helicoidal">Engranaje Helicoidal
                      </label>
                    </div>
                  </fieldset>				
				<fieldset class="form-group">
                    <legend>Seleccion Corona o Piñón</legend>
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="form-check-input" id="recto" type="radio" name="coronapinon" value="corona" checked="">Corona
                      </label>
                    </div>
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="form-check-input" id="recto" type="radio" name="coronapinon" value="pinon">Piñón
                      </label>
                    </div>
                  </fieldset>				
				
				
				<div class="form-group">
                    <label for="parametro">Parámetro a calcular</label>
                    <select class="form-control" id="parametro" name="parametro">
                      <option value="wt">Carga Tangencial (Wt)</option>
					  <option value="cp">Coeficiente Elástico (Cp)</option>
					  <option value="yn">Factor de Ciclos de Esfuerzo de Presión(Yn)</option>
					  <option value="cf">Factor de Condición Superficial (Cf)</option>
					  <option value="kr">Factor de Confiabilidad (Kr)</option>
					  <option value="sc">Esfuerzo de Contacto Permisible (Sc)</option>
                      <option value="kv">Factor Dinámico (Kv)</option>
                      <option value="km">Factor de Distribución de Carga (Km)</option>
					  <option value="kb">Factor de Espesor del Aro (Kb)</option>
					  <option value="ch">Factor de Relación de Durezas de Resistencia a Picadura (Ch)</option>
					  <option value="sf">Factor de Seguridad AGMA (Sf)</option>
                      <option value="k0">Factor de Sobrecarga(K0)</option>
                      <option value="ks">Factor de Tamaño (Ks)</option>
					  <option value="kt">Factor de Temperatura (Kt)</option>
					  <option value="zn">Factor de Vida de Ciclos de Esfuerzo (Zn)</option>					  <option value="j">Parámetro J</option>
					  <option value="st">Parámetro St</option>				  
                    </select>
                </div>
				<button class="btn btn-primary btn-lg" type="submit">Enviar</button>
			</div>
			
			</form>  
		  
        </div>
      </div>
    </main>
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