<?php 
session_start();
/**
* Clase para la funcionalidad del logueo de los usuarios 
*/
include_once('conexion.php');

class ClassProducto extends ClassConexion
{	
	public $resultado = array();
	
	function __construct()
	{
		# code...
	}
	
	function get_Producto(){
		$db = new ClassConexion();
		$db->MySQL();

		$query = "SELECT
		servicios.id_servicio,
		servicios.tit_serv,
		servicios.det_serv,
		servicios.img_serv,
		servicios.fech_creac,
		servicios.fech_mod,
		servicios.id_status
		FROM
		servicios
		WHERE
		servicios.id_status = 1
		ORDER BY
		servicios.`order`";

		$consulta = $db->consulta($query);
		
		if($db->num_rows($consulta)>0){ $conteo=0;
		  while($resultados = $db->fetch_array($consulta)){ 
		  	$this->resultado[$conteo]['id_servicio']=$resultados['id_servicio'];
		  	$this->resultado[$conteo]['tit_serv']=$resultados['tit_serv'];
		  	$this->resultado[$conteo]['det_serv']=$resultados['det_serv'];
		  	$this->resultado[$conteo]['img_serv']=$resultados['img_serv'];
		  	$this->resultado[$conteo]['fech_creac']=$resultados['fech_creac'];
		  	$this->resultado[$conteo]['fech_mod']=$resultados['fech_mod'];
		  	$this->resultado[$conteo]['id_status']=$resultados['id_status'];
		   	$conteo++;
		 }
		   return $this->resultado;
		}
	}

}
?>