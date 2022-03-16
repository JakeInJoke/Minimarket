<?php
//llamar a la base de datos
require_once '../Conexion_BD/Conexion.php';

//recuperar el valor del parametro que lega a travez de la URL
$cod_producto = $_GET["cod_producto"];
//generar sentencia sql
$sql = "SELECT p.cod_producto,p.nombre_producto,p.imagen_producto,p.cod_estado,p.cod_categoria,p.cod_marca,c.nombre_categoria,m.nombre_marca
                                FROM producto p
                                INNER JOIN categoria c
                                ON p.cod_categoria = c.cod_categoria
                                INNER JOIN marca m
                                ON p.cod_marca = m.cod_marca
                                where cod_producto=$cod_producto";
//ejecutar la sentencia y recepcionar los datos
$result = mysqli_query($conex, $sql);
if (mysqli_num_rows($result) == 0)
    header("location:/Minimarket/producto/index.php");
else
//recuperar los datos en una variable matriz
    $rows_p = mysqli_fetch_assoc($result);

//isset verificar si tiene contenido o no
//edit si se presiono el boton actualizar datos
if (isset($_POST['edit'])) {
    //leer los datos del formulario
    $cod_estado = $_POST['inputEst'];
    $cod_marca = $_POST['inputMar'];
    $cod_categoria = $_POST['inputCat'];
    $cod_producto = $_POST['inputCod'];
    $nombre_producto = $_POST['inputNom'];
    

    if (isset($_FILES['inputImg2'])) {
        $imagen_producto = toBase64($_FILES['inputImg2']);
    }
    if ($imagen_producto == 'data:image/;base64,') {
        $imagen_producto = $_POST['prevImg2'];
    }

    //sentencia para la insercion de datos a la BD
    $sql_alpha = "update producto set cod_estado='$cod_estado', cod_marca='$cod_marca',cod_categoria='$cod_categoria', nombre_producto='$nombre_producto', imagen_producto='$imagen_producto' where cod_producto=$cod_producto";
    //preparar la sentencia
    $statement = $conex->query($sql_alpha);
    //$statement->bind_param("isss", $cod_producto, $nombre_producto, $imagen_producto);
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
        <h2 style="margin-top: 50px; padding-left: 250px"> ACTUALIZAR PRODUCTO: <?php echo $rows_p['nombre_producto'] ?> </h2>

        <br><hr><br>

        <section class="container" style="margin-top: 30px">
            <div class="container mt-4 mb-4">
                <center>
                    <h2> <span class="badge badge-danger">Imagen Actual</span></h2>
                    <img class="shadow-sm" src="<?php echo $rows_p['imagen_producto'] ?>" width="400">  
                </center>
            </div>
            <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                <div class="form-group row" hidden>
                    <label class="col-sm-2 control-label"> Imagen previa </label>
                    <div class="col-sm-5">
                        <input type="text" name="prevImg2" value="<?php echo $rows_p['imagen_producto'] ?>" class="form-control" readonly="readonly">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 control-label"> Código </label>
                    <div class="col-sm-5">
                        <input type="text" name="inputCod" value="<?php echo $rows_p['cod_producto'] ?>" class="form-control" readonly="readonly">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 control-label"> Nombre </label>
                    <div class="col-sm-5">
                        <input type="text" name="inputNom" value="<?php echo $rows_p['nombre_producto'] ?>" class="form-control" placeholder="Nombre" required="">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 control-label"> Imagen </label>
                    <div class="col-sm-5">
                        <input type="file" name="inputImg2">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 control-label"> Categoria </label>
                    <div class="col-sm-5">
                        <select class="form-control" name="inputCat" required>
                            <option value="<?php echo $rows_p['cod_categoria'] ?>"><?php echo $rows_p['nombre_categoria'] ?></option>
                            <?php
                            $cat = "select * from categoria";
                            $r_cat = $conex->query($cat);
                            while ($rows_c = mysqli_fetch_array($r_cat)) {
                                ?>
                                <option value="<?php echo $rows_c['cod_categoria']; ?>"><?php echo $rows_c['nombre_categoria']; ?></option>
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
                            <option value="<?php echo $rows_p['cod_marca'] ?>"><?php echo $rows_p['nombre_marca'] ?></option>
                            <?php
                            $mar = "select * from marca";
                            $r_mar = $conex->query($mar);
                            while ($rows_m = mysqli_fetch_array($r_mar)) {
                                ?>
                                <option value="<?php echo $rows_m['cod_marca']; ?>"><?php echo $rows_m['nombre_marca']; ?></option>
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
                            <option value="<?php echo $rows_p['cod_estado'] ?>"><?php echo $rows_p['nombre_marca'] > 1 ? 'No disponible' : 'Disponible' ?></option>
                            <option value="1">Disponible</option>
                            <option value="2">No disponible</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 control-label"> </label>
                    <div class="col-sm-6">
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