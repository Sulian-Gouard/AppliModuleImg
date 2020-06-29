<?php
require_once 'my-config.php';
require_once 'controllers\dashboard-controller.php';
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
        <div class="row justify-content-center mt-5">
            <form enctype="multipart/form-data" action="" method="post" class="col-sm-6 mb-3 bg-light p-5 shadow">
                <div class="h1 text-info text-center mb-3">Uploadez votre image</div>
                <img class="preview">
                
                <div class="form-group">
                    <label for="fichier_a_uploader" title="Recherchez le fichier à uploader !">Envoyer le fichier :</label>
                    <?= '(  ' . MAX_SIZE / 1000000 . ' Mo Max)' ?>
                    <input name="fichier" type="file" id="fichier_a_uploader" class="form-control-file" data-preview=".preview">
                </div>
                <button type="submit" name="submit" class="btn btn-outline-info mb-1">Uploader</button>
                <a href="gallery.php" name="redirGallery" class="btn btn-outline-info mb-1 text-white">Gallery</a>
                <?= '( ' . round(TailleDossier('img/') / 10000) . ' Mo )' ?>
                <?php
                if (!empty($message)) { ?>
                    <div class="text-secondary h6 font-weight-bold"><?= htmlspecialchars($message) ?></div>
                <?php
                }
                ?>
            </form>
            <form action="deconnection.php" method="post">
                <button type="submit" name="deconnection" class="btn btn-outline-info mt-2">Me déconnecter</button>
            </form>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="assets\uploadPreview.js"></script>
</body>

</html>