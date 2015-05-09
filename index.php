<?php require_once('comunes/up_pages.php');
      require_once('class/login.php');

      if ($_REQUEST['login'] == 1) {
        $objLogin = new ClassLogin();
        $usuario = $_REQUEST['usuario'];
        $pass = $_REQUEST['pass'];

        $resultado = $objLogin->Validar_usuario($usuario, $pass);

        if ($resultado<>0) {
          $objLogin->pass_int = $resultado[0]['Password'];
          $objLogin->user_int = $resultado[0]['Usuario'];
          $objLogin->base_datos_int = $resultado[0]['Base_datos'];

          header('Location: pages/ciudades.php');
        }

      }
 ?>

    <form role="form" action="?login=1" method="post" accept-charset="utf-8">
      <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="text" class="form-control" id="exampleInputEmail1" name="usuario" placeholder="Enter Usuario" required="required">
      </div>
      <!-- <div class="form-group">
        <label for="exampleInputEmail1">Text</label>
        <input type="text" class="form-control" id="exampleInputText1" placeholder="Enter texto">
      </div> -->
      <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" name="pass" placeholder="Password" required="required">
      </div>
      <!-- <div class="form-group">
        <label for="exampleInputFile">File input</label>
        <input type="file" id="exampleInputFile">
        <p class="help-block">Example block-level help text here.</p>
      </div>
      <div class="checkbox">
        <label>
          <input type="checkbox"> Check me out
        </label>
      </div> -->
      <button type="submit" class="btn btn-default">Submit</button>
    </form>  
      
<?php require_once('comunes/down_pages.php') ?>