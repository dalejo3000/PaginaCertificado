<?php
session_start();
include './php/conexion.php';
if(!isset($_SESSION['carrito2'])){header("Location: ./index.php");}
$arreglo  = $_SESSION['carrito2'];
$password="";
if(isset($_POST['c_account_password'])){
    if($_POST['c_account_password']!=""){
        $password = $_POST['c_account_password'];
    }
}

if(isset($_POST['nombre']) &&  isset($_POST['cedula'])   &&  isset($_POST['categoria'])){

            $conexion->query("insert into clientes
                (nombre,cedula, imagen,id_categoria) values
                (
                    '".$_POST['nombre']."',
                    '".$_POST['cedula']."',
                    '$nombreFinal',
                    ".$_POST['categoria']."
                )   ")or die($conexion->error);
                header("Location: ../admin/productos.php?success");
?>
