<?php

// var_dump($_POST);
// Constantes
define('TARGET', 'img/');    // Repertoire cible
define('MAX_SIZE', 2 * 1000 * 1000);    // Taille max en octets du fichier
define('WIDTH_MAX', 80000);    // Largeur max de l'image en pixels
define('HEIGHT_MAX', 80000);    // Hauteur max de l'image en pixels

// Tableaux de donnees
$tabExt = array('jpg', 'gif', 'png', 'jpeg');    // Extensions autorisees
$infosImg = array();

// Variables
$extension = '';
$message = '';
$nomImage = '';


/************************************************************
 * Creation du repertoire cible si inexistant
 *************************************************************/
if (!is_dir(TARGET)) {
    if (!mkdir(TARGET, 0755)) {
        exit('Erreur : le répertoire cible ne peut-être créé ! Vérifiez que vous diposiez des droits suffisants pour le faire ou créez le manuellement !');
    }
}

/************************************************************
 * Script d'upload
 *************************************************************/
// var_dump($_FILES);

if (!empty($_POST)) {
    $fileName = $_FILES['fichier']['name'];
    $fileTemp = $_FILES['fichier']['tmp_name'];
    $fileError = $_FILES['fichier']['error'];
    $filesize = $_FILES['fichier']['size'];

    // On verifie si le champ est rempli
    if (!empty($fileTemp)) {
        // Recuperation de l'extension du fichier
        $extension  = pathinfo($fileName, PATHINFO_EXTENSION);

        // On verifie l'extension du fichier
        if (in_array(strtolower($extension), $tabExt)) {
            // On recupere les dimensions du fichier
            $infosImg = getimagesize($fileTemp);

            // On verifie le type de l'image
            if ($infosImg[2] >= 1 && $infosImg[2] <= 14) {
                // On verifie les dimensions et taille de l'image
                if ((filesize($fileTemp) <= MAX_SIZE)) {
                    // Parcours du tableau d'erreurs
                    if (
                        isset($fileError) && UPLOAD_ERR_OK === $fileError
                    ) {
                        // On renomme le fichier
                        $nomImage = md5(uniqid()) . '.' . $extension;

                        // Si c'est OK, on teste l'upload
                        if (move_uploaded_file($fileTemp, TARGET . $nomImage)) {
                            $message = 'Upload réussi !';
                        } else {
                            // Sinon on affiche une erreur systeme
                            $message = 'Problème lors de l\'upload !';
                        }
                    } else {
                        $message = 'Une erreur interne a empêché l\'uplaod de l\'image';
                    }
                } else {
                    // Sinon erreur sur les dimensions et taille de l'image
                    $message = 'Erreur dans les dimensions de l\'image !';
                }
            } else {
                // Sinon erreur sur le type de l'image
                $message = 'Le fichier à uploader n\'est pas une image !';
            }
        } else {
            // Sinon on affiche une erreur pour l'extension
            $message = 'L\'extension du fichier est incorrecte !';
        }
    } else {
        // Sinon on affiche une erreur pour le champ vide
        $message = 'Veuillez uploader une image valide (Taille, Type ... ) !';
    }
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="assets\uploadPreview.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>moduleIMG</title>
</head>

<body>
    <div class="container pt-5">
        <div class="myBg col-sm-6">
            <div class="row">
                <div class="col-sm">
                    <p class="h2">Module d'enregistrement d'images.</p>
                    <p>Mise en pratique php: upload d'images.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm">
                    <img class="preview">
                    <form enctype="multipart/form-data" action="" method="post">
                        <div><?= 'Veuillez choisir un fichier de : ' . MAX_SIZE / 1000000 . ' Mega Octet maximum' ?></div>

                        <div class="custom-file col-sm-10 pt-2">
                            <input name="fichier" type="file" class="custom-file-input" id="fichier_a_uploader" data-preview=".preview">
                            <label class="custom-file-label" for="fichier_a_uploader" data-browse="Parcourir"><?= MAX_SIZE / 1000000 . ' Mo maximum' ?></label>
                        </div>
                        <div class="input-group-append pt-2">
                            <button class="btn btn-outline-success" type="submit" name="submit" value="Uploader" id="inputGroupFileAddon04">Uploader</button>
                        </div>


                        <div class="input-group">
                            <div class="custom-file">
                                <input name="fichier" type="file" class="custom-file-input" id="fichier_a_uploader" data-preview=".preview">
                                <label class="custom-file-label" for="fichier_a_uploader">Choose file</label>
                            </div>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="inputGroupFileAddon04">Button</button>
                            </div>
                        </div>
                    </form>

                    <?php
                    if (!empty($message)) {

                        echo "\t\t<strong>", htmlspecialchars($message), "</strong>\n";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="assets/uploadPreview.js"></script>
</body>

</html>