<?php
  session_start();
  include "../php/conexion.php";
  if(!isset($_SESSION['datos_login'])){
    header("Location: ../index.php");
  }
  $arregloUsuario = $_SESSION['datos_login'];
  if($arregloUsuario['nivel']!= 'admin'){
    header("Location: ../index.php");
  }
  $resultado = $conexion ->query("
    select clientes.*, cursos.nombre as catego  from
    clientes
    inner join cursos on clientes.id_categoria = cursos.id
    order by nombre ASC")or die($conexion->error);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Inscripción curso</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="./dashboard/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="./dashboard/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="./dashboard/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="./dashboard/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="./dashboard/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="./dashboard/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="./dashboard/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="./dashboard/plugins/summernote/summernote-bs4.css">
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
              <h1 class="m-0 text-dark">Incripción Cursos</h1>
            </div><!-- /.col -->
            <div class="col-sm-6 text-right">
               <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                <i class="fa fa-plus"></i> Insertar Regitro
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

            <?php
              if(isset($_GET['successedit'])){
            ?>
              <div class="alert alert-success" role="alert">
                Se ha actualizado correctamente.
              </div>

            <?php  }?>

            <table class="table">
              <thead>
                <tr>
                  <th>Id Registro</th>
                  <th>Nombre</th>
                  <th>Cédula</th>
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
                          <?php echo $f['nombre'];?>
                        </td>
                        <td><?php echo $f['cedula'];?></td>
                        <td><?php echo $f['catego'];?></td>
                        <td>
                          <button class="btn btn-primary btn-small btnEditar"
                            data-id="<?php echo $f['id']; ?>"
                            data-nombre="<?php echo $f['nombre']; ?>"
                            data-cedula="<?php echo $f['cedula']; ?>"
                            data-categoria="<?php echo $f['id_categoria']; ?>"
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
          <form action="../php/insertarproducto.php" method="POST" enctype="multipart/form-data">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Insertar Registro</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" placeholder="nombre" id="nombre" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="cedula">Cédula</label>
                    <input type="text" name="cedula" placeholder="cedula" id="cedula" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="categoria">Curso</label>
                    <select name="categoria" id="categoria" class="form-control" required>
                     <?php
                      $res= $conexion->query("select * from cursos");
                      while($f=mysqli_fetch_array($res)){
                        echo '<option value="'.$f['id'].'" >'.$f['nombre'].'</option>';
                      }
                     ?>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Guardar</button>
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
                    <input type="nombreEdit" name="nombre" placeholder="nombre" id="nombreEdit" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="cedulaEdit">Cédula</label>
                    <input type="text" name="cedula" placeholder="cedula" id="cedulaEdit" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="categoriaEdit">Curso</label>
                    <select name="categoria" id="categoriaEdit" class="form-control" required>
                     <?php
                      $res= $conexion->query("select * from cursos");
                      while($f=mysqli_fetch_array($res)){
                        echo '<option value="'.$f['id'].'" >'.$f['nombre'].'</option>';
                      }
                     ?>
                    </select>
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
  <script src="./dashboard/plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="./dashboard/plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="./dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- ChartJS -->
  <script src="./dashboard/plugins/chart.js/Chart.min.js"></script>
  <!-- Sparkline -->
  <script src="./dashboard/plugins/sparklines/sparkline.js"></script>
  <!-- JQVMap -->
  <script src="./dashboard/plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="./dashboard/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="./dashboard/plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="./dashboard/plugins/moment/moment.min.js"></script>
  <script src="./dashboard/plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="./dashboard/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="./dashboard/plugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="./dashboard/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="./dashboard/dist/js/adminlte.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="./dashboard/dist/js/pages/dashboard.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="./dashboard/dist/js/demo.js"></script>

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
          url: '../php/eliminarproducto.php',
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
        var categoria=$(this).data('categoria');

        $("#idEdit").val(idEditar);
        $("#nombreEdit").val(nombre);
        $("#cedulaEdit").val(cedula);
        $("#categoriaEdit").val(categoria);

      });
    });

  </script>
  </body>
  </html>
