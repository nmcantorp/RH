<?php //require_once('../class/conexion2.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" href="">
    <title>Home</title>
    <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  	<link rel="stylesheet" type="text/css" media="screen" href="css/normalize.css">
    <link rel="stylesheet" type="text/css" media="screen" href="css/reset.css">
    <link rel="stylesheet" type="text/css" media="screen" href="css/style.css">
    <link rel="stylesheet" type="text/css" media="screen" href="css/slider.css">
    <link rel="stylesheet" type="text/css" media="screen" href="css/zerogrid.css">
    <link rel="stylesheet" type="text/css" media="screen" href="css/responsive.css">
        <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap-3.3.4/css/bootstrap.css" type="text/css" >
    
    <link rel="stylesheet" href="font/style.css">
    <!-- <link href='http://fonts.googleapis.com/css?family=Lato:300italic' rel='stylesheet' type='text/css'> 
    <script src="js/jquery-2.1.3.js" type="text/javascript" charset="utf-8" ></script>-->
    <script src="js/jquery-1.8.0.min.js" type="text/javascript"></script>
	  <script src="js/funciones_plataforma.js" type="text/javascript" ></script>
    <script > 

      $(document).ready(function() {
        /* Act on the event */
        $('#open_menu').click(function() {
          open_menu();
        });

        $('#menu_principal').mouseleave(function(){
          open_menu();
        });

      });
        

    </script>

</head>
<body>

	<header> 
   		<div class="nav-responsive"><div>MENU</div>
			<select onchange="location=this.value">
				<option></option>
				<option value="index.html">Home</option>
				<option value="about.html">About</option>
				<option value="services.html">Services</option>
				<option value="products.html">Products</option>
				<option value="contacts.html">Contacts</option>
			</select>
		</div>
       <div> 
          <div>
      		<div class="imagen_header">
      		  <h1><a href="index.html"><img src="images/logo.png" alt=""></a></h1> 
      		</div> 
	      		<div class="imagen_header">
	      		  <h1>
	      		  	<div id="img_perfil">
	      		  		
		      		  	<a href="#" id="img_perfil"><img src="images/logo.png" alt=""></a>
						<a href="#">Perfil</a>
					</div>
	      		  </h1> 
	      		</div>                	
              <div class="clear"></div>
              
              
          </div>
      </div>
    </header> 
    <div id="open_menu" class="icon-flickr" title="Selección Modulos"></div>
    <nav style="display:block !important; height: 80px; padding-right: 35px;">  
      <ul class="menu">
            <li class="current"><a href="index.html">Home</a></li>
            <li><a href="about.html">About</a></li>
            <li><a href="services.html">Services</a></li>
            <li><a href="products.html">Products</a></li>
            <li><a href="contacts.html">Contacts</a></li>
        </ul>
    </nav>

    <section id="menu_principal" style="display:none;box-shadow: 0px 0px 10px white;">

    		<ul>
    			<li><a href="" title="">Modulo 1</a></li>
    			<li><a href="" title="">Modulo 2</a></li>
    			<li><a href="" title="">Modulo 3</a></li>
    		</ul>

    </section>

    <!-- Inicion de los contenidos  -->

    
  <div id="content">