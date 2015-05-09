<?php 
session_start();
/**
* Clase para la funcionalidad del logueo de los usuarios 
*/
include_once('conexion.php');

class ClassFacebook extends ClassConexion
{	
	public $resultado = array();
	
	function __construct()
	{
		# code...
	}
	
	function valida_user($id){
		$db = new ClassConexion();
		$db->MySQL();

		$query = "SELECT
			usuario.user_id,
			usuario.facebook_id,
			usuario.username,
			usuario.email,
			usuario.genero
			FROM
			usuario
			WHERE
			usuario.facebook_id = ".$id;

		$consulta = $db->consulta($query);
		
		if($db->num_rows($consulta)>0){ $conteo=0;
		  while($resultados = $db->fetch_array($consulta)){ 
		  	$this->resultado[$conteo]['user_id']=$resultados['user_id'];
		  	$this->resultado[$conteo]['facebook_id']=$resultados['facebook_id'];
		  	$this->resultado[$conteo]['username']=$resultados['username'];
		  	$this->resultado[$conteo]['email']=$resultados['email'];
		  	$this->resultado[$conteo]['genero']=$resultados['genero'];
		   	$conteo++;
		 }
		   return $this->resultado;
		}
	}

	function saveUser($data){

		$db = new ClassConexion();
		$db->MySQL();

		$query = "INSERT INTO usuario(facebook_id,username,email,genero) 
		VALUES ('".$data['facebook_id']."','".$data['username']."','".$data['email']."','".$data['genero']."')";

		$db->consulta($query);
		$id_usu = $db->insert_id();
		

		return $id_usu;			
	
	}

}
?>