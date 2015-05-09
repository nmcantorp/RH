<?php 
session_start();
/**
* Clase para la creacion de ventanas emergentes
*/
include_once('conexion.php');

class ClassModal extends ClassConexion
{	
	public $resultado = array();
	
	function __construct()
	{
		# code...
	}
	
	function get_data($tablas=array()){
		$db = new ClassConexion();
		$db->MySQL();
		for ($i=0; $i < count($tablas); $i++) { 
			$query = "	SELECT
						*
						FROM
						$tablas[$i]
						";

			$consulta[] = $db->columnas($query);
		}

		return $consulta;

	}

	function crear_modal($tablas=array(), $ignorar=array())
	{
		$resultado_columnas = $this->get_data($tablas);

		for ($i=0; $i < count($resultado_columnas); $i++) { 
			foreach ($resultado_columnas[$i] as $key => $value) {
				echo $value['nombre']. '-'. $value['tipo']."<br>";
			}
			
		}
	}

}
?>