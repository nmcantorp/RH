<?php 
session_start();
/**
* Clase para la funcionalidad del logueo de los usuarios 
*/
include_once('conexion.php');

class ClassCampanias extends ClassConexion
{	
	public $resultado = array();
	
	function __construct()
	{
		# code...
	}
	
	function get_Company(){
		$db = new ClassConexion();
		$db->MySQL();

		$query = "SELECT
		empresas.id_emp,
		empresas.nit_emp,
		empresas.nom_emp,
		empresas.email_emp,
		empresas.date_created,
		empresas.date_modified
		FROM
		empresas
		WHERE
		empresas.status_emp = 1
		ORDER BY
		empresas.nit_emp";

		$consulta = $db->consulta($query);
		
		if($db->num_rows($consulta)>0){ $conteo=0;
		  while($resultados = $db->fetch_array($consulta)){ 
		  	$this->resultado[$conteo]['id_emp']=$resultados['id_emp'];
		  	$this->resultado[$conteo]['nit_emp']=$resultados['nit_emp'];
		  	$this->resultado[$conteo]['nom_emp']=$resultados['nom_emp'];
		  	$this->resultado[$conteo]['email_emp']=$resultados['email_emp'];
		  	$this->resultado[$conteo]['date_created']=$resultados['date_created'];
		  	$this->resultado[$conteo]['date_modified']=$resultados['date_modified'];
		   	$conteo++;
		 }
		   return $this->resultado;
		}
	}

}
?>