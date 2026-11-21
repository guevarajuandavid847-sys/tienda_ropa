<?php


require '../config/db.php';

session_start();

//el control de acceso
if(!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header('Location: ../index.php');
    exit();
}

//obtener el id del producto actual
if(!isset($_GET['id'])) {
    header('Location: productos.php');
    exit();
}

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM productos WHERE id = ?");
$stmt->execute([$id]);
$producto = $stmt->fetch();

//procesamiento de la actualizacion
if(isset($_POST['actualizar'])){
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $imagen_nombre = $_POST['imagen_actual'];
    
    //si se ha seleccionado otra imagen
    if(!empty($_FILES['imagen']['name'])) {
        if(file_exists("../uploads/" . $_POST['imagen_actual'])) {
            unlink("../uploads/" . $_POST['imagen_actual']); // Eliminar la imagen anterior del servidor
        }
        $imagen_nombre = $_FILES['imagen']['name'];
        $ruta_temporal = $_FILES['imagen']['tmp_name'];
        move_uploaded_file($ruta_temporal, "../uploads/" . $imagen_nombre);
    }

    $sql = "UPDATE productos SET nombre = ?, precio = ?, stock = ?, imagen = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nombre, $precio, $stock, $imagen_nombre, $id]);

    header('Location: productos.php');
    exit();


}
    

include '../templates/header.php';
?>

<h2 class="mt-3 text-center">Editar Producto</h2> 

<div class="card">
    <div class="card-header"></div>
    <div class="card-body">
       <form action="" method="post" enctype=multipart/form-data>

        <input type="hidden" name="imagen_actual" value="<?php echo $producto['imagen']; ?>" />
        
        
        <div class="mb-3">
            <label for="" class="form-label">Nombre</label>
            <input type="text" class="form-control" name="nombre" id="" aria-describedby="helpId" value="<?php echo $producto['nombre']; ?>" required autocomplete="off" /> 
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Precio</label>
            <input type="text" class="form-control" name="precio" id="" aria-describedby="helpId" value="<?php echo $producto['precio']; ?>" required autocomplete="off" /> 
        </div>

         <div class="mb-3">
            <label for="" class="form-label">Cantidad</label>
            <input type="text" class="form-control" name="stock" id="" aria-describedby="helpId" value="<?php echo $producto['stock']; ?>" required autocomplete="off" /> 
        </div>


        <div class="mb-3">
            <label for="" class="form-label">Imagen actual</label>
            <div>
                <img src="../uploads/<?php echo $producto['imagen']; ?>" alt="" width="100" style="border-radius: 10px;">
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Seleccionar la nueva imagen (dejar vacio para mantener la actual)</label>
            <input type="file" class="form-control" name="imagen" id="" aria-describedby="helpId" placeholder="" />
        </div>

        <div class="text-center">
            <button
                type="submit" class="btn btn-warning" name="actualizar">
                Guardar Cambios
            </button>
            <a
                name=""
                id=""
                class="btn btn-info"
                href="productos.php"
                role="button"
                >volver</a
            >
            

        </div>

        
        
        
       </form>
    </div>
    <div class="card-footer text-body-secondary"></div>
</div>


<?php
include '../templates/footer.php';
?> 