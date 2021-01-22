<body>
<script src="http://179.50.12.201/transpubenza/recaudo/Sir/assets/jquery-3.2.1.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <div class="container" style="width: 45%;">

      <form role="form" class="form-signin" method="POST" action="<?php echo base_url();?>Login/login_user">
      <center><h2 class="form-signin-heading">Iniciar Sesion</h2></center><br>
        <div class="form-group">
            <label for="userRec"><span class="glyphicon glyphicon-user"></span> Usuario</label>
            <input type="text" class="form-control" id="user" name="user" placeholder="Usuario" required autofocus onkeyup="" />
        </div>
        <div class="form-group">
            <label for="con"><span class="glyphicon glyphicon-eye-open"></span> Contraseña</label>
            <input type="password" class="form-control" id="con" name="con" placeholder="Contraseña"/>
        </div>
        <button type="submit" class="btn btn-lg btn-primary btn-block">Ingresar</button>
    </form>
    <br>
    <?  
        if($error=="no-exist"){
            $html='';
            $html.='<div class="alert alert-danger">';
            $html.='<strong>Error! </strong>Nombre de Usuario incorrecto';
            $html.='</div>';
            echo $html;
        }
        if($error=="no-user"){
            $html='';
            $html.='<div class="alert alert-danger">';
            $html.='<strong>Error! </strong>Nombre de Usuario incorrecto';
            $html.='</div>';
            echo $html;
        }
        if($error=="no-pass"){
            $html='';
            $html.='<div class="alert alert-danger">';
            $html.='<strong>Error! </strong>Contraseña incorrecta';
            $html.='</div>';
            echo $html;
        }
        if($error=="no-sesion"){
            $html='';
            $html.='<div class="alert alert-danger">';
            $html.='<strong>Error! </strong>Sesion expirada';
            $html.='</div>';
            echo $html;
        }

    ?>
    <center><a href="http://179.50.12.201/transpubenza">Volver a SIIGOTT</a></center>
    </div> <!-- /container -->
</body>
</html>