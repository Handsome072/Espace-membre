<?php
require('database.php');

// on met une cookie pour que personne ne puisse entrer sauf ceux qui sont autorisé
if (isset($_COOKIE['AUTH'])) {
    $email = $_COOKIE['AUTH'];

} else {
    header('Location: login.php');
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
    <title>View</title>
</head>

<body>
    <?php
  
    $id = $_GET['id_user'];

    $req = $db->query("SELECT * FROM user WHERE id_user =' $id' LIMIT 1");
    $data  = $req->fetch();
    ?>

    <header class="header">
        <div class="container-fluid">
            <div class="brand-area">
                <h3 class="text-white ps-5">AndsonTest</h3>

            </div>

            <div class="login-area ">
                <form action=" " method="POST">

                    <div class="float-end pe-5 ">
                        <a href="logout.php" class="btn btn-danger">Se deconnecter</a>
                    </div>
                </form>
            </div>
        </div>
    </header>
    
    <div class="banner">
        <div class="background">
            <div class="container-fluid ">
                <div class="row">
                <div class=" offset-md-4 col-md-4 mb-3">
<a href="/AndsonTest/?id_user=<?= $id ?>" class="float-end btn btn-warning">Acceuil</a >
</div>
                </div>
    
                <div class="row">

                    <div class="col-md-4"></div>
                    <div class="col-md-4 bg-dark pt-5">
                        <div class="mb-5 row img-profil ">
                            <div class="offset-lg-5 ">
                                <img src="images/<?= $data['avatar'] ?>" alt="" srcset="" class="  img-fluid rounded-pill" width="100px">
                            </div>

                        </div>
                        <div class="mb-3 row ">
                        <h1 class="text-center  text-white "><?= $data["name"] ?></h1>

                        </div>
                   
                        <div class="mb-3 row ">
                          
                                <h3 class="text-white text-center"> <?= $data["email"] ?></h3>
                          
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