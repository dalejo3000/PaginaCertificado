<?php
session_start();
include './php/conexion.php';
if(!isset($_SESSION['carrito2'])){header("Location: ./index.php");}
$arreglo  = $_SESSION['carrito2'];
$total= 0;
for($i=0; $i<count($arreglo);$i++){
  $total = $total+($arreglo[$i]['Precio'] * $arreglo[$i]['Cantidad']);
}
$password="";
if(isset($_POST['c_account_password'])){
    if($_POST['c_account_password']!=""){
        $password = $_POST['c_account_password'];
    }
}
$conexion->query("insert into usuario (nombre,telefono,email,password,img_perfil,nivel,cedula,fecha,curso)
  values(
    '".$_POST['c_fname']." ".$_POST['c_lname']."',
    '".$_POST['c_phone']."',
    '".$_POST['c_email_address']."',
    '".sha1($password)."',
    'default.jpg',
    'cliente',
    '".$_POST['c_cedula']."',
    '".$_POST['c_fecha']."',
    '".$_POST['c_curso']."'
        )
")or die($conexion->error);
header("Location: ./admin/clientes.php?success");
$id_usuario = $conexion->insert_id;

$fecha = date('Y-m-d h:m:s');
$conexion -> query("insert into ventas(id_usuario,total,fecha) values($id_usuario,$total,'$fecha')")or die($conexion->error);
$id_venta = $conexion ->insert_id;


unset($_SESSION['carrito']);
?>
