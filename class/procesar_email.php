<?php session_start();
require_once('../class/recaptcha/recaptchalib.php'); 
require_once('../class/parametes.php');
require_once('email.php');

$objParameters = new ClassParameters();
$obj_mail = new ClassMail();
$objParameters->get_Parameters();
print_r($_REQUEST);die();
if($_REQUEST['ac']=='campania' || isset($argv[1])){

require_once('../class/Campanias.php');

$objcampanias = new ClassCampanias();

$empCampanias = $objcampanias->get_Company();

$total = 0;
//echo $_SERVER['HTTP_HOST'];die();
$val = 50;
for($i=0;$i < count($empCampanias) ; $i++){

	if($i == $val){
		$val += 50;
		sleep(15);
	}
	sleep(2);
	$result_email = $obj_mail->enviarEmail($empCampanias[$i]['nom_emp'], $empCampanias[$i]['email_emp'], null, 'Ingresa al Mundo Digital', '../comunes/templates/Free_Email_Template_in_Green_Color/email.html');
	if($result_email){
		$total++;
	}
	
}


header("Location: http://localhost/sialen/admin/campanas.php?resultado=$total");
exit;

}




$captcha_publickey = captcha_publickey;
$captcha_privatekey = captcha_privatekey;
$error_captcha=null;
$captcha_respuesta = recaptcha_check_answer ($captcha_privatekey,$_SERVER["REMOTE_ADDR"],$_POST["recaptcha_challenge_field"],$_POST["recaptcha_response_field"]);

if ($captcha_respuesta->is_valid == 1) {
   //todo correcto
//hacemos lo que se deba hacer una vez recibido el formulario válido

if ($_REQUEST['ac']=='contact') {

	$html_mensaje = "<style type='text/css'>

	body{
		background:#F7F6F6;
	}

 .CSSTableGenerator {
 	text-align:center;
	margin:auto;padding:0px;
	width:600px;
	box-shadow: 10px 10px 5px #888888;
	border:1px solid #000000;
	
	-moz-border-radius-bottomleft:0px;
	-webkit-border-bottom-left-radius:0px;
	border-bottom-left-radius:0px;
	
	-moz-border-radius-bottomright:0px;
	-webkit-border-bottom-right-radius:0px;
	border-bottom-right-radius:0px;
	
	-moz-border-radius-topright:0px;
	-webkit-border-top-right-radius:0px;
	border-top-right-radius:0px;
	
	-moz-border-radius-topleft:0px;
	-webkit-border-top-left-radius:0px;
	border-top-left-radius:0px;
}.CSSTableGenerator table{
    border-collapse: collapse;
        border-spacing: 0;
	width:100%;
	height:100%;
	margin:auto;padding:0px;
}.CSSTableGenerator tr:last-child td:last-child {
	-moz-border-radius-bottomright:0px;
	-webkit-border-bottom-right-radius:0px;
	border-bottom-right-radius:0px;
}
.CSSTableGenerator table tr:first-child td:first-child {
	-moz-border-radius-topleft:0px;
	-webkit-border-top-left-radius:0px;
	border-top-left-radius:0px;
}
.CSSTableGenerator table tr:first-child td:last-child {
	-moz-border-radius-topright:0px;
	-webkit-border-top-right-radius:0px;
	border-top-right-radius:0px;
}.CSSTableGenerator tr:last-child td:first-child{
	-moz-border-radius-bottomleft:0px;
	-webkit-border-bottom-left-radius:0px;
	border-bottom-left-radius:0px;
}.CSSTableGenerator tr:hover td{
	
}
.CSSTableGenerator tr:nth-child(odd){ background-color:#aad4ff; }
.CSSTableGenerator tr:nth-child(even)    { background-color:#ffffff; }.CSSTableGenerator td{
	vertical-align:middle;
	
	
	border:1px solid #000000;
	border-width:0px 1px 1px 0px;
	text-align:left;
	padding:7px;
	font-size:13px;
	font-family:Times New Roman;
	font-weight:normal;
	color:#000000;
}.CSSTableGenerator tr:last-child td{
	border-width:0px 1px 0px 0px;
}.CSSTableGenerator tr td:last-child{
	border-width:0px 0px 1px 0px;
}.CSSTableGenerator tr:last-child td:last-child{
	border-width:0px 0px 0px 0px;
}
.CSSTableGenerator tr:first-child td{
		background:-o-linear-gradient(bottom, #005fbf 5%, #003f7f 100%);	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #005fbf), color-stop(1, #003f7f) );
	background:-moz-linear-gradient( center top, #005fbf 5%, #003f7f 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#005fbf', endColorstr='#003f7f');	background: -o-linear-gradient(top,#005fbf,003f7f);

	background-color:#005fbf;
	border:0px solid #000000;
	text-align:center;
	border-width:0px 0px 1px 1px;
	font-size:18px;
	font-family:Times New Roman;
	font-weight:bold;
	color:#ffffff;
}
.CSSTableGenerator tr:first-child:hover td{
	background:-o-linear-gradient(bottom, #005fbf 5%, #003f7f 100%);	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #005fbf), color-stop(1, #003f7f) );
	background:-moz-linear-gradient( center top, #005fbf 5%, #003f7f 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#005fbf', endColorstr='#003f7f');	background: -o-linear-gradient(top,#005fbf,003f7f);

	background-color:#005fbf;
}
.CSSTableGenerator tr:first-child td:first-child{
	border-width:0px 0px 1px 0px;
}
.CSSTableGenerator tr:first-child td:last-child{
	border-width:0px 0px 1px 1px;
}
</style>

	<h1>
			El detalle de su mensaje es el siguientes:</h1>
			<div class='CSSTableGenerator' >
		<table border='0' cellpadding='1' cellspacing='1' style='width: 600px;''>
				<tr>
					<td width='35%'>
						Nombre Usuario</td>
					<td width='20%'>
						Email</td>
					<td width='40%'>
						Detalle del Mensaje</td>
				</tr>
				<tr>
					<td>";
	$html_mensaje .= $_REQUEST['name'];
	$html_mensaje .= "</td>
					<td>";
	$html_mensaje .= $_REQUEST['email'] ;
	$html_mensaje .= "</td>
					<td>";
	$html_mensaje .= $_REQUEST['message'] ;

	$html_mensaje .= "</td>
				</tr>				
			</table>
		</div>
		<hr />
		<p>
			En contados instantes lo contactaremos...!</p>
		<p>
			Visitenos en <a href='www.sialen.com'>www.Sialen.com</a></p>";

	$result_email = $obj_mail->enviarEmail($_REQUEST['name'], $_REQUEST['email'], $html_mensaje, 'Mensaje Recibido Satisfactoriamente', '../comunes/templates/template_email.html' , email_info);

	if ($result_email==true) {
		echo 'Mensaje enviado correctamente, en breve lo estaremos contactando';
		$_SESSION['name_contact'] = '';
	   	$_SESSION['email_contact'] = '';
	   	$_SESSION['message_contact'] = '';
	   	$_SESSION['error_captcha_contact'] = '';

		unset($_SESSION['name_contact']);
	   	unset($_SESSION['email_contact']);
	   	unset($_SESSION['message_contact']);
	   	unset($_SESSION['error_captcha_contact']);

	}else{
		echo $result_email;
	}

}

}else{
   //El código de validación de la imagen está mal escrito.
   $_SESSION['name_contact'] = $_REQUEST['name'];
   $_SESSION['email_contact'] = $_REQUEST['email'];
   $_SESSION['message_contact'] = $_REQUEST['message'];
   $_SESSION['error_captcha_contact'] = $captcha_respuesta->error;
   $error_captcha = $captcha_respuesta->error;
   echo "<script type='text/javascript'> location.reload(true); </script>";
}


?>
