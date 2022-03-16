<?php
//llamar a la BD
require_once '../Conexion_BD/Conexion.php';

//isset verificar si tiene contenido o no
//add si se presiono el boton agregar datos

if (isset($_POST['add'])) {
    $statement = "";
    $sql = "";
    //leer los datos del formulario
    $cod_categoria = $_POST['inputCod'];
    $nombre_categoria = $_POST['inputNomb'];
    $imagen_categoria = '';


    if (isset($_FILES['inputImg'])) {
        $imagen_categoria = toBase64($_FILES['inputImg']);
    }

    //sentencia para la insercion de datos a la BD
    $sql = "insert into categoria values(?,?,?)";
    //preparar la sentencia
    $statement = $conex->prepare($sql);
    $statement->bind_param("iss", $cod_categoria, $nombre_categoria, $imagen_categoria);
    //ejecutar la sentencia
    $statement->execute();
    $conex->close();


    //si la insercion ha sido satisfactoria
    {
        if ($statement) {
            header('location:./index.php');
        }
         else {
            echo '<div class="alert alert-danger alert-dismisible"> 
              <button type="button" class="close" data-dismiss="alert" aria-hiddes="true">&times;'
            . '</button> Error: No se pudo Guardar los cambios.' . '</div>';
        }
    }
}
?>

<html>
    <?php
    include_once '../includes/1_head.php';
    if (isset($_SESSION['rol_numero']) && $_SESSION['rol_numero'] == 10) {
        ?>
        <body>
            <?php
            include_once '../includes/header_crud.php';
            ?>
            <h2 style="margin-top: 50px; padding-left: 250px;"> AGREGAR NUEVA CATEGORIA </h2>
            <br><hr><br>

            <section class="container" style="margin-top: 30px">
                <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                    <div class="form-group row" hidden>
                        <label class="col-sm-2 control-label"> Código </label>
                        <div class="col-sm-5">
                            <input type="text" name="inputCod" class="form-control" readonly="readonly">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 control-label"> Nombre </label>
                        <div class="col-sm-5">
                            <input type="text" name="inputNomb" class="form-control" placeholder="Nombre" required="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 control-label"> Imagen </label>
                        <div class="col-sm-5 custom-file">
                            <input type="file"  name="inputImg" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 control-label"> </label>
                        <div class="col-sm-6">
                            <button type="submit" name="add" class="btn btn-primary">
                                <i class="fas fa-save" aria-hidden="true"></i> Guardar Datos
                            </button>
                            <a href="./index.php" class="btn btn-danger">
                                <i class="fa fa-ban" aria-hidden="true"></i> Cancelar 
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
        } else {
            die('Usted no cuenta con permiso para ejecutar esta acción');
        }
        ?>
    </body>
</html>
