<header id="navo">
    <div class="bor-bot bg-danger">
        <div class="container-lg font-weight-bold">
            <nav class="navbar navbar-light d-flex p-0">
                <a class="h-100 text-white text-decoration-none bor-rig pr-3 pt-4 pb-4"> <i class="fas fa-phone-alt text-white"></i> (+51) 902-002-069</a>
                <div class="form-inline m-0">
                    <div class="h-100 mr-sm-2 text-white d-flex">
                        <?php
                        if (isset($_SESSION['user_data'])) {
                            echo $_SESSION['user_data']['nombre_empleado'] . ' ' . $_SESSION['user_data']['apellidop_empleado'] . '(' . $_SESSION['rol'] . ')';
                        }
                        ?>
                    </div>
                    <?php
                    if (!isset($_SESSION['_minilog'])) {
                    ?>
                        <a href="/Minimarket/login.php" class="h-100 bor-lef text-white text-decoration-none bor-rig pr-3 pl-3 pt-4 pb-4"> <i class="fas fa-sign-in-alt text-white-50 mr-2"></i> INICIAR SESION</a>
                    <?php
                    } else {
                    ?>
                        <a href="/Minimarket/cerrar_sesion.php" class="h-100 bor-lef text-white text-decoration-none bor-rig pr-3 pl-3 pt-4 pb-4"> <i class="fas fa-sign-out-alt text-white-50 mr-2"></i> CERRAR SESION</a>
                    <?php
                    }
                    ?>
                </div>
            </nav>
        </div>
    </div>
    <div>
        <div class="container-lg font-weight-bold">
            <nav class="navbar navbar-expand-lg navbar-light">
                <a class="navbar-brand" href="/Minimarket/index.php"> <i class="text-danger">M - MARKET</i> </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse flex-row-reverse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item <?php echo $pagina == 'index' ? 'active' : ''; ?>">
                            <a class="nav-link" href="/Minimarket/index.php"><i class="fas fa-home"></i> INICIO<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item <?php echo $pagina == 'producto' ? 'active' : ''; ?>">
                            <a class="nav-link" href="/Minimarket/producto/index.php"><i class="fas fa-shopping-bag"></i> PRODUCTO</a>
                        </li>

                        <?php
                        if (!isset($_SESSION['_minilog'])) {
                        ?>

                        <?php
                        } else {
                        ?>
                            <li class="nav-item <?php echo $pagina == 'categoria' ? 'active' : ''; ?>">
                                <a class="nav-link" href="/Minimarket/categoria/index.php"><i class="fas fa-cookie"></i> CATEGORIA</a>
                            </li>
                            <li class="nav-item <?php echo $pagina == 'marca' ? 'active' : ''; ?>">
                                <a class="nav-link" href="/Minimarket/marca/index.php"><i class="fas fa-copyright"></i> MARCA</a>
                            </li>
                            <?php
                            if ($_SESSION['rol_numero'] == 10) {
                            ?>
                                <li class="nav-item <?php echo $pagina == 'personal' ? 'active' : ''; ?>">
                                    <a class="nav-link" href="/Minimarket/personal/index.php"><i class="fas fa-address-card"></i> PERSONAL</a>
                                </li>
                            <?php
                            }
                            ?>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </nav>
        </div>
    </div>

</header>