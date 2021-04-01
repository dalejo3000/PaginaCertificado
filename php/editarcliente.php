<?php
include "conexion.php";
if(isset($_POST['nombre']) &&  isset($_POST['telefono'])  &&  isset($_POST['email']) &&  isset($_POST['password']) &&
isset($_POST['cedula']) &&  isset($_POST['fecha'])){

   $conexion->query("update usuario set
                       nombre= '".$_POST['nombre'].",
                       telefono= '".$_POST['telefono']."',
                       email= '".$_POST['email']."',
                       password= '".$_POST['password']."',
                       cedula='".$_POST['cedula']."',
                       fecha='".$_POST['fecha']."''
                       where id=".$_POST['id']);
   header("Location: ../admin/clientes.php?successedit");
}
?>
