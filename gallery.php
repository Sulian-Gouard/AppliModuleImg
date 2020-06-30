<?php
require_once 'my-config.php';
require_once 'controllers\gallery-controller.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="assets\lightbox2-2.11.1\dist\css\lightbox.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&display=swap" rel="stylesheet">
    <link href="\assets\uploadPreview.css" rel="stylesheet">
    <title>gallery</title>
</head>

<body class="row justify-content-center">
    <div class="containerGallery col-sm-10 mt-4 mb-4 bg-light p-4">
    <div class="h1 text-info text-center mb-3" id="mainTitle">Galerie</div>
        <div class="row justify-content-center">
            <?php foreach ($adminDirectory as $value) {
                if (!in_array($value, array(".", ".."))) { ?>
                    <a href="img/<?= $value ?>" data-lightbox="adminImg" data-title=""><img class="imgSizeMax m-3" src="img/<?= $value ?>"></a>
            <?php }
            } ?>
        </div>
        <div class="row justify-content-center ml-3">
            <form action="deconnection.php" method="post">
                <button type="submit" name="deconnection" class="btn text-info mt-2">déconnexion</button>
            </form>
            <button type="button" class="btn text-info" name="btnBack"><a class="btn text-info" href="dashboard.php">retour</a></button>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="assets\lightbox2-2.11.1\dist\js\lightbox-plus-jquery.js"></script>
</body>

</html>