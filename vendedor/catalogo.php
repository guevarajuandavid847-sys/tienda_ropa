<?php
session_start();

//el control de acceso
if(!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'empleado') {
    header('Location: ../index.php');
    exit();
}
require '../config/db.php';
//variable de sesión para el carrito
if(!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

if(isset($_GET['agregar'])) {
    $id = $_GET['agregar'];

    //Verificar que el producto exista y tenga stock > 1
    $stmt = $pdo->prepare("SELECT * FROM productos WHERE id = ?");
    $stmt->execute([$id]);
    $producto = $stmt->fetch();

    if($producto && $producto['stock'] > 0) {
        //Si el producto ya existe en el carrito, aumenta la cantidad
        if(isset($_SESSION['carrito'][$id])) {
            $_SESSION['carrito'][$id]['cantidad']++;
        } else {
            //Si es nuevo en el carrito
            $_SESSION['carrito'][$id] = [
                'nombre' => $producto['nombre'],
                'precio' => $producto['precio'],
                'cantidad' => 1
            ];
        }

    }
}

    
    



//consulta a la BD
$stmt = $pdo->query("SELECT * FROM `productos` WHERE stock > 0");
$productos = $stmt->fetchAll();

include '../templates/header.php';
?>

<div class="mt-5 mb-4" style="display: flex; justify-content: space-between; align-items: center;">
    <h2>Catálogo de ropa</h2>
    <a href="carrito.php" style="background: orange; padding: 10px; border-radius: 5px; text-decoration: none; color: black;">Ver carrito (<?php echo array_sum(array_column($_SESSION['carrito'], 'cantidad')); ?>)</a>
</div>



<h2 class="mt-5 mb-5 text-center">Catálogo de ropa</h2>

<div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 20px;">
    <?php foreach ($productos as $p): ?>
        
    <div style="border: 1px solid #ddd; padding: 15px; border-radius: 8px; text-align: center; background: #fff">
            <img src="../uploads/<?php echo $p['imagen'] ?>" style="width: 100%; height: 250px; object-fit: cover; border-radius: 5px;">
            <h3 style="margin: 10px 0;"><?php echo $p['nombre']; ?></h3>
            <p style="font-size: 1.2em; font-weight: bold; color: grey;">$<?php echo $p['precio']; ?></p>
            <p style="color: #666;">Disponibles: <?php echo($p['stock']); ?></p>
            <a style="display: block; background: green; color: white; padding: 10px; text-decoration: none; border-radius: 8px;" 
                href="?agregar=<?php echo $p['id']; ?>">Añadir al carrito</a>
    </div>
    <?php endforeach; ?>
</div>



<?php
include '../templates/footer.php';
?>