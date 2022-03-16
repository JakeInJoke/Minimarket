<?php
//llamar a la BD
require_once '../Conexion_BD/Conexion.php';

//isset verificar si tiene contenido o no
//add si se presiono el boton agregar datos

if (isset($_POST['add'])) {
    $statement = "";
    $sql = "";
    //leer los datos del formulario
    $cod_estado= $_POST['inputEst'];
    $cod_marca= $_POST['inputMar'];
    $cod_categoria= $_POST['inputCat'];
    $cod_producto = $_POST['inputCod'];
    $nombre_producto = $_POST['inputNomb'];
    $imagen_producto = '';


    if (isset($_FILES['inputImg'])) {
        $imagen_producto = toBase64($_FILES['inputImg']);
    }
    if($imagen_producto=='data:image/;base64,'){
        $imagen_producto = '';
    }

    //sentencia para la insercion de datos a la BD
    $sql = "insert into producto values(?,?,?,?,?,?)";
    //preparar la sentencia
    $statement = $conex->prepare($sql);
    $statement->bind_param("iiiiss", $cod_estado, $cod_marca, $cod_categoria,$cod_producto,$nombre_producto,$imagen_producto);
    //ejecutar la sentencia
    $statement->execute();
    $conex->close();


    //si la insercion ha sido satisfactoria
    {
        if ($statement) {
            header('location:./index.php');
        } else {
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
            <h2 style="margin-top: 50px; padding-left: 250px;"> AGREGAR NUEVO PRODUCTO </h2>
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
                            <input type="file"  name="inputImg">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 control-label"> Categoria </label>
                        <div class="col-sm-5">
                            <select class="form-control" name="inputCat" required>
                                <option value="">Escoge una categoria</option>
                                <?php
                                $cat = "select * from categoria";
                                $r_cat = $conex->query($cat);
                                while ($rows = mysqli_fetch_array($r_cat)) {
                                ?>
                                <option value="<?php echo $rows['cod_categoria'];?>"><?php echo $rows['nombre_categoria'];?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 control-label"> Marca </label>
                        <div class="col-sm-5">
                            <select class="form-control" name="inputMar" required>
                                <option value="">Escoge una marca</option>
                                <?php
                                $mar = "select * from marca";
                                $r_mar = $conex->query($mar);
                                while ($rows = mysqli_fetch_array($r_mar)) {
                                ?>
                                <option value="<?php echo $rows['cod_marca'];?>"><?php echo $rows['nombre_marca'];?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 control-label"> Estado </label>
                        <div class="col-sm-5">
                            <select class="form-control" name="inputEst" required>
                                <option value="">Escoge un estado</option>
                                <option value="1">Disponible</option>
                                <option value="2">No disponible</option>
                            </select>
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
