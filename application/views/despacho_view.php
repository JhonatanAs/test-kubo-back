<?php $this->load->view('head/nav'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<div id="loader"></div>

<div class="parametros">
	<div class="panel panel-default sitio">
	  <!--<div class="panel-heading" style="text-align: center;">Operación</div>-->
	  <div class="panel-body sitio-body">
	  	<span style="font-size: 16px; margin-left: 30px;"><span class="glyphicon glyphicon-home"></span><span class="glyphicon glyphicon-flag"></span> Seleccione el despacho</span>
	  	<div class="flex-param">
		  	<div class="find-despacho">
					<select id="txt_sitio" class="form-control" onchange="">
						<option value=0 >SELECCIONE...</option>
						<option value=1 >JAZMINES</option>
						<option value=2 >LOMAS GRADANA</option>
						<option value=3 >SAUCES</option>
					</select>
			</div>
			<div class="btn-cargar">
				<button style="margin-top: 0px;" type="button" class="btn btn-primary" onclick="cargarOperacion()"><span class="glyphicon glyphicon-play-circle"></span> Iniciar Operación</button>
			</div>
		</div>

	  </div>
	</div>

	<div class="panel panel-default fecha-hora">
	  <div class="panel-body" id="clock-info" style="padding: 0px;">
	  	<div id="div-fecha">
	  		<p  style="text-align: center" class="fecha">2018-00-00</p>
	  	</div>
	  	<div id="div-hora">
	  		<p style="text-align: center" class="hora">00:00:00</p>
	  	</div>

	  </div>
	</div>
</div>

<div class="rutas">
	
	<!--TABS RUTAS-->
	<div id="load-rutas">
		
	</div>
	<!--CONTENIDO DE LAS RUTAS-->
	<div class="tab-content" id="content-rutas">
		<ul class="list-group" id="info_carros"></ul>
	</div>

</div>

<!--MODAL VER INCIDENTES-->
<div class="modal fade" id="add-car-modal" role="dialog">
    <div class="modal-dialog modal-md" role="document">
    
      <div class="modal-content">
        <div class="modal-header bg-blue">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="text-align: center;">Agregar Vehículo</h4>
        </div>
        <div class="modal-body">
        
	        <div>
	        	<p id="lst-carros"><select id='carro-add' class='form-control'><option value='0'>SELECCIONE...</option></select></p>
	        </div>

        </div>
        
        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" id="cerrarModal">Cerrar</button>
          <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal" id="actualizarIncidente" onclick="agregarCarro();">Agregar Carro</button>
        </div>

      </div>
      
    </div>
 </div>

 <!--MODAL ELIMINAR TAREAS-->
<div class="modal fade" id="del-tareas-modal" role="dialog">
    <div class="modal-dialog modal-md" role="document">
    
      <div class="modal-content">
        <div class="modal-header bg-blue">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="text-align: center;">Eliminar Tareas</h4>
        </div>
        <div class="modal-body">
        
	        <div id="delete-tareas">
	        	
	        </div>

        </div>
        
        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" id="cerrarModal">Cancelar</button>
          <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal" id="actualizarIncidente" onclick="deleteTareas();">Eliminar Tareas</button>
        </div>

      </div>
      
    </div>
 </div>

<script>
	var ruta = 0;
	var tipo = '';
	var data_pso;
	var data_carros;
	var frecuencia;
	var fecha=<?echo json_encode($fecha)?>;
	var hora_p;
	var data_json;
	var interval_clock=false;

	$(function() {
		//$("#txt-cronometro").css('color','red');
		/*$( ".ruta2" ).click(function() {
			ruta=2;
			tipo='BUS';
			clearTimeout(interval_clock);
			interval_clock=false;
		  	showPanelRuta();
		  	showDataOperando();
		  	historialPSO();
		});*/
	});


	function cargarOperacion(){
		$("#load-rutas").html("");
		despachoJazmines();
		var sitio=$("#txt_sitio").val();
		if(sitio==0){

		}
		if(sitio==1){
			cargarPSO_Despacho();
			despachoJazmines();
		}
		if(sitio==2){
			
		}
		if(sitio==3){
			
		}
	}


	function cargarPSO_Despacho(){
			$.ajax({
				    url:"../index.php/Despacho/registrarPSO_DespachoJazminesR2_R5",
				    type:"POST",
				    dataType:"json", 
				    data:{
				    },
				    beforeSend: function() {
				        $( "#loader" ).show();
				    },
				    success:function(json){
				        if(json){

				        }else{
				            		
				        }

				    },
				    error: function (response) {
				        $( "#loader" ).hide();
				    }
			});
	}

	function cargarRuta(r){
		ruta=r;
		tipo='BUS';
		clearTimeout(interval_clock);
		interval_clock=false;
		showPanelRuta();
		showDataOperando();
		historialPSO();
	}

	function despachoJazmines(){

		var rutas='';
		rutas='<ul class="nav nav-tabs despacho">';
		rutas+='<li><a data-toggle="tab" href="#ruta2" class="ruta2 tab-ruta" onclick="cargarRuta(2)">RUTA 2 </a></li>';
		rutas+='<li><a data-toggle="tab" href="#ruta5" class="ruta5 tab-ruta" onclick="cargarRuta(5)">RUTA 5 </a></li>';
		rutas+='</ul>';
		$("#load-rutas").html(rutas);
		////////////
		var html='';
		html+=showContentTabRuta(2);
		$("#content-rutas").html(html);

	}

	function showContentTabRuta(ruta){

		var content='';
		content+='<div id="ruta'+ruta+'" class="tab-pane fade">';
		content+='<div id="data-ruta'+ruta+'" class="data-ruta">';
		content+='<div id="panel-pso"></div>';
		content+='<div id="panel-salida"></div>';
		content+='</div>';
		content+='<div id="panel-historial"></div>';

		content+='</div>';
		return content;
		
	}

	function showPanelRuta(){
				clearTimeout(interval_clock);
				interval_clock=false;
				$.ajax({
				          	url:"../index.php/Despacho/cargarPSO_Temporal",
				            type:"POST",
				            dataType:"json", 
				            //async:false,  
				            data:{
				            	"ruta":ruta,
				            	"tipo":tipo,
				            	"fecha":fecha
				            },
				            beforeSend: function() {
				             $( "#loader" ).show();
				            },
				            success:function(json){
				            	if(json instanceof Object){
				  					var html='';
				  					html+=showDataCarros(json.carros);
				  					html+=showDataFrecuenciaPSO(json);
				            		$("#panel-pso").html(html);				            		
				            		sortable_carros()

				            		var a=$("#info_carros").height();
				            		var b=$("#btn-control-ruta").height();
				            		$("#data-tabla_pso").css("height", (a+b+20));
				            		$("#data-tabla_pso").css("min-height", a);
				            		
				            		var hora=json.data[0].hora_ini+":00";
									interval_clock = setInterval(cronometro, 1000, hora);

				            	}else{
				            		alert(json);
				            	}

				            },
				            error: function (response) {
				             	$( "#loader" ).hide();
				            }
				});
	}

	function sortable_carros(){
		$("#info_carros").sortable({
	        placeholder: "ui-state-highlight",
	        update: function (event, ui)
	        {
	            var carro_id_array = new Array();
	            $('#info_carros li').each(function () {
	                carro_id_array.push($(this).attr("id"));
	            });
	            
	            $.ajax({
	                url: "../index.php/Despacho/subirBajarCarro",
	                method: "POST",
	                data: {
	                	carro_id_array: carro_id_array,
	                	tarea_act:data_pso[0].tarea
	                },
	                success: function (data)
	                {
	                	showPanelRuta();
	                }
	            });
	        }
	    });
	}

	function showDataFrecuenciaPSO(json){
		var data=json.data;
		frecuencia=json.frecuencia;
		data_pso=data;

		$("#txt-frecuencia").text(json.frecuencia);

		var html='';
		html+='<div id="pso">';
		//datos de salida
		html+='<div id="data-salida">';
		html+='<div id="frecuencia">';
		html+='<span id="prox-salida">Proximo en salir <strong>'+data[0].carro+', </strong></span><span id="txt-cronometro">00:00:00</span>';
		html+='</div>';

		html+='<div id="accion-no-turno">';
		html+='<button type="button" id="delete-car" class="btn btn-danger btn-md" onclick="noSalida()"><i class="fa fa-close"></i> <i class="fa fa-bus"></i> '+data[0].carro+'</button>';
		html+='</div>';

		html+='<div id="accion-salida">';
		html+='<button type="button" id="salida-car" class="btn btn-primary btn-md" onclick="registrarSalida()"><i class="fa fa-chevron-right"></i><i class="fa fa-chevron-right"></i> <i class="fa fa-bus"></i>  '+data[0].carro+'</button>';
		html+='</div>';
 
		html+='</div>'; //fin datos de salida 
		///tabla pso
		html+='<div id="data-tabla_pso">';
		html+='<table class="table table-striped table-bordered" id="tabla_pso" style="width:100%;">';
		html+='<thead>';
		html+='<tr>';
		html+='<th>TAREA</th>';
		html+='<th>CARRO</th>';
		html+='<th>H. INICIO</th>';
		html+='<th>H. RETORNO</th>';
		html+='<th>H. LLEGADA</th>';
		html+='<th>FREC.</th>';
		html+='<th>T. PATIO</th>';
		//html+='<th>--</th>';
		html+='</tr>';
		html+='</thead>';
		html+='<tbody>';
		for(var i = 0; i <data.length;i++){

			html+='<tr>';
			html+='<td>'+data[i].tarea+'</td>';
			html+='<td><strong>'+data[i].carro+'</strong></td>';
			html+='<td>'+data[i].hora_ini+'</td>';
			html+='<td>'+data[i].hora_mt+'</td>';
			html+='<td>'+data[i].hora_fin+'</td>';
			html+='<td>'+data[i].frec+'</td>';
			html+='<td>'+data[i].patio+'</td>';
			//html+='<td>'+btn_del+' '+btn_sal+'</td>';
			html+='</tr>';
		}       
		html+='</tbody>';
		html+='</table>';
		html+='</div>';  ///fin div tabla
		html+='</div>'; ///fin div
		return html;
		//$("#panel-pso").html(html);
	}

	function showDataCarros(data){
		data_carros=data;
		var html='';
		html+='<div id="carros">';
		html+='<span><i class="fa fa-bus" style="font-size: 2.5em; padding: 10px 0px 10px 30px;"></i></span><span style="font-size:16px;">'+data.length+'</span>';
		html+='<ul class="list-group" id="info_carros">';
		for (var i = 0; i < data.length; i++) {

			var btn_del='<button type="button" id="delete-car" class="btn btn-danger btn-xs" onclick="eliminarCarroPSO('+data[i].id+')"><i class="fa fa-close"></i></button>';
        	html += '<li class="list-group-item item-car" id="' + data[i].id + '" style="text-align:center;"><span><strong>'+data[i].carro+'</strong></span> '+btn_del+'</li>';
        }
        html+='</ul>';
        var add_car='<button type="button" id="add-car" class="btn btn-success btn-md btn-block" onclick="addCarroPSO()"><i class="fa fa-plus"></i><i class="fa fa-bus"></i> Vehículo</button>';
		var add_novedad='<button type="button" id="add-novedad" class="btn btn-default btn-md btn-block" onclick=""><span class="glyphicon glyphicon-comment"></span> Novedad</button>';
		var del_tareas='<button type="button" id="add-novedad" class="btn btn-danger btn-md btn-block" onclick="eliminarTareas()"><i class="fa fa-times-circle"></i> Tareas</button>';
		
		html+='<div id="btn-control-ruta">';
		html+='<div>'+add_car+'</div>';
		html+='<div>'+add_novedad+'</div>';
		html+='<div>'+del_tareas+'</div>';
		html+='</div>';

        html+='</div>';
        
		return html;
	}

	function showDataOperando(){
		
		var html='';
		html+='<div id="carros-operando">';

		html+='<div style="padding: 10px 0px 12px 0px; float: right;">';
		html+='<div><span style="font-size:26px;"><i class="fa fa-history"></i> Frecuencia: <span id="txt-frecuencia">'+frecuencia+'</span> Minutos</span></div>';
		html+='</div>';

		html+='<div id="data-carros-operando">';
		html+='</div>';  ///fin div tabla carros operando

		html+='</div>'; ///fin div

		$("#panel-salida").html(html);
		showDataCarros_Operando();
		//return html;
	}

	function showDataCarros_Operando(){
				$.ajax({
				          	url:"../index.php/Despacho/getSalidaPSOTemp",
				            type:"POST",
				            dataType:"json",   
				            data:{
				            	"fecha":fecha,
				            	"ruta":ruta,
				            	"tipo":tipo
				            },
				            beforeSend: function() {
				             $( "#loader" ).show();
				            },
				            success:function(data){
				            	if(data instanceof Object){
				            		var html='';
				            		html+='<table class="table table-striped table-bordered" id="tabla-carros-operando">';
									html+='<thead>';
									html+='<tr>';
									html+='<th>TAREA</th>';
									html+='<th>CARRO</th>';
									html+='<th>SALIDA P.</th>';
									html+='<th>SALIDA R.</th>';
									html+='<th>DIFF.</th>';
									html+='<th>RETORNO</th>';
									html+='<th>LLEGADA</th>';
									html+='<th>ACCION</th>';
									html+='</tr>';
									html+='</thead>';
									html+='<tbody>';
									for(var i=0;i<data.length;i++){

										html+='<tr>'
										html+='<td>'+data[i].tarea+'</td>';
										html+='<td>'+data[i].carro+'</td>';	
										html+='<td>'+data[i].salida_p+'</td>';	
										html+='<td>'+data[i].salida_r+'</td>';	
										html+='<td>'+data[i].diff+'</td>';		
										html+='<td>'+data[i].retorno+'</td>';	
										html+='<td>'+data[i].lleg+'</td>';	
										html+='<td>'+data[i].accion+'</td>';	
										html+='</tr>';
									}
									html+='</tbody>';
									html+='</table>';
									$("#data-carros-operando").html(html);

				            	}else{
				            		var html='';
				            		html+='<table class="table table-striped table-bordered" id="tabla-carros-operando">';
									html+='<thead>';
									html+='<tr>';
									html+='<th>TAREA</th>';
									html+='<th>CARRO</th>';
									html+='<th>SALIDA P.</th>';
									html+='<th>SALIDA R.</th>';
									html+='<th>DIFF.</th>';
									html+='<th>RETORNO</th>';
									html+='<th>LLEGADA</th>';
									html+='<th> ACCION </th>';
									html+='</tr>';
									html+='</thead>';
									html+='<tbody>';
				            		html+='</tbody>';
									html+='</table>';
									$("#data-carros-operando").html(html);
				            	}

				            },
				            error: function (response) {
				             	$( "#loader" ).hide();
				            }
				});
	}

	////////////////////////////////////
	function registrarSalida(){

		$.ajax({
	            url:"../index.php/Despacho/registrarSalidaVehiculo",
	            type:"POST",
	            dataType:"json",
	            data:{
	            	"fecha":fecha,
            		"ruta":ruta,
            		"tipo":tipo,
            		"tarea":data_pso[0].tarea,
            		"carro":data_pso[0].carro,
            		"salida_p":data_pso[0].hora_ini,
            		"salida_next":data_pso[1].hora_ini,
            		"tarea_next":data_pso[1].tarea,
            		"ult_tarea":data_carros[data_carros.length-1].tarea
	            },
	            beforeSend: function() {
	              $( "#loader" ).show();
	            },
	            success:function(json){

	            	$( "#loader" ).hide();

	            	if(typeof json === 'object'){
	            		if(json.result){
	            			clearTimeout(interval_clock);
							interval_clock=false;
	            			showPanelRuta();
	            			showDataCarros_Operando();
	            		}
	            	}else{
	            		if(json=="exist-carro"){
	            			alert('existe carro');
	            		}
	            	}

	            },
	            error: function (response) {
	               $( "#loader" ).hide();
	            }
	    });
	}

	function noSalida(){

		$.ajax({
	            url:"../index.php/Despacho/noSalidaVehiculo",
	            type:"POST",
	            dataType:"json",
	            data:{
	            	"fecha":fecha,
            		"ruta":ruta,
            		"tipo":tipo,
            		"tarea":data_pso[0].tarea,
            		"carro":data_pso[0].carro,
            		"salida_p":data_pso[0].hora_ini,
            		"salida_next":data_pso[1].hora_ini,
            		"tarea_next":data_pso[1].tarea,
            		"ult_tarea":data_carros[data_carros.length-1].tarea
	            },
	            beforeSend: function() {
	              $( "#loader" ).show();
	            },
	            success:function(json){

	            	$( "#loader" ).hide();
	            	if(json){
	            			clearTimeout(interval_clock);
							interval_clock=false;
	            			showPanelRuta();
	            	}else{

	            	}

	            },
	            error: function (response) {
	               $( "#loader" ).hide();
	            }
	    });
	}

	function eliminarCarroPSO(idCar){
		$.ajax({
	            url:"../index.php/Despacho/elimiarCarroPSO",
	            type:"POST",
	            dataType:"json",
	            data:{
	            	"fecha":fecha,
            		"ruta":ruta,
            		"tipo":tipo,
            		"tarea":data_pso[0].tarea,
            		"id_carro":idCar,
	            },
	            beforeSend: function() {
	              $( "#loader" ).show();
	            },
	            success:function(json){

	            	$( "#loader" ).hide();
	            	if(json){
	            			showPanelRuta();
	            	}else{

	            	}

	            },
	            error: function (response) {
	               $( "#loader" ).hide();
	            }
	    });
	}

	///llegadas PSO
	function registrarLlegada(data){
		$.ajax({
	            url:"../index.php/Despacho/registrarLLegada",
	            type:"POST",
	            dataType:"json",
	            data:{
	            	"id_ticket":data.id_salida,
	            	"salida_p":data.salida_p,
	            	"id_pso":data.id_pso,
	            	"carro":data.carro
	            },
	            beforeSend: function() {
	              $( "#loader" ).show();
	            },
	            success:function(json){

	            	$( "#loader" ).hide();
	            	if(json){
	            		showDataCarros_Operando();
	            		historialPSO();
	            	}else{

	            	}

	            },
	            error: function (response) {
	               $( "#loader" ).hide();
	            }
	    });
	}

	function historialPSO(){
		
		$.ajax({
	            url:"../index.php/Despacho/getHistorialPSO",
	            type:"POST",
	            dataType:"json",
	            data:{
	            	"fecha":fecha,
				    "ruta":ruta,
				    "tipo":tipo
	            },
	            beforeSend: function() {
	              $( "#loader" ).show();
	            },
	            success:function(data){

	            	$( "#loader" ).hide();
	            	if(data instanceof Object){
	            		var html='';
						html+='<div>';
						html+='<h4 style="text-align:center;">Historial de la ruta</h4>';
						html+='<table class="table table-striped table-bordered" id="tabla_historial" style="width:100%;">';
						html+='<thead>';
						html+='<tr>';
						html+='<th>TAREA</th>';
						html+='<th>CARRO</th>';
						html+='<th>SALIDA P.</th>';
						html+='<th>SALIDA REAL.</th>';
						html+='<th>DIFF.</th>';
						html+='<th>RETORNO</th>';
						html+='<th>LLEGADA P.</th>';
						html+='<th>LLEGADA REAL</th>';
						html+='<th>DIFF.</th>';
						html+='<th>VUELTA</th>';
						html+='<th>ACCION</th>';
						html+='</tr>';
						html+='</thead>';
						html+='<tbody>';
						for(var i=0;i<data.length;i++){
							html+='<tr>'
							html+='<td>'+data[i].tarea+'</td>';
							html+='<td>'+data[i].carro+'</td>';	
							html+='<td>'+data[i].salida_p+'</td>';	
							html+='<td>'+data[i].salida_r+'</td>';	
							html+='<td>'+data[i].diff_sal+'</td>';		
							html+='<td>'+data[i].retorno+'</td>';	
							html+='<td>'+data[i].lleg+'</td>';
							html+='<td>'+data[i].lleg_r+'</td>';
							html+='<td>'+data[i].diff_lleg+'</td>';	
							html+='<td>'+data[i].vuelta+'</td>';			
							html+='<td>'+data[i].accion+'</td>';	
							html+='</tr>';
						}
						html+='</tbody>';
						html+='</table>';
						html+='</div>';
						$("#panel-historial").html(html);
	            	}else{
	            		var html='';
						html+='<div>';
						html+='<table class="table table-striped table-bordered" id="tabla_historial" style="width:100%;">';
						html+='<thead>';
						html+='<tr>';
						html+='<th>TAREA</th>';
						html+='<th>CARRO</th>';
						html+='<th>SALIDA P.</th>';
						html+='<th>SALIDA REAL.</th>';
						html+='<th>DIFF.</th>';
						html+='<th>RETORNO</th>';
						html+='<th>LLEGADA P.</th>';
						html+='<th>LLEGADA REAL</th>';
						html+='<th>DIFF.</th>';
						html+='<th>VUELTA</th>';
						html+='</tr>';
						html+='</thead>';
						html+='<tbody>';
						html+='</tbody>';
						html+='</table>';
						html+='</div>';
						$("#panel-historial").html(html);
	            	}

	            },
	            error: function (response) {
	               $( "#loader" ).hide();
	            }
	    });
	}

	function cargarCarros(){
		$.ajax({
	            url:"../index.php/Despacho/getCarrosProgramados",
	            type:"POST",
	            dataType:"json",
	            data:{
	            },
	            beforeSend: function() {
	              $( "#loader" ).show();
	            },
	            success:function(data){

	            	$( "#loader" ).hide();
	            	if(data instanceof Object){
	            		var html='';
	            		html+="<select id='carro-add' class='form-control'>";
	            		html+="<option value='0'>SELECCIONE...</option>";
	            		for(var i=0;i<data.length;i++){
	            			html+="<option value='"+data[i].carro+"'>"+data[i].carro+"</option>";
	            		}
	            		html+="</select>";
	            		$("#lst-carros").html(html);
	            	}else{
	            		var html='';
	            		html+="<select id='carro-add' class='form-control'>";
	            		html+="<option value='0'>SELECCIONE...</option>";
	            		html+="</select>";
	            		$("#lst-carros").html(html);
	            	}

	            },
	            error: function (response) {
	               $( "#loader" ).hide();
	            }
	    });
	}

	function agregarCarro(){
		$.ajax({
	            url:"../index.php/Despacho/agregarCarroPSO",
	            type:"POST",
	            dataType:"json",
	            data:{
	            	"fecha":fecha,
				    "ruta":ruta,
				    "tipo":tipo,
				    "tarea":data_pso[0].tarea,
				    "carro":$("#carro-add").val()
	            },
	            beforeSend: function() {
	              $( "#loader" ).show();
	            },
	            success:function(data){

	            	$( "#loader" ).hide();
	            	if(data){
	            		showPanelRuta();
	            	}else{

	            	}

	            },
	            error: function (response) {
	               $( "#loader" ).hide();
	            }
	    });
	}

	function addCarroPSO(){
		$("#add-car-modal").modal();
		cargarCarros();
	}

	function eliminarTareas(){
		//delete-tareas
		$("#del-tareas-modal").modal();
		showTareas();
	}

	function showTareas(){
		var html='';
		html+="<select id='txt-tarea-del' class='form-control'>";
	    html+="<option value='0'>SELECCIONE...</option>";
	    for(var i=0;i<data_pso.length;i++){

	    	var tarea=data_pso[i].tarea;
	    	if(tarea<10){
	    		tarea='0'+data_pso[i].tarea;
	    	}
	        html+="<option value='"+data_pso[i].tarea+"'>"+tarea+" | "+data_pso[i].hora_ini+" | "+data_pso[i].carro+"</option>";
	    }
	    html+="</select>";
		$("#delete-tareas").html(html);
	}

	function deleteTareas(){
		var pos=0;
		var tarea=$("#txt-tarea-del").val();
		for(var i=0;i<data_pso.length;i++){
			if(tarea==data_pso[i].tarea){
				pos=i;
				break;
			}
		}
		$.ajax({
	            url:"../index.php/Despacho/eliminarTareas",
	            type:"POST",
	            dataType:"json",
	            data:{
	            	"fecha":fecha,
				    "ruta":ruta,
				    "tipo":tipo,
				    "tarea":data_pso[pos].tarea,
				    "carro":data_pso[pos].carro,
				    "salida":data_pso[pos].hora_ini
	            },
	            beforeSend: function() {
	              $( "#loader" ).show();
	            },
	            success:function(data){
	            	$( "#loader" ).hide();
	            	if(data){
	            		showPanelRuta();
	            	}else{

	            	}
	            },
	            error: function (response) {
	               $( "#loader" ).hide();
	            }
	    });
	}

	function cronometro(hora){

			hora=hora.split(":");
			var t1=new Date();
			var t2=new Date();
			t1.setHours(hora[0], hora[1], hora[2]);
			t2.setHours(date_clock.getHours(), date_clock.getMinutes(), date_clock.getSeconds());
			if(t1>t2){
				t1.setHours(t1.getHours() - t2.getHours(), t1.getMinutes() - t2.getMinutes(), t1.getSeconds() - t2.getSeconds());
				var H=t1.getHours();
				var M=t1.getMinutes();
				var S=t1.getSeconds();
				if(H<10){
					H="0"+H;
				}
				if(M<10){
					M="0"+M;
				}
				if(S<10){
					S="0"+S;
				}
				var cron=H+":"+M+":"+S;
				$("#txt-cronometro").text(cron);
				if(cron > "00:02:00"){
					$("#txt-cronometro").css('color','green');
					$("#txt-cronometro").css('text-shadow', '1px 1px 1px #888');
					$("#prox-salida").css('color','green');
					$("#prox-salida").css('text-shadow', '1px 1px 1px #888');
					setColorDelay(0);
				}
				if(cron > "00:00:30"  && cron <= "00:02:00"){
					$("#txt-cronometro").css('color','#FFC300');
					$("#txt-cronometro").css('text-shadow', '1px 1px 1px #777');
					$("#prox-salida").css('color','#FFC300');
					$("#prox-salida").css('text-shadow', '1px 1px 1px #777');
					setColorDelay(1);
				}
				if(cron <= "00:00:30"){
					$("#txt-cronometro").css('color','red');
					$("#txt-cronometro").css('text-shadow', '1px 1px 1px #888');
					$("#prox-salida").css('color','red');
					$("#prox-salida").css('text-shadow', '1px 1px 1px #888');
					setColorDelay(2);
				}

			}else{
				$("#txt-cronometro").text("00:00:00");
				$("#txt-cronometro").css('color','red');
				$("#txt-cronometro").css('text-shadow', '1px 1px 1px #888');
				$("#prox-salida").css('color','red');
				$("#prox-salida").css('text-shadow', '1px 1px 1px #888');
				setColorDelay(2);
			}		
	}

	function setColorDelay(a){
		var item=$(".ruta"+ruta);
		if(a==0){
			item.css("color", "green");
			item.css('text-shadow', '1px 1px 1px #888');
			setTimeout(function () {
		        item.css("color", "black");
		    }, 700);
		}
		if(a==1){
			item.css("color", "#FFC300");
			item.css('text-shadow', '1px 1px 1px #888');
			setTimeout(function () {
		        item.css("color", "black");
		    }, 700);
		}
		if(a==2){
			item.css("color", "red");
			item.css('text-shadow', '1px 1px 1px #888');
			setTimeout(function () {
		        item.css("color", "black");
		    }, 700);
		}
		
	}

	
</script>


<style>

	.modal-dialog {
		  right: 0px;
		  top: 50px;
		  bottom: 0;
		  left: 0;
	}

	.tab-ruta{
		font-size: 18px;
	}
	
	thead th{
		font-size: 12px;
		text-align: center;
	}
	tbody td{
		font-size: 16px;
		text-align: center;
	}

	#tabla_historial tbody td{
		font-size: 14px;
		text-align: center;
	}

	#clock-info{
		display: flex;
		flex-wrap: wrap;
		justify-content: center;
		
	}

	#div-fecha{
		padding-top: 15px;
		padding-bottom: 10px;
		width: 350px;
	}
	#div-hora{
		padding-top: 15px;
		padding-bottom: 10px;
		width: 250px;
	}

	/*CSS RUTAS*/
	.rutas{
		width: 99%;
		margin:auto;
		box-shadow: 2px 2px 2px 2px rgba(0, 0, 0, 0.2);
		border-radius: 5px;
		padding: 10px;
	}

	/*CSS PARAMETROS*/

	.parametros{
		/*box-shadow: 1px 1px 1px 1px  rgba(0, 0, 0, 0.3);*/
		margin: auto;
		padding: 0px; 
		margin-top: 20px;
		display: flex;
		flex-wrap: wrap;
		justify-content: center;
	}

	.hora, .fecha{
		font-family: 'Orbitron', sans-serif;
		font-size: 45px;
	}

	.flex-param{
		display: flex;
		flex-wrap: wrap;
		justify-content: center;
	}

	.find-despacho{
		width: 60%;
		margin-left: 5%;
	}

	.btn-cargar{
		margin-left: 5%;
		width: 30%;
	}

	.sitio{
		width: 46%;
	}

	.fecha-hora{
		margin-left: 20px;
		width: 46%;
	}

	/*CSS PSO Y CARROS*/


	#content-rutas{
		padding-top: 5px;
	}

	.data-ruta{
		display: flex;
		flex-wrap: wrap;
	}

	#panel-pso{
		width: auto;
		max-width: 100%;
		display: flex;
		flex-wrap: wrap;
	}

	#panel-salida{
		width: auto;
	}

	#data-salida{
		display: flex;
		padding: 5px 0px 12px 2px;
		height: auto;
	}

	#accion-no-turno{
		padding-top: 5px;
		margin-left: 10px;
	}

	#accion-salida{
		padding-top: 5px;
		margin-left: 10px;
	}

	.total-carros{
		color:red;
		padding: 3px;
		margin-left: -10px;
	}

	#frecuencia{
		padding-top: 5px;
		font-size: 1.9em;
		width: 380px;
	}

	#carros{
		width: 100px;
		height: auto;
	}

	#pso{
		margin-left: 10px;
		width: auto;
	}

	.item-car:hover{
		font-size: 16px;
	}

	.item-car{
		font-size: 16px;
	}

	#info_carros{
		margin-top: 5px;
		list-style: none;
		cursor:pointer;
	}

	#carros-operando{
		margin-left: 10px;
	}

	#btn-control-ruta{

	}
	#btn-control-ruta div{
		margin-bottom: 10px;
	}

	#data-carros-operando{
		width: auto;
	}

	#txt-cronometro{
		width: 150px;
	}

	#data-tabla_pso {
		/*height: 900px;*/
   		overflow: auto;
   		display: block;
   		width: 100%;
	}

	/*HISTORIAL PSO*/
	#panel-historial{
		margin-top: 20px;
		box-shadow: 1px 1px 1px 1px rgba(0, 0, 0, 0.2);
		border-radius: 3px;
		padding: 10px 10px 5px 10px;
	}


</style>