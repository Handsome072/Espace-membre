<?php
require('database.php');

//une cookie

if (isset($_COOKIE['AUTH'])) {
    $email = $_COOKIE['AUTH'];

} else {
    header('Location: login.php');
}

$id = $_GET['id_user'];
$errors = [];

if (isset($_POST['update'])) {

    //Gestion de l'erreur
    $name = $_POST['name'];
    $email = trim(strtolower(($_POST['email'])));
    $password = $_POST['password'];

    $req = $db->query("SELECT * FROM user WHERE email='$email'");
    $user = $req->fetch();

    if ($user) {
        array_push($errors, "adresse email deja utilise");
    }

    if (strlen($password) < 6 || strlen($password) > 60) {
        array_push($errors, "min 6 et max 60");
    }



    // Telechargemet du photos de profil vers la destination de dossier image
    $destinationDir = 'images/';
    $originaleFilename = $_FILES['avatar']['name'];
    $fileExtension = strtolower(pathinfo($originaleFilename, PATHINFO_EXTENSION));

    $newFilename = "FILE-" . time() . rand(1000, 999) . "." . $fileExtension;
    $uploadDir = $destinationDir . $newFilename;
    if ($errors == null && move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadDir)) {


        $hashedPassword = password_hash($password, PASSWORD_BCRYPT, ['cost' => 13]);
        // requete pour mettre a jour
        $rekety = $db->exec("UPDATE user SET name ='$name',email ='$email', password =' $hashedPassword', avatar ='$newFilename' WHERE id_user ='$id' ");


        header("Location: index.php?id_user=$id");
    }
}



?>


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="main/style.css">
    <title>Update</title>
</head>

<body>
    <?php
    require('database.php');

    $error = null;
    //requete pour selectionner l'utilisateur à mettre à jour
    $req = $db->query("SELECT * FROM user WHERE id_user =' $id' LIMIT 1");
    $data  = $req->fetch();


    ?>



    <div class="banner">
        <div class="background">
            <div class="container-fluid ">
                <form action="" method="post" class="center" enctype="multipart/form-data">
                    <div class="row  ">
                        <?php if ($error != null) { ?>
                            <div class="alert alert-danger">
                                <?= $error ?>
                            </div>


                        <?php } ?>
                        <div class="col-md-4"></div>
                        <div class="col-md-4  bg-dark pt-5">

                            <h1 class="text-center mb-5 text-white">Mettre à jour votre Profil</h1>
                            <div class="mb-3 row ">
                                <label for="nom" class="col-sm-2 col-form-label me-4 ms-4 text-white">Nom</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control"  name="name" value="<?php echo $data['name']; ?>" id="nom" required placeholder="votre nom">


                                </div>
                            </div>
                            <div class="mb-3 row ">
                                <label for="email" class="col-sm-2 col-form-label me-4 ms-4 text-white">Email</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control"  name="email" value="<?php echo $data['email']; ?>" id="email" required placeholder="votre email">

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
                                <div class="col-10 "></div>
                                <div class="offset-lg-10 col-lg-2 ">

                                    <button class="btn btn-primary  mt-4 mb-4 me-5 float-end "  name="update">Enregistrer</button>

                                </div>
                            </div>



                        </div>

                        <div class="col-md-4"></div>

                    </div>
                </form>

            </div>
        </div>

    </div>




</body>

</html>