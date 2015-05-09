<?php session_start();

if($_SESSION['tokenc']){
	echo $_SESSION['tokenc'];
} 

/*for ($i=0; $i < 5; $i++) { 
	echo $i.',';
	for ($j=0; $j < 5-$i; $j++) { 
		echo $j.',';
	}
}*/
echo "<br>";

echo '<a href="#reviews">...</a>';
/*(!isset($_SESSION['contador']))?$_SESSION['contador']=1 : $_SESSION['contador']++;

echo "<div>".$_SESSION['contador']."</div>";*/
/*function test3($val) {
if($val == 1) { 
return 0;
}
if($val == 2 || $val == 3) { echo($val)."-<br>";
return 1;
} echo $val."<br>";
return test3($val-1) + test3($val-2);
}

$val = test3(6);
echo "Val: " . $val;*/
/*function fibonacci($x1, $x2) {
   return $x1 + $x2;
}
$x1 = 0;
$x2 = 1;
for($i = 0; $i < 10; $i++) {
   echo fibonacci($x1, $x2) . ',';
}
*/
/*function odd($x) {
   if ($x % 2 == 0) echo "$x, ";
}

$v = array(1,25,12,2,45,4,8);
array_walk($v, "odd");

*/
/*for($i = 0 ; $i < 5 ; $i++) {
    echo $i . ',';
    for($j = 0; $j < (5 – $i); $j++) {
        echo $j . ',';
    }
    
}*/

require_once('../comunes/up_pages_inter.php');
require_once('../class/ciudad.php');
require_once('../class/modal.php');
/*Clases*/
$obj_ciudad  = new ClassCiudad();
//$objModal 	 = new ClassModal();

/*Metodos*/
$resultado_ciudad = $obj_ciudad->get_Ciudades(); die();
print_r($objModal->crear_modal(array('ciudades')));

/*Paginacion*/
$objPaginator = new ClassPaginator();
if(!isset($_REQUEST['pg'])) $_REQUEST['pg']=1;
$pagina_actual = $_REQUEST['pg'];

$resultado_ciudad = $objPaginator->create_paginator($resultado_ciudad, $_REQUEST['pg']);
/*Fin Paginacion*/
?>
<script src="../css/bootstrap-3.3.4/js/bootstrap.js" type="text/javascript" >
	$('.dropdown-toggle').dropdown();
</script>
<div class="table">
  <table class="table table-bordered table-hover">
  	<thead>
	    <tr>
	    	<th>Nombre Ciudad</th>
	    	<th>Departamento</th>
	    	<th>Pais</th>
	    	<th width='19%'>Acciones</th>
	    </tr>
    </thead>
    <tbody>
    <?php if(count($resultado_ciudad)>0):
    for($i=0; $i<count($resultado_ciudad) ; $i++): ?>
		<tr>
			<td><?php echo $resultado_ciudad[$i]['nombre_ciudad'] ?></td>
			<td><?php echo $resultado_ciudad[$i]['nombre_departamento'] ?></td>
			<td><?php echo $resultado_ciudad[$i]['nombre_pais'] ?></td>
			<td><div class="dropdown">
				  <button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				    Seleccione una opci&oacute;n
				    <span class="caret"></span>
				  </button>
				  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
				    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Actualizar</a></li>
				    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Borrar</a></li>
				  </ul>
				</div>
			</td>
		</tr>
	<?php 
	endfor;
	endif; ?>
	</tbody>
  </table>
</div>



<?php 
require_once('../comunes/down_pages_inter.php');
 ?>