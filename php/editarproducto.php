<?php
include "conexion.php";
if(isset($_POST['nombre']) &&  isset($_POST['cedula'])  &&  isset($_POST['categoria'])){

   $conexion->query("update clientes set
                       nombre='".$_POST['nombre']."',
                       cedula='".$_POST['cedula']."',
                       id_categoria=".$_POST['categoria']."
                       where id=".$_POST['id']);
   header("Location: ../admin/productos.php?successedit");
}
?>
