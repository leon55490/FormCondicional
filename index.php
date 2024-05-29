<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Condicional</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            /* Ensure the body takes at least the full viewport height */
            margin: 0;
            font-family: Arial, sans-serif;
            /* Optional: Set a default font */
        }
    </style>
</head>


<body>
    <?php
    // Verificar si el formulario fue enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['nombre_dueño']) && isset($_POST['nombre_mascota'])) {
            // Formulario completado
            $nombre_dueño = $_POST['nombre_dueño'];
            $nombre_mascota = $_POST['nombre_mascota'];

            echo '<h1>Formulario llenado con éxito</h1>';
            echo '<p>¡Gracias por completar el formulario!</p>';
            // echo '<p>Nombre del dueño: ' . htmlspecialchars($nombre_dueño) . '</p>';
            // echo '<p>Nombre de la mascota: ' . htmlspecialchars($nombre_mascota) . '</p>';
            // echo '<a href="index.php">Volver al inicio</a>';
        } elseif (isset($_POST['animal'])) {
            $animal = $_POST['animal'];

            if ($animal == 'perro' && !isset($_POST['tamaño'])) {
                echo '<h1>Pregunta 2: Tamaño del perro</h1>';
                echo '<form action="index.php" method="POST">';
                echo '<label for="tamaño">¿Qué tamaño tiene tu perro?</label><br>';
                echo '<input type="radio" id="pequeño" name="tamaño" value="pequeño">';
                echo '<label for="pequeño"><img src="pequeño.jpg" alt="Perro Pequeño" style="width:100px;"></label><br>';
                echo '<input type="radio" id="mediano" name="tamaño" value="mediano">';
                echo '<label for="mediano"><img src="mediano.jpg" alt="Perro Mediano" style="width:100px;"></label><br>';
                echo '<input type="radio" id="grande" name="tamaño" value="grande">';
                echo '<label for="grande"><img src="grande.jpg" alt="Perro Grande" style="width:100px;"></label><br>';
                echo '<input type="submit" value="Enviar">';
                echo '<input type="hidden" name="animal" value="perro">';
                echo '</form>';
            } elseif ($animal == 'gato' && !isset($_POST['cantidad_gatos'])) {
                echo '<h1>Pregunta 2: Cantidad de gatos</h1>';
                echo '<form action="index.php" method="POST">';
                echo '<label for="cantidad_gatos">¿Cuántos gatos tienes?</label><br>';
                echo '<input type="number" id="cantidad_gatos" name="cantidad_gatos" min="1" max="10"><br>';
                echo '<input type="submit" value="Enviar">';
                echo '<input type="hidden" name="animal" value="gato">';
                echo '</form>';
            } elseif (isset($_POST['tamaño']) || isset($_POST['cantidad_gatos'])) {
                echo '<h1>Pregunta 3: Información del dueño y la mascota</h1>';
                echo '<form action="index.php" method="POST">';
                echo '<label for="nombre_dueño">Nombre del dueño:</label><br>';
                echo '<input type="text" id="nombre_dueño" name="nombre_dueño" required><br>';
                echo '<label for="nombre_mascota">Nombre de la mascota:</label><br>';
                echo '<input type="text" id="nombre_mascota" name="nombre_mascota" required><br>';
                echo '<input type="submit" value="Enviar">';
                echo '<input type="hidden" name="animal" value="' . $animal . '">';
                if (isset($_POST['tamaño'])) {
                    echo '<input type="hidden" name="tamaño" value="' . $_POST['tamaño'] . '">';
                } elseif (isset($_POST['cantidad_gatos'])) {
                    echo '<input type="hidden" name="cantidad_gatos" value="' . $_POST['cantidad_gatos'] . '">';
                }
                echo '</form>';
            }
        }
    } else {
        // Mostrar el formulario inicial
        echo '<h1>Do you have a dog or a cat?</h1>';
        echo '<form action="index.php" method="POST">';
        echo '<input type="radio" id="perro" name="animal" value="perro">';
        echo '<label for="perro"><img src="/img/perro.png" alt="Perro" style="width:100px;"></label><br>';
        echo '<input type="radio" id="gato" name="animal" value="gato">';
        echo '<label for="gato"><img src="/img/gato.png" alt="Gato" style="width:100px;"></label><br>';
        echo '<input type="submit" value="Enviar">';
        echo '</form>';
    }
    ?>
</body>

</html>