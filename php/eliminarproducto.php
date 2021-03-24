<?php
include "./conexion.php";

$fila = $conexion->query('select imagen  from clientes where id='.$_POST['id']);
$id = mysqli_fetch_row($fila);
if(file_exists('../images/'.$id[0])){
    unlink('../images/'.$id[0]);
}
$conexion->query("delete from clientes where id=".$_POST['id']);
echo 'listo';

?>
