<?php
session_start();
include './conexion.php';
if(!isset($_SESSION['carrito2'])){header("Location: ./index.php");}
$arreglo  = $_SESSION['carrito2'];
$password="";
if(isset($_POST['c_account_password'])){
    if($_POST['c_account_password']!=""){
        $password = $_POST['c_account_password'];
    }
}


if(isset($_POST['nombre']) &&  isset($_POST['descripcion'])   &&  isset($_POST['duracion'])  &&  isset($_POST['fecha_inicio']) ){

            $id_usuario = $conexion->insert_id;
            $fecha = date('Y-m-d h:m:s');
            $conexion->query("insert into cursos
                (nombre,descripcion,duracion,fecha_inicio,fecha_creacion) values
                (
                    '".$_POST['nombre']."',
                    '".$_POST['descripcion']."',
                    '".$_POST['duracion']."',
                    '".$_POST['fecha_inicio']."',
                    '$fecha'
                )   ")or die($conexion->error);
                header("Location: ../admin/cursos.php?success");
              }
?>
