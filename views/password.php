<?php
  require_once("../models/loginModel.php");
  include "header.php";
?>

<main class="main-div"> 

  <div class="container-fluid bg-white rounded px-3 py-3">

<h1>Cambio de contraseña</h1>
<hr>
<div>
<form action="../controllers/loginController.php" method="POST" class="form-horizontal">
      <div class="form-group py-2">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Ingrese la contraseña Actual <b style="color:red;">*</b></label>
        <div class="col-md-8">
          <div class="">
            <input type="password" class="form-control col-md-7 col-xs-12" name="passactual" required >
          </div>
        </div>
        <div class="clearfix"> </div>
      </div>
      <div class="form-group py-2">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Ingrese la nueva contraseña: <b style="color:red;">*</b></label>
        <div class="col-md-8">
          <div class="">
            <input type="password" class="form-control col-md-7 col-xs-12" name="pass1" required >
          </div>
        </div>
        <div class="clearfix"> </div>
      </div>
      <div class="form-group py-2">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Confirme la nueva contraseña: <b style="color:red;">*</b></label>
        <div class="col-md-8">
          <div class="">
            <input type="password" class="form-control col-md-7 col-xs-12" name="pass2" required >
          </div>
        </div>
        <div class="clearfix"> </div>
      </div>
      <input type="hidden" name="correo" value="<?php echo $_SESSION['correo'];?>">
      <input type="submit" class="btn btn-sm btn-primary" name="cambiar_pass" value="cambiar" >
    </form>
</div>
    

</div>
</main>
<?php include('footer.php');?>
