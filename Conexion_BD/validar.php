<?php
include_once './Conexion.php';

$usu=$_POST["txtUsuario"];
$pass=$_POST["txtContraseña"];

$sql="select * from empleado "
        . "where dni='$usu' "
        . "and password='$pass'";

$result=$conex->query($sql);
$resultF = $result->fetch_assoc();
$rol = $resultF['cod_rol_empleado'];

$sql2="select nombre_rol from rol "
        . "where cod_rol_empleado='$rol'";

$result2=$conex->query($sql2);
$rolname =$result2->fetch_assoc();
if($result->num_rows==1){
    session_start ();
    $_SESSION['rol']=$rolname['nombre_rol'];
    $_SESSION['rol_numero']=$resultF['cod_rol_empleado'];
    $_SESSION['user_data']= $resultF;
    $_SESSION['_minilog']='log';
    header('location:../index.php');
}else{
header('location:../login.php');}



