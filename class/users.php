<?php 
/**
* Clase para la funcionalidad del logueo de los usuarios 
*/
include_once('conexion3.php');
include_once('conexion.php');

class ClassUser extends ClassConexion3
{	
	public $resultado = array();
	
	function __construct()
	{
		# code...
	}
	
	function get_Users(){
		$db = new ClassConexion();
        $db->MySQL();

		$query = "  SELECT
                    usuario_general.Id_usuario,
                    usuario_general.Usuario,
                    usuario_general.Base_datos,
                    `profiles`.name_profile,
                    `profiles`.desc_profile
                    FROM
                    usuario_general
                    INNER JOIN `profiles` ON `profiles`.id_profile = usuario_general.Perfil
                    WHERE
                    usuario_general.Base_datos = '".$_SESSION['tokenb']."'";

		$consulta = $db->consulta($query);

		return $consulta;

	}

    function get_profiles(){
        $db = new ClassConexion();
        $db->MySQL();
        $query = "  SELECT
                    `profiles`.id_profile,
                    `profiles`.name_profile,
                    `profiles`.desc_profile
                    FROM
                    `profiles`
                    WHERE
                    `profiles`.id_profile <> 3";

        $consulta = $db->consulta($query);

        return $consulta;
    }

    function saveuser($usuario, $email, $profile_id, $pass, $bd){
        $db = new ClassConexion();
        $db->MySQL();
        $query = "INSERT INTO usuario_general
                  (Usuario, Password, Base_datos, Perfil, pass_temporal)
                  VALUES ('$usuario','". sha1($pass) ."', '$bd', '$profile_id',1)";

        $consulta = $db->consulta($query, 'insert');

        $db->close_con();

        switch ($profile_id) {
            case 3:
                $privilegios = 'SELECT, INSERT, UPDATE, DELETE, CREATE, DROP, RELOAD, SHUTDOWN, PROCESS, FILE, REFERENCES, INDEX, ALTER, SHOW DATABASES, SUPER, CREATE TEMPORARY TABLES, LOCK TABLES, EXECUTE, REPLICATION SLAVE, REPLICATION CLIENT, CREATE VIEW, SHOW VIEW, CREATE ROUTINE, ALTER ROUTINE, CREATE USER, EVENT, TRIGGER';
                break;

            case 2:
                $privilegios = 'SELECT, INSERT, UPDATE, DELETE, RELOAD, PROCESS, FILE, REFERENCES, INDEX, SUPER, CREATE TEMPORARY TABLES, EXECUTE, REPLICATION SLAVE, REPLICATION CLIENT, CREATE VIEW, SHOW VIEW, EVENT, TRIGGER';
                break;

            case 1:
                $privilegios = 'SELECT, INSERT, UPDATE, DELETE, RELOAD, PROCESS, FILE, REFERENCES, INDEX, SUPER, CREATE TEMPORARY TABLES, EXECUTE, REPLICATION SLAVE, REPLICATION CLIENT, CREATE VIEW, SHOW VIEW, CREATE USER, EVENT, TRIGGER';
                break;
            
            default:
                 $privilegios = 'ALL';
                break;
        }

        $db->MySQLM($usuario,sha1($pass),$bd,$privilegios);

    }

}
?>