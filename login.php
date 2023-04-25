<?php
require('database.php');
if (isset($_COOKIE['AUTH'])) {
    $id = $user['id_user'];
    header("Location: index.php?id_user=$id");
}

//gestion de l'erreur

$error = [];

//se connecter avec le bouton submit
if (isset($_POST['submit'])) {

    $email = trim(strtolower(($_POST['email'])));
    $password = $_POST['password'];

    $req = $db->query("SELECT * FROM user WHERE email='$email' ");
    $user = $req->fetch();

    if (!$user) {
        array_push($error, "Adress email ou password invalid !");
    }
    if ($error == null) {
        setcookie('AUTH', $email, time() + (60 * 60 * 24 * 31), '/');
        $id = $user['id_user'];
        header("Location: index.php?id_user=$id");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="main/style.css">
    <title>Connexion</title>
</head>

<body>
<div class="banner">
        <div class="background">
            <div class="container-fluid ">
                <form action="" method="post" class="center ">
                    <div class="row">

                        <div class="col-md-4"></div>
                        <div class="col-md-4 bg-dark pt-5">

                            <?php
                            // Affichage de l'erreur 
                            if ($error != 0) {
                                for ($i = 0; $i < count($error); $i++) { ?>
                                 
                                 <div class="alert bg-danger text-center text-white"> <?= $error[$i]  ?></div>

                               
                                
                            <?php }
                            } ?>


                            <h1 class="text-center  text-white mb-5">Connectez -vous !</h1>


                            <div class="mb-3 row ">
                                <label for="email" class="col-sm-2 col-form-label me-4 ms-4 text-white">Email</label>
                                <div class="col-sm-8">
                                    <input type="text" name="email" class="form-control" id="email">
                                </div>
                            </div>
                            <div class="mb-3 row ">
                                <label for="inputPassword" class="col-sm-2 col-form-label me-4 ms-4 text-white">Password</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control" name="password" id="inputPassword">
                                </div>
                            </div>

                            <div class="col-12 float-end me-3 ">
                                
                                <button class="btn btn-primary  mt-4 mb-4  me-5 float-end " name="submit">Se Connecter</button>

                            </div>
                            <div class="text-center pb-3">
                                <a href="/AndsonTest/register.php" class="text-center signup">Vous pouvez vous inscrire</a>
                            </div>

                        </div>

                        <div class="col-md-4"></div>

                    </div>
                </form>

            </div>
        </div>

    </div>
    <script src="bootstrap/js/bootstrap.min.js"></script>
</body>

</html>