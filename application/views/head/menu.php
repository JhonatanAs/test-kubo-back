<script src="<?php echo base_url();?>assets/jquery-1.10.2.min.js"></script>
<script src="<?php echo base_url();?>assets/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>assets/dataTables.bootstrap.js"></script>
<!--<script src="css/bootstrap/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="css/bootstrap/css/bootstrap.min.css">-->
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
<script src="<?php echo base_url();?>assets/js/sif/menu.js"></script> 
<link rel="stylesheet" href="<?php echo base_url();?>assets/css-sif/sif/menu.css">

<!--AUTOCOMPLETADO-->
<script src="<?php echo base_url();?>assets/autocomplete/jquery.easy-autocomplete.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>assets/autocomplete/easy-autocomplete.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/autocomplete/easy-autocomplete.themes.min.css">  

<head>
  <title>Sistema Inventario y Facturación</title>
  <link rel="shortcut icon" href="<?php echo base_url();?>assets/img/icono.ico">
</dead>


<div class="row affix-row">

    <div class="col-sm-3 col-md-2 affix-sidebar">
		<div class="sidebar-nav">

  <div class="navbar navbar-default" role="navigation" id="menu_lst">
    <div class="navbar-header">

    </div>
    <div class="navbar-collapse collapse sidebar-navbar-collapse" id="menu_items">
      <ul class="nav navbar-nav" id="sidenav01">
        <li class="active" id="item_lst">
        	<h4 style="text-align: center;">MENU</h4>

        </li>
        <li id="item_lst" class="ini"><a style="font-size: 16px;" href="/SIFplus/Inicio"><span class="glyphicon glyphicon-home"></span> Inicio</a></li>
        <li id="item_lst" class="item_main">
          <a  id="lst_inv" href="#" data-toggle="collapse" data-target="#toggleDemo" data-parent="#sidenav01" class="collapsed">
          <span class="glyphicon glyphicon-tasks"></span> Iventario<span class="caret pull-right"></span>
          </a>
          <div class="collapse" id="toggleDemo" style="height: 0px;">
            <ul class="nav nav-list">
              <li id="new_prod"><a href="/SIFplus/Producto_Nuevo">Nuevo Producto</a></li>
              <li><a href="/SIFplus/Productos">Listado Productos</a></li>
              <li><a href="/SIFplus/Producto_Agotado">Productos Agotados</a></li>
            </ul>
          </div>
        </li>
        <!--<li class="active">-->
        <li id="item_lst" class="item_main">
          <a  id="lst_inv" href="#" data-toggle="collapse" data-target="#toggleDemo2" data-parent="#sidenav01" class="collapsed">
          <span class="glyphicon glyphicon-user"></span> Clientes<span class="caret pull-right"></span>
          </a>
          <div class="collapse" id="toggleDemo2" style="height: 0px;">
            <ul class="nav nav-list">
              <li><a href="/SIFplus/Clientes">Gestión de Clientes</a></li>
            </ul>
          </div>
        </li>

        <li id="item_lst" class="rang_cart rang_cajero">
          <a  id="lst_inv" href="#" data-toggle="collapse" data-target="#toggleProveedor" data-parent="#sidenav01" class="collapsed">
          <span class="glyphicon glyphicon-user"></span> Proveedores <span class="caret pull-right"></span>
          </a>
          <div class="collapse" id="toggleProveedor" style="height: 0px;">
            <ul class="nav nav-list">
              <li><a href="/SIFplus/Proveedor">Gestión de Proveedores</a></li>
            </ul>
          </div>
        </li>

        <li id="item_lst" class="item_main">
          <a  id="lst_inv" href="#" data-toggle="collapse" data-target="#toggleFactura" data-parent="#sidenav01" class="collapsed">
          <span class="glyphicon glyphicon-shopping-cart"></span> Ventas <span class="caret pull-right"></span>
          </a>
          <div class="collapse" id="toggleFactura" style="height: 0px;">
            <ul class="nav nav-list">
              <li><a href="/SIFplus/Factura">Nueva Venta</a></li>
              <li><a href="/SIFplus/VentasDia">Ventas del dia</a></li>
              <li><a href="/SIFplus/VentasHistorial">Historial de ventas</a></li>
              
            </ul>
          </div>
        </li>

        <li id="item_lst" class="rang_cart rang_cajero">
          <a  id="lst_inv" href="#" data-toggle="collapse" data-target="#toggleCompras" data-parent="#sidenav01" class="collapsed">
          <span class="glyphicon glyphicon-copy"></span> Compras <span class="caret pull-right"></span>
          </a>
          <div class="collapse" id="toggleCompras" style="height: 0px;">
            <ul class="nav nav-list">
              <li id="compra_prod"><a href="/SIFplus/Compra">Nueva Compra</a></li>
              <li><a href="/SIFplus/ComprasDia">Compras del dia</a></li>
              <li><a href="/SIFplus/HistorialCompras">Historial de Compras</a></li>
            </ul>
          </div>
        </li>

        <li id="item_lst" class="rang_cart">
          <a  id="lst_inv" href="#" data-toggle="collapse" data-target="#toggleCartera" data-parent="#sidenav01" class="collapsed">
          <span class="glyphicon glyphicon-credit-card"></span> Cartera <span class="caret pull-right"></span>
          </a>
          <div class="collapse" id="toggleCartera" style="height: 0px;">
            <ul class="nav nav-list">
              <li><a href="/SIFplus/Cartera">Cartera Clientes</a></li>
              <li class="rang_cajero"><a href="/SIFplus/Cartera_Proveedor">Cartera Proveedores</a></li>

              <li><a href="/SIFplus/Abonos">Abonos Clientes (Dia)</a></li>
              <li><a href="/SIFplus/HistorialAbonos">Abonos Clientes (Historial)</a></li>

              <li class="rang_cajero"><a href="/SIFplus/Abonos_Proveedor">Abonos Proveedores (Dia)</a></li>
              <li class="rang_cajero"><a href="/SIFplus/HistorialAbonos_Prov">Abonos Proveedores (Historial)</a></li>
              
            </ul>
          </div>
        </li>

        <li id="item_lst" class="item_main">
          <a  id="lst_inv" href="#" data-toggle="collapse" data-target="#toggleContable" data-parent="#sidenav01" class="collapsed">
          <span class="glyphicon glyphicon-transfer"></span> Contabilidad <span class="caret pull-right"></span>
          </a>
          <div class="collapse" id="toggleContable" style="height: 0px;">
            <ul class="nav nav-list">
              <li><a href="/SIFplus/Contabilidad">Informe Historico</a></li>
            </ul>
          </div>
        </li>

        <li id="item_lst"><a href="/SIFplus/Configuracion"><span class="glyphicon glyphicon-cog"></span> Configuración</a></li>
        <li id="item_lst" class="item_main"><a href="#" onclick="cerrarSesion()"><span class="glyphicon glyphicon-log-out"></span> Cerrar Sesión</a></li>
        <li><p id="txt_hora" style="font-size: 45px; color:#581845; margin-left: 1.5%; margin-top: 10px; font-weight: bold;">HH:MM:SS</p>
          <p id="txt_fecha" style="font-size: 20px; margin-left: 3.8%; margin-top: -20px;"></p>
        </li>
      </ul>
      </div><!--/.nav-collapse -->
    </div>
  </div>
	</div>


  <script type="text/javascript">
    
    var role= "<?php echo $rol; ?>";
    var rang= "<?php echo $rang; ?>";
    $(function() {

      set_rang();
      permisos();
      horaActual();
      setInterval(horaActual, 1000);
      fechaActual_reloj();
    });

  </script>
