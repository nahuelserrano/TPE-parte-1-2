<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['archivo'])) {
    $nombreArchivo = $_FILES['archivo']['name'];
    $archivoTemporal = $_FILES['archivo']['tmp_name'];
    $destino = "uploads/" . $nombreArchivo;

    // Crear la carpeta uploads si no existe
    if (!is_dir('uploads')) {
        mkdir('uploads', 0777, true);
    }

    // Mover el archivo a la carpeta uploads
    if (move_uploaded_file($archivoTemporal, $destino)) {
        echo "Archivo subido exitosamente: <a href='$destino'>$nombreArchivo</a>";
    } else {
        echo "Error al subir el archivo.";
    }
} else {
    echo "No se recibió ningún archivo.";
}
?>
