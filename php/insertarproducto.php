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

if(isset($_POST['nombre']) &&  isset($_POST['cedula'])   &&  isset($_POST['categoria'])){

            $id_usuario = $conexion->insert_id;
            $fecha = date('Y-m-d h:m:s');
            $conexion->query("insert into clientes
                (nombre,cedula, id_categoria,fecha_creacion) values
                (
                    '".$_POST['nombre']."',
                    '".$_POST['cedula']."',
                    ".$_POST['categoria'].",
                    '$fecha'
                )   ")or die($conexion->error);
                header("Location: ../admin/productos.php?success");
              }
?>
