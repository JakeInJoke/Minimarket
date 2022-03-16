<html>
    <?php
    include_once './includes/1_head.php';
    ?>
    <body>

        <div class="d-flex flex-column h-100">
<?php
include_once './includes/header_login.php';
?>
            <div class="position-relative d-flex flex-grow-1">
                <div class="m-auto w-auto h-auto bg-light p-4 shadow-sm">
                    <form class="w-auto" action="Conexion_BD/validar.php" method="post">
                        <div class="container">
                            <div class="col">
                                <div class="col-6-sm-3 mt-4">
                                    <label class="font-weight-bold text-danger">Usuario</label>   
                                </div>
                                <div class="col-6-sm-3">
                                    <input class="form-control" type="text" name="txtUsuario" placeholder="Ingrese su Usuario">   
                                </div>

                                <div class="w-100 mt-4"></div>

                                <div class="col-6-sm-3">
                                    <label class="font-weight-bold text-danger">Contraseña</label>   
                                </div>
                                <div class="col-6-sm-3">
                                    <input class="form-control" type="text" name="txtContraseña" placeholder="Ingrese su Contraseña">   
                                </div>

                                <div class="w-100 mt-4"></div>
                                <div class="row mb-3">
                                    <div class="col-6 d-flex">
                                        <input class="w-100 btn btn-outline-info" type="submit" name="btnEnviar" value="Continuar">   
                                    </div>
                                    <div class="col-6 d-flex">
                                        <a href="index.php" class="w-100 btn btn-outline-danger" name="btnCancelar"> Cancelar </a>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </form>   
                </div> 
            </div>
<?php
include_once './includes/footer_login.php';
?>
        </div>




<?php
include_once './includes/js.php';
?>


    </body>
</html>