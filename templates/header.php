<!doctype html>
<html lang="es" data-bs-theme="light">
    <head>
        <title>Almacen de ropa</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <!-- Bootstrap CSS v5.3.8 -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
     rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
     crossorigin="anonymous">
        
    </head>

    <body>
        <header>
            <!-- place navbar here -->
             <nav class="navbar navbar-expand navbar-light bg-light">
                <ul class="nav navbar-nav">


                    <?php
                    if($_SESSION['rol'] == 'admin'):
                    ?>
                

                    <li class="nav-item">
                        <a class="nav-link" href="../admin/index.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../admin/productos.php">Gestionar inventario</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../admin/usuarios.php">Gestionar usuarios</a>
                    </li>
                                        
                    
                    <?php
                    endif;
                    ?>

                    <?php
                    if($_SESSION['rol'] == 'empleado'):
                    ?>
                

                    <li class="nav-item">
                        <a class="nav-link" href="../vendedor/index.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../vendedor/catalogo.php">Ver catalogo</a>
                    </li>
                  
                    <?php
                    endif;
                    ?>

                    <li class="nav-item">
                        <a class="nav-link" href="../logout.php">Cerrar sesión</a>
                    </li>
                    
                </ul>
             </nav>
             
        </header>
        <main class="container">



        
