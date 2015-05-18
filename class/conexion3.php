<?php
/**
 * User: Mauricio
 * Date: 18/05/2015
 * Time: 16:08
 */
class classConexion3
{
    public $host = 'localhost';
    public $nomBD = 'sialen5_rh';
    public $user = 'root';
    public $pass = '';

    /*public $nomBD 	= 'sialen5_pagina';
    public $user 	= 'sialen5_PaginaOw';
    public $pass	= 's14l3n2013';*/

    public $conexion;
    public $total_consultas;

    public function mysqli()
    {
        if (isset($_SESSION['tokenu']) && isset($_SESSION['tokenc']) && isset($_SESSION['tokenb']) && isset($_SESSION['tokenp'])) {
            $this->conexion = mysqli_connect($this->host, $_SESSION['tokenu'], $_SESSION['tokenc'], $_SESSION['tokenb']) or
            die("Problemas con la conexión a la base de datos");
        }

    }

    public function mysqli_interno()
    {

    }

    public function consultas($query)
    {

        $registros = mysqli_query($this->conexion,$query,MYSQLI_ASSOC) or
        die(mysqli_error($this->conexion));
        $count = 0;
        while ($reg=mysqli_fetch_array($registros))
        {
            $count++;
            $array_result[] = $reg;
        }
        if($count>0){
            for ($i=0; $i < count($array_result); $i++) {
                foreach ($array_result[$i] as $key => $value) {
                    if(!is_numeric($key)){
                        $valores[$i][$key] = $value;
                    }
                }
            }
            return $valores;
        }else{
            return false;
        }
        mysqli_close($this->conexion);
    }

}