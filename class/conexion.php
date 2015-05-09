<?php

/**
* Conexion a la base de datos
*/
class ClassConexion
{
	public $host 	= 'localhost';
	public $nomBD 	= 'sialen5_rh';
	public $user 	= 'root';
	public $pass	= '';

	/*public $nomBD 	= 'sialen5_pagina';
	public $user 	= 'sialen5_PaginaOw';
	public $pass	= 's14l3n2013';*/
	
	public $conexion; public $total_consultas;

	public function MySQL(){ 
		if(!isset($this->conexion)){
			$this->conexion = (mysql_connect($this->host,$this->user,$this->pass)) or die(mysql_error());
			mysql_select_db($this->nomBD,$this->conexion) or die(mysql_error());
		}
	}

	public function consulta($consulta){
		$this->total_consultas++; 
		$resultado = mysql_query($consulta,$this->conexion);

		if(!$resultado){ 
			echo 'MySQL Error: ' . mysql_error();
			exit;
		}

		if($this->num_rows($resultado)>0){
			while($resultados = $this->fetch_array($resultado)){ 
				$array_result[] = $resultados;
			}

			for ($i=0; $i < count($array_result); $i++) { 
				foreach ($array_result[$i] as $key => $value) {
					if(!is_numeric($key)){
						$valores[$i][$key] = $value;
					}
				}
				
			}
		}else{
			return "Resultados en Blanco";
		}

		return $valores;
	}

	public function columnas($consulta)
	{
		$this->total_consultas++; 
		$resultado = mysql_query($consulta,$this->conexion);

		if(!$resultado){ 
			echo 'MySQL Error: ' . mysql_error();
			exit;
		}

		if (mysql_num_fields($resultado)>0) {
			for ($i=0; $i < mysql_num_fields($resultado); $i++) { 
				$array_columnas[$i]['nombre']=mysql_field_name($resultado, $i);
				$array_columnas[$i]['tipo']=mysql_field_type($resultado, $i);
			}

			return $array_columnas;
		}

	}

	public function fetch_array($consulta){
		return mysql_fetch_array($consulta);
	}

	public function num_rows($consulta){
		return mysql_num_rows($consulta);
	}

	public function getTotalConsultas(){
		return $this->total_consultas; 
	}

	public function insert_id(){
		return mysql_insert_id();
	}

	public function close_con(){
		return mysql_close();
	}
}

?>