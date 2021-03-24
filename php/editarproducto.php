<?php
include "conexion.php";
if(isset($_POST['nombre']) &&  isset($_POST['cedula'])   &&  isset($_POST['categoria'])){


    if($_FILES['imagen']['name'] !='' ){
        $carpeta="../images/";
        $nombre = $_FILES['imagen']['name'];
            //imagen.casa.jpg
        $temp= explode( '.' ,$nombre);
        $extension= end($temp);

        $nombreFinal = time().'.'.$extension;

        if($extension=='jpg' || $extension == 'png'){
            if(move_uploaded_file($_FILES['imagen']['tmp_name'], $carpeta.$nombreFinal)){
                $fila = $conexion->query('select imagen  from clientes where id='.$_POST['id']);
                $id = mysqli_fetch_row($fila);
                if(file_exists('../images/'.$id[0])){
                    unlink('../images/'.$id[0]);
                }
                $conexion->query("update clientes set imagen='".$nombreFinal."' where id=".$_POST['id']);
            }

        }//llave tipo archivo
    }    //llave si no esta vacio

    $conexion->query("update clientes set
                        nombre='".$_POST['nombre']."',
                        cedula='".$_POST['cedula']."',
                        id_categoria=".$_POST['categoria'].",
                        where id=".$_POST['id']);
    header("Location: ../admin/productos.php?success");
}
?>
