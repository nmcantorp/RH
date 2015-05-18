<?php 
/**
* Clase para la funcionalidad del logueo de los usuarios 
*/
include_once('conexion3.php');

class ClassCiudad extends ClassConexion3
{	
	public $resultado = array();
	
	function __construct()
	{
		# code...
	}
	
	function get_Ciudades(){
		$db = new ClassConexion3();
        $db->mysqli();

		$query = "	SELECT
					ciudades.id_ciudad,
					ciudades.nombre_ciudad,
					ciudades.cod_postal,
					ciudades.usuario_modificador,
					departamentos.nombre_departamento,
					paises.nombre_pais
					FROM
					ciudades
					INNER JOIN departamentos ON departamentos.id_departamento = ciudades.id_departamento
					INNER JOIN paises ON paises.id_pais = departamentos.id_pais
					";

		$consulta = $db->consultas($query);

		return $consulta;

	}

}
?>