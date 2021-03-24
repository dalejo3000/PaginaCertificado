<?php
  /*session_start();*/
  include "./php/conexion.php";
/*  if(!isset($_SESSION['datos_login'])){
    header("Location: ../index.php");
  }
  $arregloUsuario = $_SESSION['datos_login'];
  if($arregloUsuario['nivel']!= 'admin'){
    header("Location: ../index.php");
  }*/
  $resultado = $conexion ->query("
    select * from usuario
    order by nivel ASC")or die($conexion->error);

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
            <h1 class="m-0 text-dark">Administradores</h1>
          </div><!-- /.col -->
          <div class="col-sm-6 text-right">
             <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
              <i class="fa fa-plus"></i> Insertar Usuario
            </button>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

          <?php
            if(isset($_GET['error'])){
          ?>
            <div class="alert alert-danger" role="alert">
            <?php echo $_GET['error'];?>
            </div>

          <?php  }?>
          <?php
            if(isset($_GET['success'])){
          ?>
            <div class="alert alert-success" role="alert">
              Se ha insertado correctamente.
            </div>

          <?php  }?>
          <table class="table">
            <thead>
              <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Telefono</th>
                <th>Email</th>
                <!--<th>password</th>-->
                <th>Nivel</th>
                <th>Cedula</th>
                <th>Fecha</th>
                <th>Curso</th>
                <th></th>
              </tr>

            </thead>
            <tbody>

                  <?php
                    while($f = mysqli_fetch_array($resultado)){
                  ?>
                   <tr>
                      <td><?php echo $f['id'];?></td>
                      <td>
                        <img src="../images/users/<?php echo $f['img_perfil'];?>" width="20px" height="20px" alt="">
                        <?php echo $f['nombre'];?>
                      </td>
                      <td><?php echo $f['telefono'];?></td>
                      <td><?php echo $f['email'];?></td>
                      <!--<td><?php echo $f['password'];?></td>-->
                      <td><?php echo $f['nivel'];?></td>
                      <td><?php echo $f['cedula'];?></td>
                      <td><?php echo $f['fecha'];?></td>
                      <td><?php echo $f['curso'];?></td>
                      <td>
                        <button class="btn btn-primary btn-small btnEditar"
                          data-id="<?php echo $f['id']; ?>"
                          data-nombre="<?php echo $f['nombre']; ?>"
                          data-telefono="<?php echo $f['telefono']; ?>"
                          data-email="<?php echo $f['email']; ?>"
                          data-password="<?php echo $f['password']; ?>"
                          data-nivel="<?php echo $f['nivel']; ?>"
                          data-cedula="<?php echo $f['cedula']; ?>"
                          data-fecha="<?php echo $f['fecha']; ?>"
                          data-curso="<?php echo $f['curso']; ?>"
                          data-toggle="modal" data-target="#modalEditar">
                          <i class="fa fa-edit"></i>
                        </button>
                        <button class="btn btn-danger btn-small btnEliminar"
                          data-id="<?php echo $f['id']; ?>"
                          data-toggle="modal" data-target="#modalEliminar">
                          <i class="fa fa-trash"></i>
                        </button>
                      </td>
                    </tr>
                <?php
                   }
                ?>
            </tbody>
          </table>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <?php /* include("./layouts/header.php"); */?>
          <form action="./thankyou.php" method="POST" enctype="multipart/form-data">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Insertar Usuario</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

          <div class="modal-body">
            <div class="col-md-20 mb-5 mb-md-0">
              <div class="p-3 p-lg-5 border">
                  <h2 class="h3 mb-3 text-black">Crear Usuario</h2>
                <div class="form-group row">
                  <div class="col-md-6">
                    <label for="c_fname" class="text-black">Nombres<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="c_fname" name="c_fname">
                  </div>
                  <div class="col-md-6">
                    <label for="c_lname" class="text-black">Apellidos<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="c_lname" name="c_lname">
                  </div>
                </div>

                <div class="form-group row mb-5">
                  <div class="col-md-6">
                    <label for="c_email_address" class="text-black">Email<span class="text-danger">*</span></label>
                    <input type="mail" class="form-control" id="c_email_address" name="c_email_address">
                  </div>
                  <div class="col-md-6">
                    <label for="c_phone" class="text-black">Teléfono<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="c_phone" name="c_phone" placeholder="Phone Number">
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-md-6">
                    <label for="c_cedula" class="text-black">Cédula de identidad<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="c_cedula" name="c_cedula">
                  </div>
                  <div class="col-md-6">
                    <label for="c_fecha" class="text-black">Fecha de Nacimiento<span class="text-danger">*</span></label>
                    <input type="date" class="form-control" id="c_fecha" name="c_fecha">
                  </div>
                </div>

                <div class="form-group row">
                <div class="col-md-6">
                  <label for="c_curso" class="text-black">Curso<span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="c_curso" name="c_curso">
                </div>
                <!--
                <div class="form-group">
                  <label for="c_account_password" class="text-black">Password</label>
                  <input type="password" class="form-control" id="c_account_password" name="c_account_password" placeholder="">
                </div>
              -->
                </div>

                <div class="form-group">
                  <button class="btn btn-primary btn-lg py-3 btn-block" type="submit">Crear usuario</button>
                </div>
              </div>
            </div>


              </div>

          </div>

        </form>
      </div>
    </div>
  </div>
    <!-- Modal Eliminar -->
    <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
              <h5 class="modal-title" id="modalEliminarLabel">Eliminar Producto</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                ¿Desea eliminar el producto?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-danger eliminar" data-dismiss="modal">Eliminar</button>
            </div>

        </div>
      </div>
    </div>
   <!-- Modal Editar -->
   <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="modalEditar" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form action="../php/editarproducto.php" method="POST" enctype="multipart/form-data">
          <div class="modal-header">
            <h5 class="modal-title" id="modalEditar">Editar Producto</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <input type="hidden" id="idEdit" name="id">

              <div class="form-group">
                  <label for="nombre">Nombre</label>
                  <input type="nombreEdit" name="nombre" placeholder="Nombres y Apellidos" id="nombreEdit" class="form-control" required>
              </div>
              <div class="form-group">
                  <label for="cedula">Cedula</label>
                  <input type="cedulaEdit" name="cedula" placeholder="CI" id="cedulaEdit" class="form-control" required>
              </div>

              <div class="form-group">
                  <label for="fecha">Fecha</label>
                  <input type="dateEdit" name="fecha"  id="fechaEdit" class="form-control" required>
              </div>

              <div class="form-group">
                  <label for="cedula">Curso</label>
                  <input type="cursoEdit" name="curso" placeholder="Curso" id="cursoEdit" class="form-control" required>
              </div>

              <div class="form-group">
                  <label for="telefono">Telefono</label>
                  <input type="text" name="telefonoEdit" placeholder="telefono" id="telefonoEdit" class="form-control" required>
              </div>

              <div class="form-group">
                  <label for="email">Email</label>
                  <input type="emailEdit" name="email" placeholder="Email" id="emailEdit" class="form-control" required>
              </div>

              <div class="form-group">
                  <label for="img_perfil">Imagen</label>
                  <input type="file" name="img_perfil"  id="img_perfil" class="form-control">
              </div>
              <!--
              <div class="form-group">
                  <label for="passwordEdit">password</label>
                  <input type="password" name="password" placeholder="precio" id="passwordEdit" class="form-control" required>
              </div>
            -->
              <!--
              <div class="form-group">
                  <label for="nivelEdit">Nivel</label>
                  <select name="nivel" id="nivel" class="form-control" required>
                   <?php
                    /*$res= $conexion->query("select distinct nivel from usuario");
                    while($f=mysqli_fetch_array($res)){
                      echo '<option value="'.$f['id'].'" >'.$f['nivel'].'</option>';
                    }*/
                   ?>
                  </select>
                -->
              </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary editar">Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <?php include "./layouts/footer.php";?>
</div>
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

<script>
  $(document).ready(function(){
    var idEliminar= -1;
    var idEditar=-1;
    var fila;
    $(".btnEliminar").click(function(){
      idEliminar= $(this).data('id');
      fila=$(this).parent('td').parent('tr');
    });
    $(".eliminar").click(function(){
      $.ajax({
        url: './php/eliminarusuario.php',
        method:'POST',
        data:{
          id:idEliminar
        }
      }).done(function(res){

        $(fila).fadeOut(1000);
      });

    });
    $(".btnEditar").click(function(){
      idEditar=$(this).data('id');
      var nombre=$(this).data('nombre');
      var cedula=$(this).data('cedula');
      var fecha=$(this).data('fecha');
      var curso=$(this).data('curso');
      var telefono=$(this).data('telefono');
      var email=$(this).data('email');
      var password=$(this).data('password');
      var nivel=$(this).data('nivel');

      $("#nombreEdit").val(nombre);
      $("#cedulaEdit").val(cedula);
      $("#fechaEdit").val(fecha);
      $("#cursoEdit").val(curso);
      $("#telefonoEdit").val(telefono);
      $("#emailEdit").val(email);
      $("#passwordEdit").val(password);
      $("#nivelEdit").val(nivelEdit);
      $("#idEdit").val(idEditar);
    });
  });

</script>
</body>
</html>
