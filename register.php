<?php
require('database.php');

$error = [];

if (isset($_POST['signup'])) {

    //Gestion de l'erreur
    $name = $_POST['name'];
    $email = trim(strtolower(($_POST['email'])));
    $password = $_POST['password'];

    $req = $db->query("SELECT * FROM user WHERE email='$email'");
    $user = $req->fetch();

    if ($user) {
        array_push($error, "adresse email deja utilise");
    }

    if (strlen($password) < 6 || strlen($password) > 60) {
        array_push($error, "min 6 et max 60");
    }



    // Telechargemet du photos de profil vers la destination de dossier image
    
    $destinationDir = 'images/';
    $originaleFilename = $_FILES['avatar']['name'];
    $fileExtension = strtolower(pathinfo($originaleFilename, PATHINFO_EXTENSION));
    $newFilename = "FILE-" . time() . rand(1000, 999) . "." . $fileExtension;
    $uploadDir = $destinationDir . $newFilename;



    if ($error == null && move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadDir)) {

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT, ['cost' => 13]);
        $query = "INSERT INTO user(name , email , password, avatar) VALUE (? , ? , ?, ?) ";
        $stmt = $db->prepare($query);
        $stmt->execute([$name, $email,  $hashedPassword, $newFilename]);

        // ajouter une cookie 

        setcookie('AUTH', $email, time() + (60 * 60 * 24 * 31), '/');
        $id = $_GET['id_user'];
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
    <title>Inscription</title>
</head>

<body>
    <div class="banner">
        <div class="background">
            <div class="container-fluid ">
                <form action="" method="post" class="center" enctype="multipart/form-data">
                    <div class="row  ">
                        <?php if (count($error) > 0) {
                        } ?>
                        <?php foreach ($error as $errors) { ?>
                            <div class="alert alert-danger">

                                <?= $errors ?>;
                            </div>
                        <?php } ?>

                        } ?>
                        <div class="col-md-4"></div>
                        <div class="col-md-4  bg-dark pt-5">

                            <h1 class="text-center mb-5 text-white">Inscrivez-vous</h1>
                            <div class="mb-3 row ">
                                <label for="email" class="col-sm-2 col-form-label me-4 ms-4 text-white">Nom</label>
                                <div class="col-sm-8">
                                    <input type="text" name="name" class="form-control" id="nom" required placeholder="votre nom">


                                </div>
                            </div>
                            <div class="mb-3 row ">
                                <label for="email" class="col-sm-2 col-form-label me-4 ms-4 text-white">Email</label>
                                <div class="col-sm-8">
                                    <input type="text" name="email" class="form-control" id="email" required placeholder="votre email">

                                </div>
                            </div>
                            <div class="mb-3 row ">
                                <label for="inputPassword" class="col-sm-2 col-form-label me-4 ms-4 text-white">Password</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control" name="password" required placeholder="Mot de passe">

                                </div>
                            </div>
                            <div class="mb-3 row ">
                                <label for="inputPassword" class="col-sm-2 col-form-label me-4 ms-4 text-white">Avatar</label>
                                <div class="col-sm-8">
                                    <input type="file" name="avatar">

                                </div>
                            </div>
                            <div class="row pb-3 ">
                                <div class="col-10 mt-5 text-center ">
                                    <a href="/AndsonTest/login.php" class="text-center signup">Avez-vous déja un compte?</a>
                                </div>
                                <div class="col-2 ">
                                    <button class="btn btn-primary  mt-4 mb-4 me-5 float-end " name="signup">S'inscrire</button>

                                </div>
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