<?php


require '../config/db.php';

session_start();

//el control de acceso
if(!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header('Location: ../index.php');
    exit();
}

//procesamiento del guardado
if(isset($_POST['agregar'])) {
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    //procesamiento de la imagen
    $nombre_imagen = $_FILES['imagen']['name']; 
    $ruta_temporal = $_FILES['imagen']['tmp_name'];
    $carpeta_destino =   "../uploads/" . $nombre_imagen;

    //mover la imagen a la carpeta de destino
    if(move_uploaded_file($ruta_temporal, $carpeta_destino)) {
        // Imagen guardada correctamente
        $stmt = $pdo->prepare("INSERT INTO productos (nombre, precio, stock, imagen) VALUES (?, ?, ?, ?)");
        $stmt->execute([$nombre, $precio, $stock, $nombre_imagen]); 
        header('Location: productos.php');
        
    }
}

//procesamiento de eliminacion 
if(isset($_GET['eliminar'])) {
    $id = $_GET['eliminar'];
    //Buscar la imagen de la BD
    $stmt = $pdo->prepare("SELECT imagen FROM productos WHERE id = ?");
    $stmt->execute([$id]);
    $producto = $stmt->fetch();
    if($producto) {
        unlink("../uploads/" . $producto['imagen']); // Eliminar la imagen del servidor
        $stmt = $pdo->prepare("DELETE FROM productos WHERE id = ?");
        $stmt->execute([$id]);
    }
    header('Location: productos.php');
}

//consulta de registros
$stmt = $pdo->query("SELECT * FROM `productos`");
$productos = $stmt->fetchAll();



include '../templates/header.php';
?>



<h2 class="mt-4 mb-4 text-center">Gestion de inventario de ropa</h2>

<div class="card">
    <div class="card-header"><strong>Agregar nueva prenda</strong></div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="" class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="nombre" id="" aria-describedby="helpId"
                        placeholder="Digite el nombre de la prenda" autocomplete="off" required />
                </div>
                <div class="col-md-3 mb-3">
                    <label for="" class="form-label">Precio</label>
                    <input type="number" class="form-control" name="precio" id="" aria-describedby="helpId"
                        placeholder="Digite el precio de la prenda" autocomplete="off" required />
                </div>
                <div class="col-md-3 mb-3">
                    <label for="" class="form-label">Stock</label>
                    <input type="number" class="form-control" name="stock" id="" aria-describedby="helpId"
                        placeholder="Digite la cantidad de stock inicial" autocomplete="off" required />
                </div>
                <div class="col-md-3 mb-3">
                    <label for="" class="form-label">Imagen:</label>
                    <input type="file" class="form-control" name="imagen" id="" aria-describedby="helpId" placeholder=""
                        required />
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary" name="agregar">
                        Guardar en el almacén
                    </button>
                </div>>
        </form>
    </div>
    <div class="card-footer text-body-secondary"></div>
</div>


<hr>

<h3>Listado de productos</h3>
<div class="table-responsive">
    <table class="table table table-bordered table-hover align-middle" style="text-align: center;">
    
        <thead>
            <tr>
                <th>Imagen</th>
                <th>Producto</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productos as $p): ?>
            <tr>
               <td><img src="../uploads/<?php echo $p['imagen']; ?>" width="50"></td>
               <td><?php echo $p['nombre']; ?></td>
               <td><?php echo $p['precio']; ?></td>
               <td><?php echo $p['stock']; ?></td>
               <td>
                    <a
                        name=""
                        id=""
                        class="btn btn-success"
                        href="editar_productos.php?id=<?php echo $p['id']; ?>"
                        role="button"
                        >Editar</a
                    >
                    <a
                        name=""
                        id=""
                        class="btn btn-danger"
                        href="?eliminar=<?php echo $p['id']; ?>"
                        role="button"
                        >Eliminar</a
                    >
                    
                    
                    
            </tr>
            <?php endforeach;  ?>
        </tbody>
    </table>
</div>




<?php
include '../templates/footer.php';
?>