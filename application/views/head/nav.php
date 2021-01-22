<meta charset="utf-8">

<script src="<?php echo base_url();?>assets/jquery-1.10.2.min.js"></script>
<script src="<?php echo base_url();?>assets/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>assets/dataTables.bootstrap.js"></script>

<script src="<?php echo base_url();?>css/3_0bootstrap.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>css/3_0bootstrap.min.css">
<script src="<?php echo base_url();?>css/bootstrap-3.3.7/dist/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap-3.3.7/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>css/font-awesome.css">

<script src="<?php echo base_url();?>assets/jquery-confirm-master/js/jquery-confirm.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>assets/jquery-confirm-master/css/jquery-confirm.css">

<script src="<?php echo base_url();?>assets/dataTables_buttons/buttons.html5.min.js"></script>
<script src="<?php echo base_url();?>assets/dataTables_buttons/buttons.print.min.js"></script>
<script src="<?php echo base_url();?>assets/dataTables_buttons/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url();?>assets/dataTables_buttons/jszip.min.js"></script>

<link href='https://fonts.googleapis.com/css?family=Orbitron' rel='stylesheet' type='text/css'>

<nav class="navbar" id="navbar">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#" id="siigott">SIIGOTT Despacho</a>
    </div>
    <ul class="nav navbar-nav">

      <li><a href="#"><span class=""></span> Despacho</a></li>

    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li class="dropdown" id="subM"><a class="dropdown-toggle" data-toggle="dropdown" id="btnNotify"><span class="glyphicon glyphicon-bell" id="bell"></span><span id="idNotify"></span> </a>
        <ul class="dropdown-menu list-group" id="menuNotify"></ul>
      </li>
      <li><a href="#"><span class="glyphicon glyphicon-user"></span> <? echo $nombre; ?></a></li>
      <li><a href="http://179.50.12.201/transpubenza/despacho" onclick="cerrarSesion();"><span class="glyphicon glyphicon-log-in"></span> Salir</a></li>
    </ul>
  </div>
</nav>
<script type="text/javascript">
  
  var time_server=<? echo json_encode($time_server); ?>;
  var fecha_server=<? echo json_encode($fecha); ?>;
  var localTime = +Date.now();
  var timeDiff = time_server - localTime;
  var date_clock;

  function clock(){
    setInterval(function () {
        var realtime = +Date.now() + timeDiff;
        var date = new Date(realtime);
        date_clock = date;
        var hours = date.getHours();
        var minutes = date.getMinutes();
        var seconds = date.getSeconds();

        if(hours < 10){
          hours="0"+hours;
        }
        if(minutes < 10){
          minutes="0"+minutes;
        }
        if(seconds < 10){
          seconds="0"+seconds;
        }
        var formattedTime = hours + ':' + minutes + ':' + seconds;
        $(".hora").text(formattedTime);
    }, 1000);
  }

  $(function() {

    $(".fecha").text(fecha_server);
    clock();

  });

  function getHora(){
    $.post("../Despacho/getHora",
    function (data) {
      $(".hora").text(data);
    }, "json");
  }


  function cerrarSesion(){onclick="cerrarSesion();"

    $.post("../Login/cerrar",
    {
    },
    function (data) {
    }, "json");

  }

  function setRol(){
    var idcon=<? echo $consecutivo; ?>;
    if(idcon != 12){

        //$( "#operacion" ).hide();
        $( "#depart" ).hide();

        var inci="";
        inci+='<a class="dropdown-toggle" data-toggle="dropdown" href="#">Incidentes<span class="caret"></span></a>';
        inci+='<ul class="dropdown-menu" id="submenu">';
        inci+='<li><a href="../index.php/ReporteIncidentes">Ver Incidentes</a></li>';
        //inci+='<li><a href="../index.php/RespuestaIncidentes">Respuesta Incidentes</a></li>';
        inci+='</ul>';
        $( "#incidentes" ).html(inci);
      
      if(idcon==11){///auxiliar, solo ve los incidentes
        //$( "#operacion" ).hide();
          $( "#depart" ).show();
          var html="";
  	      html+='<a class="dropdown-toggle" data-toggle="dropdown" href="#">Operación<span class="caret"></span></a>';
  	      html+='<ul class="dropdown-menu" id="submenu">';
  	      html+='<li id="segui_op"><a href="../index.php/PuntosControl">Operación Diaria</a></li>';
  	      html+='<li id="puntosctrl"><a href="../index.php/PuntosCapturados">Puntos Capturados</a></li>';
  	      html+='<li id="despacho"><a href="../index.php/ActividadDespacho">Despachadores</a></li>';
          html+='<li id="despacho"><a href="../index.php/ProgramacionSemanal">Programación Vehículos</a></li>';
          html+='<li id="despacho"><a href="../index.php/Resumen_pso">Resumen PSO</a></li>';
          html+='<li id="despacho"><a href="../index.php/Informe_dia">Informe Diario</a></li>';
  	      html+='</ul>';
  	      $( "#operacion" ).html(html);

          var inci="";
          inci+='<a class="dropdown-toggle" data-toggle="dropdown" href="#">Incidentes<span class="caret"></span></a>';
          inci+='<ul class="dropdown-menu" id="submenu">';
          inci+='<li><a href="../index.php/ReporteIncidentes">Ver Incidentes</a></li>';
          inci+='<li><a href="../index.php/RespuestaIncidentes">Respuesta Incidentes</a></li>';
          inci+='</ul>';
          $( "#incidentes" ).html(inci);
        
      }

      if(idcon==5){ ///jefe operaciones
        $( "#depart" ).show();
        var html="";
	      html+='<a class="dropdown-toggle" data-toggle="dropdown" href="#">Operación<span class="caret"></span></a>';
	      html+='<ul class="dropdown-menu" id="submenu">';
	      html+='<li id="pass_insert"><a href="../index.php/PassIngreso">Clave Ingreso</a></li>';
	      html+='<li id="segui_op"><a href="../index.php/PuntosControl">Operación Diaria</a></li>';
	      html+='<li id="puntosctrl"><a href="../index.php/PuntosCapturados">Puntos Capturados</a></li>';
	      html+='<li id="despacho"><a href="../index.php/ActividadDespacho">Despachadores</a></li>';
        html+='<li id="despacho"><a href="../index.php/ProgramacionSemanal">Programación Vehículos</a></li>';
        html+='<li id="despacho"><a href="../index.php/Resumen_pso">Resumen PSO</a></li>';
        html+='<li id="despacho"><a href="../index.php/Informe_dia">Informe Diario</a></li>';
	      html+='</ul>';
	      $( "#operacion" ).html(html);
        
        var inci="";
        inci+='<a class="dropdown-toggle" data-toggle="dropdown" href="#">Incidentes<span class="caret"></span></a>';
        inci+='<ul class="dropdown-menu" id="submenu">';
        inci+='<li><a href="../index.php/ReporteIncidentes">Ver Incidentes</a></li>';
        inci+='<li><a href="../index.php/RespuestaIncidentes">Respuesta Incidentes</a></li>';
        inci+='</ul>';
        $( "#incidentes" ).html(inci);

         var prog="";
	      prog+='<a class="dropdown-toggle" data-toggle="dropdown" href="#">Pogramación<span class="caret"></span></a>';
	      prog+='<ul class="dropdown-menu" id="submenu">';
	      prog+='<li><a href="../index.php/uploadExcel">Programacion Semanal</a></li>';
        prog+='<li><a href="../index.php/CargarPSO">Programacion Diaria</a></li>';
	      prog+='</ul>';
	      $( "#prog" ).html(prog);

      }

      if(idcon == 13){

          var html="";
          html+='<a class="dropdown-toggle" data-toggle="dropdown" href="#">Operación<span class="caret"></span></a>';
          html+='<ul class="dropdown-menu" id="submenu">';
          html+='<li id="segui_op"><a href="../index.php/PuntosControl">Operación Diaria</a></li>';
          html+='<li id="despacho"><a href="../index.php/ProgramacionSemanal">Programación Vehículos</a></li>';
          html+='<li id="despacho"><a href="../index.php/Resumen_pso">Resumen PSO</a></li>';
          html+='<li id="despacho"><a href="../index.php/Informe_dia">Informe Diario</a></li>';
          html+='</ul>';
          $( "#operacion" ).html(html);

          var prog="";
          prog+='<a class="dropdown-toggle" data-toggle="dropdown" href="#">Pogramación<span class="caret"></span></a>';
          prog+='<ul class="dropdown-menu" id="submenu">';
          prog+='<li><a href="../index.php/uploadExcel">Programacion Semanal</a></li>';
          prog+='<li><a href="../index.php/uploadExcel">Programacion Diaria</a></li>';
          prog+='</ul>';
          $( "#prog" ).html(prog);

          var inci="";
          inci+='<a class="dropdown-toggle" data-toggle="dropdown" href="#">Incidentes<span class="caret"></span></a>';
          inci+='<ul class="dropdown-menu" id="submenu">';
          //inci+='<li><a href="../index.php/ReporteIncidentes">Ver Incidentes</a></li>';
          inci+='<li><a href="../index.php/RespuestaIncidentes">Respuesta Incidentes</a></li>';
          inci+='</ul>';
          $( "#incidentes" ).html(inci);


      }


    }else{
      //$( "#pass_insert" ).show();
      var html="";
      html+='<a class="dropdown-toggle" data-toggle="dropdown" href="#">Operación<span class="caret"></span></a>';
      html+='<ul class="dropdown-menu" id="submenu">';
      html+='<li id="pass_insert"><a href="../index.php/PassIngreso">Clave Ingreso</a></li>';
      html+='<li id="segui_op"><a href="../index.php/PuntosControl">Operación Diaria</a></li>';
      html+='<li id="puntosctrl"><a href="../index.php/PuntosCapturados">Puntos Capturados</a></li>';
      html+='<li id="despacho"><a href="../index.php/ActividadDespacho">Despachadores</a></li>';
      html+='<li id="despacho"><a href="../index.php/ProgramacionSemanal">Programación Vehículos</a></li>';
      html+='<li id="despacho"><a href="../index.php/Resumen_pso">Resumen PSO</a></li>';
      html+='<li id="despacho"><a href="../index.php/Informe_dia">Informe Diario</a></li>';
      html+='</ul>';
      $( "#operacion" ).html(html);

      var inci="";
      inci+='<a class="dropdown-toggle" data-toggle="dropdown" href="#">Incidentes<span class="caret"></span></a>';
      inci+='<ul class="dropdown-menu" id="submenu">';
      inci+='<li><a href="../index.php/ReporteIncidentes">Ver Incidentes</a></li>';
      inci+='<li><a href="../index.php/RespuestaIncidentes">Respuesta Incidentes</a></li>';
      inci+='</ul>';
      $( "#incidentes" ).html(inci);

      var prog="";
      prog+='<a class="dropdown-toggle" data-toggle="dropdown" href="#">Pogramación<span class="caret"></span></a>';
      prog+='<ul class="dropdown-menu" id="submenu">';
      prog+='<li><a href="../index.php/uploadExcel">Programacion Semanal</a></li>';
      prog+='<li><a href="../index.php/CargarPSO">Programacion Diaria</a></li>';
      prog+='</ul>';
      $( "#prog" ).html(prog);
    }

  }



  function getNotificacion(){
      var idcon=<? echo $consecutivo; ?>;
      var depto="";



        if(idcon==6){
          depto="OP";
          
          var role="<? echo $rol; ?>";
          if(role=="JURIDICA"){
            depto="AC";
          }
        }
        if(idcon==7){
          depto="AD";
        }
        if(idcon==9){
          depto="MA";
        }
        if(idcon==10){
          depto="PE";
        }
        if(idcon == 13){
          loadNotifyRodamiento();
        }else{
          loadNotify(idcon, depto);
        }
      

  }

  function loadNotify(id, area){
    
    $.post("../index.php/ReporteIncidentes/lstIncidentesNoVistos",
    {
      "id":id,
      "area":area
    },
    function (data) {

      if(!data){
        $("#menuNotify").hide();
        $("#idNotify").html("");
        $("#bell").css("color", "white");
      }else{

        notify_list(data);
      }
    }, "json");

  }

  function notify_list(data){

      var html="";
      for (var i = 0; i < data.length; i++) {
        var incidente=data[i].incidente;
        if(incidente.length > 30){
          incidente=incidente.slice(0, 30);
          incidente+="...";
        }
        html+="<li><a id='itemInc' href='#' onclick='setVistoIncidente("+data[i].IdIncidente+");'><strong>Nuevo Incidente del vehículo "+data[i].carro+": </strong>"+incidente+"</br>Estado: "+data[i].resuelto+"<p id='hmN'>"+data[i].fecha+" "+data[i].hora+"</p></a></li>";
      }

      $("#menuNotify").html(html);

      if(data.length>0){
      	if(data.length<=30){
      		$("#idNotify").html("<span>"+data.length+"</span>");
      	}
      	if(data.length>30){
      		$("#idNotify").html("<span>30+</span>");
      	}
        
        $("#bell").css("color", "yellow");

        if(data.length==3){
          $("#menuNotify").css("height", "220px");
        }
        if(data.length==2){
          $("#menuNotify").css("height", "150px");
        }
        if(data.length==1){
          $("#menuNotify").css("height", "80px");
        }
      }
  }

  function notify_Rodamiento(data){

      var html="";
      for (var i = 0; i < data.length; i++) {
        html+="<li><a id='itemRoda' href='#' onclick=''>"+data[i].dias+" DIA(S) PARA INGRESAR EL VEHICULO <strong>"+data[i].carro+"</strong> A RODAMIENTO<br><p id='fechaIng'>Fecha de Ingreso: <strong>"+data[i].fecha_ingreso+"</strong></p></a></li>";
      }

      $("#menuNotify").html(html);

      if(data.length>0){
        if(data.length<=30){
          $("#idNotify").html("<span>"+data.length+"</span>");
        }
        if(data.length>30){
          $("#idNotify").html("<span>30+</span>");
        }
        
        $("#bell").css("color", "yellow");

        if(data.length==3){
          $("#menuNotify").css("height", "220px");
        }
        if(data.length==2){
          $("#menuNotify").css("height", "150px");
        }
        if(data.length==1){
          $("#menuNotify").css("height", "80px");
        }
      }
  }

  function setVistoIncidente(id_incidente){
    $.post("../index.php/ReporteIncidentes/setIncidenteVisto",
    {
      "id":id_incidente
    },
    function (data) {
      getNotificacion();
    }, "json");
  }

  function loadNotifyRodamiento(){
    
    $.post("../index.php/RespuestaIncidentes/notifyRodamiento",
    {
    },
    function (data) {

      if(!data){
        $("#menuNotify").hide();
        $("#idNotify").html("");
        $("#bell").css("color", "white");
      }else{

        notify_Rodamiento(data);
      }
    }, "json");

  }

</script>

<style type="text/css">

#menuNotify{
  height: 350px;
  overflow: auto;
}

#siigott{
  color: yellow;
  text-shadow: 2px 1px #000;
}


#idNotify{
  font-size: 12px;
  color: yellow;

}
#itemInc{
  font-size: 12px;
}
#itemRoda{
  font-size: 14px;
}

.navbar{
  background-color: #000C85;

}

#navbar{
  margin-bottom: 10px;
  box-shadow: 3px 3px 5px  rgba(0, 0, 0, 0.4);
}


.navbar a{
  color: white;
  
}

.navbar .brand, .navbar .nav > li > a:hover {
    color: white;
    background-color: #000C60;
}

.navbar .brand, .navbar .nav > li > a:focus {
    color: white;
    background-color: #000C60;
}

#submenu{
  background-color: #000C85;
  
}

#submenu a{
  color: white;
}

#submenu a:hover{
  color: white;
  background-color: #000C60;
}


#btnNotify{
  font-size: 20px;
}

#hmN{
  font-size: 12px;
  color: #001B89;
}

#fechaIng{
  color:#00076F;
  background-color: #D2D500;
  width: 50%;
  border-radius: 5px;
}

</style>