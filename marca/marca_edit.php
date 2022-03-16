<?php
//llamar a la base de datos
require_once '../Conexion_BD/Conexion.php';

//recuperar el valor del parametro que lega a travez de la URL
        $cod_marca = $_GET["cod_marca"];
        //generar sentencia sql
        $sql = "select * from marca where cod_marca=$cod_marca";
        //ejecutar la sentencia y recepcionar los datos
        $result = mysqli_query($conex, $sql);
        if (mysqli_num_rows($result) == 0)
            header("location:/Minimarket/marca/index.php");
        else
        //recuperar los datos en una variable matriz
            $rows = mysqli_fetch_assoc($result);

//isset verificar si tiene contenido o no
//edit si se presiono el boton actualizar datos
if (isset($_POST['edit'])) {
    //leer los datos del formulario
    $cod_marca = $_POST['inputCod'];
    $nombre_marca = $_POST['inputNom'];
    
    
    if (isset($_FILES['inputImg'])) {
        $imagen_marca = toBase64($_FILES['inputImg']);
    }
    if($imagen_marca=='data:image/;base64,'){
        $imagen_marca = $_POST['prevImg'];
    }
    
    //sentencia para la insercion de datos a la BD
    $sql = "update marca set nombre_marca='$nombre_marca', imagen_marca='$imagen_marca' where cod_marca='$cod_marca'";
    //preparar la sentencia
    $statement = $conex->query($sql);
    //$statement->bind_param("isss", $cod_marca, $nombre_marca, $imagen_marca);
    //ejecutar la sentencia
    //$statement->execute();
    //$conex->close();
    //si la insercion ha sidosatisfactoria
    if ($statement) {
        //mensaje de alerta
        header('location:./index.php');
    } else {
        echo '<div class="alert alert-danger alert-dismisible">'
        . '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;' . '</button> Error: No se pudo guardar los cambios.' . '</div>';
    }
}
?>

<!DOCTYPE html>

<html>
    <?php
    include_once '../includes/1_head.php';
    ?>
    <body>
        <?php
        include_once '../includes/header_crud.php';
        ?>
        <h2 style="margin-top: 50px; padding-left: 250px"> ACTUALIZAR MARCA: <?php echo $rows['nombre_marca'] ?> </h2>

        <br><hr><br>

        <section class="container" style="margin-top: 30px">
            <div class="container mt-4 mb-4">
                <center>
                    <h2> <span class="badge badge-danger">Imagen Actual</span></h2>
                    <img class="shadow-sm" src="<?php echo $rows['imagen_marca'] ?>" width="400">  
                </center>
            </div>
            <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                <div class="form-group row" hidden>
                    <label class="col-sm-2 control-label"> Imagen previa </label>
                    <div class="col-sm-5">
                        <input type="text" name="prevImg" value="<?php echo $rows['imagen_marca'] ?>" class="form-control" readonly="readonly">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 control-label"> Código </label>
                    <div class="col-sm-5">
                        <input type="text" name="inputCod" value="<?php echo $rows['cod_marca'] ?>" class="form-control" readonly="readonly">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 control-label"> Nombre </label>
                    <div class="col-sm-5">
                        <input type="text" name="inputNom" value="<?php echo $rows['nombre_marca'] ?>" class="form-control" placeholder="Nombre" required="">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 control-label"> Imagen </label>
                    <div class="col-sm-5">
                        <input type="file" name="inputImg">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 control-label"> </label>
                    <div class="col-sm-5">
                        <button type="submit" name="edit" class="btn btn-primary">
                            <i class="fas fa-save" aria-hidden="true"> </i> Actualizar Datos
                        </button>
                        <a href="./index.php" class="btn btn-danger">
                            <i class="fa fa-ban" aria-hidden="true"> </i> Cancelar
                        </a>
                    </div>
                </div>
            </form>
        </section>

        <?php
        include_once '../includes/js.php';
        ?>        
        <?php
        include_once '../includes/footer_login.php';
        ?>
    </body>
</html>