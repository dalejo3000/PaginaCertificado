<?php
 /*session_start();*/
  include('./php/conexion.php');
  if(!isset($_GET['texto'])){
    header("Location: ./certificado.php");
  }

  /*if(!isset($_SESSION['datos_login'])){
    header("Location: ../index.php");
  }
  $arregloUsuario = $_SESSION['datos_login'];
  if($arregloUsuario['nivel']!= 'admin'){
    header("Location: ../index.php");
  }
  $resultado = $conexion ->query("
    select * from usuario
    order by nivel ASC")or die($conexion->error);


/*include ("conexion.php");
$cedula = $_POST['cedula'];
mysql_select_db($carrito,$conexion) or die ("Error al conectar base de datos");
$registros = mysql_query("Select * from usuario where cedula= '$cedula'");
while ($registro = mysql_fetch_Array($registros)){
  echo $registro['Cedula']." ".$registro['Nombre'];
}*/
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="./admin/dashboard/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="./admin/dashboard/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="./admin/dashboard/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="./admin/dashboard/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="./admin/dashboard/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="./admin/dashboard/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="./admin/dashboard/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="./admin/dashboard/plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <?php include "./layouts/header.php";?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Generador Certificado</h1>
          </div><!-- /.col -->

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div id="container">

      <form action="buscar.php" method="post">
        <div class="p-3 p-lg-5 border">
            <h3 class="h3 mb-3 text-black">Búsqueda de Estudiante</h2>
              <!--
              <div class="col-md-6">
                <input type="text" name="codigo" placeholder="Ingrese número de cédula"></br></br>
                <input type="submit" name="cedula" class="btn btn-primary" value="Buscar"></br></br>
              </div>
            -->
              <div class="col-6 col-md-4 order-2 order-md-1 site-search-icon text-left">
                <form action="./busqueda.php" class="site-block-top-search" method="GET">
                  <span class="icon icon-search2"></span>
                  <input type="text" class="form-control border-0" placeholder="Ingrese cédula del usuario" name="texto">
                </form>
              </div>
        </div>
      </form>

            <form id="details" target="_blank" action="make_certificate.php" method="POST" enctype="multipart/form-data">

                <div class="p-3 p-lg-5 border">
                    <h2 class="h3 mb-3 text-black">Busqueda para: "<?php echo $_GET['texto']; ?>"</h2>

                <div class="col-md-4">
                  <?php
                    $resultado = $conexion ->query("select * from usuario where
                    cedula = '".$_GET['texto']."'
                    ")or die($conexion -> error);
                      if(mysqli_num_rows($resultado) > 0){
                        while($fila = mysqli_fetch_array($resultado)){
                  ?>

                    <div class="col-md-6">
                      <label> Nombres del Estudiante:</label></br>
                      <input id="name" name="name" class="textField" placeholder="Nombres y Apellidos"
                        value="<?php echo $fila['nombre']; ?>">
                    </div>
                    <div class="col-md-6">
                      <label>Curso aprobado:</label></br>
                      <input id="event" name="event" class="textField" placeholder="Curso"
                        value="<?php echo $fila['curso']; ?>">
                    </div>
                </div>

              <?php } }else{
                echo  '<h2>Sin resultados</h2>';
              } ?>

                      <div class="content-header">
                        <div class="container-fluid">
                          <div class="row mb-2">

                            <div class="col-sm-6 text-right">
                                <input type="submit" value="Generar Certificados" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                <i class="fa">
                            </div>
                          </div><!-- /.row -->
                        </div><!-- /.container-fluid -->
                      </div>

            </form>
        </div>

    <!-- Main content -->

    <section>

    </section>
    <!-- /.content -->
  </div>
  <!-- Modal -->

<!-- ./wrapper -->

<!-- jQuery -->
<script src="./admin/dashboard/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="./admin/dashboard/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="./admin/dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="./admin/dashboard/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="./admin/dashboard/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="./admin/dashboard/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="./admin/dashboard/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="./admin/dashboard/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="./admin/dashboard/plugins/moment/moment.min.js"></script>
<script src="./admin/dashboard/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="./admin/dashboard/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="./admin/dashboard/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="./admin/dashboard/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="./admin/dashboard/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="./admin/dashboard/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="./admin/dashboard/dist/js/demo.js"></script>



</script>
</body>
</html>
