<?php
require_once 'my-config.php';
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
            <form class="col-sm-6 mb-3 bg-light p-5 shadow" action="index.php" method="post" novalidate>
                <div class="h1 text-info text-center mb-3">allPIX</div>
                <div class="form-group">
                    <label for="login" class="text-secondary font-weight-bold">login</label>
                    <input type="text" class="form-control" id="login" name="login" value="<?= isset($_POST['login']) ? $_POST['login'] : '' ?>" required>
                </div>
                <div class="form-group">
                    <label for="password" class="text-secondary font-weight-bold mb-3">password</label>
                    <input type="password" class="form-control" id="password" name="password" value="<?= isset($_POST['password']) ? $_POST['password'] : '' ?>" required>
                </div>
                <div class="text-center">
                <button type="submit" name="submit" class="btn btn-outline-primary">Envoyer</button>
                </div>
                
                <span class="font-italic text-danger"><?= isset($error['login']) ? $error['login'] : '' ?></span>
            </form>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="assets\uploadPreview.js"></script>
</body>

</html>