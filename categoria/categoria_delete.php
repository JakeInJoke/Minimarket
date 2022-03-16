<?php
require_once '../Conexion_BD/Conexion.php';
//preguntar si se presiono el boton delete
if (isset($_GET['action']) == 'delete') {
    //recuperar el valor de la variable
    $cod_categoria = $_GET['cod_categoria'];
    //sentencia sql para eliminar registro
    $sql = "delete from categoria where cod_categoria=$cod_categoria";
    //preparar la sentencia a ejecutar
    $statement = $conex->query($sql);
    //$statement->bind_param("1", $cod_categoria);
    //$statement->execute();
    //$conex->close();
    if ($statement) {
            header('location:./index.php');
        }
    else{
        print('Error al eliminar un registro');
    }
}
?>