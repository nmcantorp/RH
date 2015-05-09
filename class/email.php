<?php 
session_start();
/**
* Clase para la funcionalidad del logueo de los usuarios 
*/
include_once('conexion.php');

class ClassMail extends ClassConexion
{	

	public $resultado = array();

	function enviarEmail($nombre, $email, $mensaje=null, $subject, $template, $email_copy=null, $email_oculto=null){
		if (!class_exists("phpmailer")) {
			require_once('phpmailer/class.phpmailer.php');
		}
		if (!class_exists("SMTP")) {
			require_once('phpmailer/class.smtp.php');
		}
		//include("phpmailer/class.phpmailer.php");
		//include("phpmailer/class.smtp.php"); // note, this is optional - gets called from main class if not already loaded

		$mail             = new PHPMailer();

		$body             = $mail->getFile($template);
		if(!is_null($mensaje))
			$body             = str_replace("%body%","$mensaje",$body);

		$mail->IsSMTP();
		$mail->SMTPAuth   = true;                  // enable SMTP authentication
		//$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
		$mail->Host       = host_mail;      // sets GMAIL as the SMTP server
		$mail->Port       = port_mail;                   // set the SMTP port
		$mail->Mailer   = "smtp";
		$mail->Username   = user_mail;  // GMAIL username
		$mail->Password   = pass_mail;            // GMAIL password

		//$mail->From       = "replyto@yourdomain.com";
		//$mail->FromName   = "Webmaster";
		$mail->Subject    = "$subject";
		$mail->AltBody    = "This is the body when user views in plain text format"; //Text Body
		$mail->WordWrap   = 50; // set word wrap

		$mail->MsgHTML($body);
		if (!is_null($email_copy)) {
			$mail->AddCC("$email_copy","Webmaster");
		}

		if(!is_null($email_oculto)){
			$mail->AddBCC("$email_copy","Webmaster");
		}

		//$mail->AddAttachment("/path/to/file.zip");             // attachment
		//$mail->AddAttachment("/path/to/image.jpg", "new.jpg"); // attachment

		$mail->AddAddress($email, $nombre);

		$mail->IsHTML(true); // send as HTML

		if(!$mail->Send()) {
		  return "Mailer Error: " . $mail->ErrorInfo;
		} else {
			$resultado['nombre_usuario'] = $nombre;
			$resultado['remitente'] = $email;
			$resultado['mensaje'] = $mensaje;
			$resultado['asunto'] = $subject;
			$resultado['template'] = $template;
			$resultado['email_cc'] = $email_copy;
			$resultado['email_bcc'] = $email_oculto;
			
			$this->saveMail($resultado);
		  return true;
		}
	}

	function saveMail($data){

		$db = new ClassConexion();
		$db->MySQL();

		$query = "INSERT INTO email(Remitente_Email,Asunto_Email,Fecha_crea_Email, Fecha_envio_email) 
		VALUES ('".$data['remitente']."','".$data['asunto']."',now(), now())";

		$db->consulta($query);
		$id_email = $db->insert_id();
		
		$query = "INSERT INTO det_email(Det_mensaje, Email_destino, Email_cc, Email_bcc, Email_id_Email) 
		VALUES ('".htmlentities(addslashes($data['mensaje']))."','".$data['email_Destino']."','".$data['email_cc']."','".$data['email_bcc']."','".$id_email."')";

		// para sacar la informacion del html de la bd se emplea html_entity_decode
		$db->consulta($query);
		$id_detal = $db->insert_id();

		return $id_detal;			
	
	}

}
?>