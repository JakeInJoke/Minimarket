<?php
//llamar a la BD
require_once '../Conexion_BD/Conexion.php';
//sentencia SQL
$sql = "SELECT e.cod_empleado,e.nombre_empleado,e.apellidop_empleado,e.apellidom_empleado,e.telefono,e.direccion_empleado,r.nombre_rol,c.nombre_contrato
        FROM empleado e
        INNER JOIN rol r
        ON e.cod_rol_empleado = r.cod_rol_empleado
        INNER JOIN tipo_contrato c
        ON e.cod_tipo_contrato = c.cod_tipo_contrato
        ORDER BY e.cod_empleado ASC";
//ejecutar la consulta
//$result = mysqli_query($conex, $sql);
$result = $conex->query($sql);
?>

<!DOCTYPE html>

<html>
<?php
$pagina = 'personal';
include_once '../includes/1_head.php';
?>

<body>
    <?php
    include_once '../includes/2_header.php';
    if (isset($_SESSION['rol_numero']) && $_SESSION['rol_numero'] == 10) {
    ?>

        <section>
            <div class="bg-danger  text-white p-4 text-center">
                <h2 class="m-0">PERSONAL</h2>
            </div>
            <div class="pt-3 pr-3 pl-3">
                <?php
                $count = 0;
                while ($rows = mysqli_fetch_array($result)) {
                    $count++;
                }
                echo '<h5 class="m-0">Personal: <span class="badge badge-danger">' . $count . '</span></h5>';
                ?>
            </div>

            <hr>
            <div class="d-flex">
                <div class="row w-100 p-3">
                    <div class=" col-12 text-center">
                        <h4 class="m-0">PERSONAL EN SISTEMA</h4>
                        <a href="personal_report.php" target="_blank" class="btn btn-danger m-5"> Obtener datos del personal </a>
                    </div>
                </div>
            </div>
            <div class="container mt-3 mb-5">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Telefono</th>
                            <th>Rol</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        //llamar a la BD
                        require_once '../Conexion_BD/Conexion.php';
                        //sentencia SQL
                        $sql = "SELECT e.cod_empleado,e.nombre_empleado,e.apellidop_empleado,e.apellidom_empleado,e.telefono,e.direccion_empleado,r.nombre_rol,c.nombre_contrato
                                FROM empleado e
                                INNER JOIN rol r
                                ON e.cod_rol_empleado = r.cod_rol_empleado
                                INNER JOIN tipo_contrato c
                                ON e.cod_tipo_contrato = c.cod_tipo_contrato
                                ORDER BY e.cod_empleado ASC";
                        //ejecutar la consulta
                        //$result = mysqli_query($conex, $sql);
                        $r = $conex->query($sql);

                        while ($rows = mysqli_fetch_array($r)) {
                        ?>
                            <tr>

                                <td><?php echo $rows["cod_empleado"]; ?></td>
                                <td><?php echo $rows["nombre_empleado"]; ?></td>
                                <td><?php echo $rows["apellidop_empleado"] . ' ' . $rows["apellidom_empleado"]; ?></td>
                                <td><?php echo $rows["telefono"]; ?></td>
                                <td><?php echo $rows["nombre_rol"]; ?></td>
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
    } else {
        die('Usted no cuenta con permiso para ingresar a esta Seccion');
    }
    ?>
</body>

</html>