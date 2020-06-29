<?php
require_once 'my-config.php';

if($_SESSION['login'] !='admin') {
    header('location: not-allowed.php');
    exit;
 }
 
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

if (!empty($_FILES['fichier']['name'])) {
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
