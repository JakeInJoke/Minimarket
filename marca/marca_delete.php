<?php
require_once '../Conexion_BD/Conexion.php';
//preguntar si se presiono el boton delete
if (isset($_GET['action']) == 'delete') {
    //recuperar el valor de la variable
    $cod_marca = $_GET['cod_marca'];
    //sentencia sql para eliminar registro
    $sql = "delete from marca where cod_marca=$cod_marca";
    //preparar la sentencia a ejecutar
    $statement = $conex->query($sql);
    //$statement->bind_param("1", $cod_marca);
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