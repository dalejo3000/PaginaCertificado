<?php
include "conexion.php";
if(isset($_POST['nombre']) &&  isset($_POST['descripcion'])  &&  isset($_POST['duracion'])  &&  isset($_POST['fecha_inicio'])){

   $conexion->query("update cursos set
                       nombre='".$_POST['nombre']."',
                       descripcion='".$_POST['descripcion']."',
                       duracion=".$_POST['duracion'].",
                       fecha_inicio=".$_POST['fecha_inicio']."
                       where id=".$_POST['id']);
   header("Location: ../admin/cursos.php?successedit");
}
?>
