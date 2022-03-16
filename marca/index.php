<?php
//llamar a la BD
require_once '../Conexion_BD/Conexion.php';
//sentencia SQL
$sql = "select * from marca";
//ejecutar la consulta
//$result = mysqli_query($conex, $sql);
$result = $conex->query($sql);
?>

<!DOCTYPE html>

<html>
    <?php
    $pagina = 'marca';
    include_once '../includes/1_head.php';
    ?>
    <body>
        <?php
        include_once '../includes/2_header.php';
        ?>

        <section>
            <div class="bg-danger  text-white p-4 text-center">
                <h2 class="m-0">MARCAS</h2>  
            </div>
            <div class="pt-3 pr-3 pl-3">
                <?php
                $count = 0;
                while ($rows = mysqli_fetch_array($result)) {
                    $count++;
                }
                echo '<h5 class="m-0">Total de marcas: <span class="badge badge-danger">' . $count . '</span></h5>';
                ?>
            </div>

            <hr>
            <div class="d-flex">
                <div class="row w-100 p-3"> 
                    <div class="<?php echo!isset($_SESSION['_minilog']) || $_SESSION['rol_numero'] != 10 ? 'col-12' : 'col-6'; ?> text-center">
                        <h4 class="m-0">MARCAS EN SISTEMA</h4>
                    </div>
                    <?php
                    ?>
                    <?php
                    if (isset($_SESSION['_minilog']) && $_SESSION['rol_numero'] == 10) {
                        ?>
                        <div class="col-6 text-center">
                            <a href="./marca_add.php" class="btn btn-danger"><i class="fas fa-plus-square"></i> Agregar</a>
                        </div> 
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="container mt-3">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Imágen</th>
                            <?php
                            if (isset($_SESSION['_minilog']) && $_SESSION['rol_numero'] == 10) {
                                ?>  
                                <th>Opciones</th>
                                <?php
                            }
                            ?>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        //llamar a la BD
                        require_once '../Conexion_BD/Conexion.php';
//sentencia SQL
                        $sql = "select * from marca";
//ejecutar la consulta
//$result = mysqli_query($conex, $sql);
                        $r = $conex->query($sql);

                        while ($rows = mysqli_fetch_array($r)) {
                            ?>
                        <tr>

                                <td class="align-middle"><?php echo $rows["cod_marca"]; ?></td>
                                <td class="align-middle"><?php echo $rows["nombre_marca"]; ?></td>
                                <td class="align-middle"><center><?php echo '<img class="shadow-sm" src="' . $rows["imagen_marca"] . '" width=200>'; ?></center></td>
                        <?php
                            if (isset($_SESSION['_minilog']) && $_SESSION['rol_numero'] == 10) {
                                ?>  
                                <td class="align-middle"><a href="./marca_edit.php?cod_marca=<?php echo $rows["cod_marca"];?>" class="btn btn-info"><i class="fas fa-pencil-alt"></i> </a>
                                    <a href="./marca_delete.php?action=delete&cod_marca=<?php echo $rows["cod_marca"];?>" 
                                   onclick="return confirm('Confirma querer eliminar: <?php echo $rows["nombre_marca"]?>')" class="btn btn-danger"><i class="fa fa-trash"></i> </a></td>
                                <?php
                            }
                            ?>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table> 
            </div>




        </section>

        <?php
        include_once '../includes/js.php';
        ?>
        <?php
        include_once '../includes/3_footer.php';
        ?>
    </body>
</html>
