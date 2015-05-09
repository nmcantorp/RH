<?php 
session_start();
/**
* Clase para la funcionalidad del logueo de los usuarios 
*/
include_once('conexion2.php');

class ClassLogin extends ClassConexion2
{	
	public $resultado = array();
	
	function __construct()
	{
		# code...
	}
	
	function Validar_usuario($usuario, $pass){
		$db = new ClassConexion2();
		$db->MySQL();

		$query = "	SELECT
					*
					FROM
					usuario_general
					WHERE
					usuario_general.Usuario = '$usuario' AND
					usuario_general.`Password` = '".sha1($pass)."'
					";

		$consulta = $db->consulta($query);

		for ($i=0; $i < count($consulta); $i++) { 
			$_SESSION['tokenu'] = $consulta[$i]['Usuario'];
			$_SESSION['tokenc'] = $consulta[$i]['Password'];
			$_SESSION['tokenb'] = $consulta[$i]['Base_datos'];
			$_SESSION['tokenp'] = $consulta[$i]['Perfil'];
		}

		//echo User; die();
		return $consulta;

	}

}
?>