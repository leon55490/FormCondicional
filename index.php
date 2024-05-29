<!DOCTYPE html>
<html lang="en">

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
            margin: 0;
            font-family: Arial, sans-serif;
            text-align: center;
            font-size: 18px;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .animals,
        .sizes {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-bottom: 30px;
        }

        label {
            cursor: pointer;
            padding-bottom: 20px;
            margin-right: 30px;
            margin-left: 30px;
            font-size: 20px;
        }

        input[type="radio"] {
            display: none;
        }

        input[type="radio"]:checked+label {
            border: 3px solid #eb8915;
            padding: 10px;
        }

        .cantidad_gatos {
            margin-bottom: 20px;
            font-size: 18px;
            padding: 10px;
        }

        input[type="text"] {
            border: none;
            border-bottom: 6px dashed #003546;
            font-size: 24px;
            text-align: center;
            margin-top: 10px;
            margin-bottom: 30px;
            outline: none;
        }

        input[type="number"] {
            border: none;
            border-bottom: 2px dashed #003546;
            font-size: 24px;
            text-align: center;
            margin-top: 10px;
            margin-bottom: 30px;
            outline: none;
        }

        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .boton_form {
            background-color: #003546;
            border: none;
            color: white;
            padding: 20px 40px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 18px;
            font-weight: 900;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 100px;
            transition: background-color 0.3s, color 0.3s;
        }

        .boton_form:hover {
            background-color: #005f6b;
            color: #ffffff;
        }

        .titulo {
            color: #eb8915;
            font-size: 35px;
            font-weight: 900;
        }

        .animals img,
        .sizes img {
            width: 150px;
            height: auto;
        }

        .nombreDueño,
        .nombreMascota {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            flex-direction: row-reverse;
            color: #eb8915;
            font-size: 30px;
            font-weight: 900;
        }

        .nombreDueñoInput,
        .nombreMascotaInput {
            color: #003546;
            font-size: 30px;
            font-weight: 600;
        }
    </style>
</head>

<body>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['nombre_dueño']) && isset($_POST['nombre_mascota'])) {
            // Formulario completado
            $nombre_dueño = $_POST['nombre_dueño'];
            $nombre_mascota = $_POST['nombre_mascota'];

            echo '<h1>Formulario llenado con éxito</h1>';
        } elseif (isset($_POST['animal'])) {
            $animal = $_POST['animal'];

            if ($animal == 'perro' && !isset($_POST['tamaño'])) {
                echo '<div class="container">';
                echo '<h1 class="titulo">What is the size of your dog?</h1>';
                echo '<form action="index.php" method="POST">';
                echo '<div class="sizes">';
                echo '<input type="radio" id="pequeño" name="tamaño" value="pequeño">';
                echo '<label for="pequeño"><img src="/img/small.png" alt="Perro Pequeño"></label>';
                echo '<input type="radio" id="mediano" name="tamaño" value="mediano">';
                echo '<label for="mediano"><img src="/img/mediano.png" alt="Perro Mediano"></label>';
                echo '<input type="radio" id="grande" name="tamaño" value="grande">';
                echo '<label for="grande"><img src="/img/big.png" alt="Perro Grande"></label>';
                echo '</div>';
                echo '<input type="submit" class="boton_form" value="Send">';
                echo '<input type="hidden" name="animal" value="perro">';
                echo '</form>';
                echo '</div>';
            } elseif ($animal == 'gato' && !isset($_POST['cantidad_gatos'])) {
                echo '<div class="container">';
                echo '<h1 class="titulo">How many cats do you have?</h1>';
                echo '<img src="/img/gato.png" alt="" style="width:180px; margin-bottom: 20px;">'; // Imagen añadida
                echo '<form action="index.php" method="POST">';
                echo '<input type="number" id="cantidad_gatos" class="cantidad_gatos" name="cantidad_gatos" min="1" max="10"><br>';
                echo '<input type="submit" class="boton_form" value="Send">';
                echo '<input type="hidden" name="animal" value="gato">';
                echo '</form>';
                echo '</div>';
            } elseif (isset($_POST['tamaño']) || isset($_POST['cantidad_gatos'])) {
                echo '<div class="container">';
                echo '<h1 class="titulo">Almost finished, </h1>';
                echo '<form action="index.php" method="POST">';
                echo '<label for="nombre_dueño" class="nombreDueño">what´s your name?</label><br>';
                echo '<div class="nombreDueñoInput"><span>My name is</span>';
                echo '<input type="text" id="nombre_dueño" name="nombre_dueño" required></div>';
                echo '<label for="nombre_dueño" class="nombreDueño">And your pet´s?</label><br>';
                echo '<div class="nombreMascotaInput"><span>She is or He is</span>';
                echo '<input type="text" id="nombre_mascota" name="nombre_mascota" required></div>';
                echo '<input type="submit" class="boton_form" value="Send">';
                echo '<input type="hidden" name="animal" value="' . $animal . '">';
                if (isset($_POST['tamaño'])) {
                    echo '<input type="hidden" name="tamaño" value="' . $_POST['tamaño'] . '">';
                } elseif (isset($_POST['cantidad_gatos'])) {
                    echo '<input type="hidden" name="cantidad_gatos" value="' . $_POST['cantidad_gatos'] . '">';
                }
                echo '</form>';
                echo '</div>';
            }
        }
    } else {
        // Mostrar el formulario inicial
        echo '<div class="container">';
        echo '<h1 class="titulo">Do you have a dog or a cat?</h1>';
        echo '<form action="index.php" method="POST">';
        echo '<div class="animals">';
        echo '<input type="radio" id="perro" name="animal" value="perro">';
        echo '<label for="perro"><img src="/img/perro.png" alt="Perro"></label>';
        echo '<input type="radio" id="gato" name="animal" value="gato">';
        echo '<label for="gato"><img src="/img/gato.png" alt="Gato"></label>';
        echo '</div>';
        echo '<input type="submit" class="boton_form" value="Enviar">';
        echo '</form>';
        echo '</div>';
    }
    ?>
</body>

</html>