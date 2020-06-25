<?php

// Constantes
define('TARGET', 'img/');    // Repertoire cible
define('MAX_SIZE', 1 * 1000 * 1000);    // Taille max en octets du fichier
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
                if (($infosImg[0] <= WIDTH_MAX) && ($infosImg[1] <= HEIGHT_MAX) && (filesize($fileTemp) <= MAX_SIZE)) {
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
    <div class="container">
        <div class="row">
            <div class="col-sm-6 mb-3">
                <div class="h2 mainTitle">Module d'Enregistrement d'Images</div>
                <div class="h5 text-info">Mise en pratique PHP : Upload d'images.</div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-5">
                <img class="preview">
                <form enctype="multipart/form-data" action="" method="post" class=" p-3">
                    <div class="form-group">
                        <label for="fichier_a_uploader" title="Recherchez le fichier à uploader !">Envoyer le fichier :</label>
                        <?= '(  ' . MAX_SIZE / 1000000 . ' Mo Max)' ?>
                        <input name="fichier" type="file" id="fichier_a_uploader" class="form-control-file" data-preview=".preview">
                    </div>
                    <button type="submit" name="submit" class="btn btn-outline-info mb-1">Uploader</button>
                </form>
                <?php
                if (!empty($message)) { ?>
                    <div class="text-secondary h6 font-weight-bold"><?= htmlspecialchars($message) ?></div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="assets\uploadPreview.js"></script>
</body>

</html>