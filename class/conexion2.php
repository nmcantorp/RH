<?php
session_start();
/**
* Conexion a la base de datos
*/
class ClassConexion2
{
	public $host 	= 'localhost';
	public $nomBD 	= 'sialen';
	public $user 	= 'root';
	public $pass	= '';
	Public $user_int = '';
	public $pass_int = '';
	Public $base_datos_int = '';
	/*public $nomBD 	= 'sialen5_pagina';
	public $user 	= 'sialen5_PaginaOw';
	public $pass	= 's14l3n2013';*/
	
	public $conexion; public $sentencia;

	public function MySQL(){
		$this->conexion = new mysqli($this->host, $this->user, $this->pass, $this->nomBD);
		if ($mysqli->connect_errno) {
		    echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}
	}	

	public function Mysql_interno(){
		/* connect database test */
		$this->conexion = new mysqli($this->host, $this->user, $this->pass, $_SESSION['tokenb']);

		/* check connection */
		if (!$this->conexion) {
		    printf("Error de conexión: %s\n", mysqli_connect_error());
		    exit();
		}

		/* Set Variable a */
		$this->conexion->query("SET @a:=1");

		if ($result = $this->conexion->query("SELECT DATABASE()")) {
		    $row = $result->fetch_row();
		    printf("Default database: %s\n", $row[0]);
		    $result->close();
		}

		if ($result = $this->conexion->query("SELECT @a")) {
		    $row = $result->fetch_row();
		    if ($row[0] === NULL) {
		        printf("Value of variable a is NULL\n");
		    }
		    $result->close();
		}

		var_dump($this->conexion);
		/* Set Variable a */
		//mysqli_query($this->conexion, "SET @a:=1");

		/* reinciando todo y realizando una nueva conexión a base de datos. */
		//$valor = mysqli_change_user($this->conexion, $_SESSION['tokenu'], $_SESSION['tokenc'], $_SESSION['tokenb']);
		//mysqli_select_db( $this->conexion, $_SESSION['tokenb'] );

		$query = "SELECT * from ciudades" or die("Error in the consult.." . mysqli_error());
		$resultados = $this->conexion->query($query);
		var_dump($resultados);die();

		for ($num_fila = $resultado->num_rows - 1; $num_fila >= 0; $num_fila--) {
		    $resultado->data_seek($num_fila);
		    $fila = $resultado->fetch_assoc();
		    echo " id = " . $fila['id'] . "\n";
		}
		/*while($row = $resultados->fetch_all) { 
		  	echo $row["id_ciudad"] . "<br>"; 
		} */
		echo ($this->conexion->field_count);


		//$this->sentencia->execute();
		//$result = $this->conexion->field_count();
		print_r($result);
		/*$result = mysqli_query($this->conexion , $query);
		echo mysqli_error() ;
*/
		//$result = mysqli_query($this->conexion, "SELECT * from ciudades ");
		/*$row = mysqli_fetch_row($result);die($row);
		mysqli_free_result($result);
		
		if ($result = mysqli_query($this->conexion, "SELECT @a")) {
		    $row = mysqli_fetch_row($result);
		    if ($row[0] === NULL) {
		        printf("Value of variable a is NULL\n");
		    }
		    mysqli_free_result($result);
		}*/
	}

	public function consulta($consulta){
		//die($consulta);
		$this->total_consultas++; 
		$resultado = $this->conexion->query($consulta);
		if(!$resultado){ 
			echo 'MySQL Error: ' . mysql_error();
			exit;
		}

		if($resultado->num_rows>0){
			$resultado->data_seek(0);
			while ($fila = $resultado->fetch_assoc()) {
				$array_result[] = $fila;
		    }
		    
			for ($i=0; $i < count($array_result); $i++) { 
				foreach ($array_result[$i] as $key => $value) {
					if(!is_numeric($key)){
						$valores[$i][$key] = $value;
					}
				}				
			}
		}else{
			return 0;
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