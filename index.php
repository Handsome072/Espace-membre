<?php
require('database.php');

// on met une cookie pour que personne ne puisse entrer sauf ceux qui sont autorisé
if (isset($_COOKIE['AUTH'])) {
    $email = $_COOKIE['AUTH'];

    //selectionner tous les user
    $request = $db->query("SELECT * FROM user");
    $data = $request->fetchAll();
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
    <title>Acceuil</title>
</head>

<body>


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
            <div class="container ">
                <form action="" method="post">
                    <table class="table table-dark p-3">
                        <thead>
                            <tr>
                                <th>Avatar</th>
                                <th>Nom</th>
                                <th>Email</th>
                                <th></th>
                                <th></th>


                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data as $item) { ?>

                                <tr>


                                    <td><img src="images/<?= $item['avatar'] ?>" alt="" srcset="" width="50px" height="50px"></td>
                                    <td><?= $item['name'] ?></td>
                                    <td><?= $item['email'] ?></td>
                                    <td></td>
                                    <td class="text-end"><a href="view.php?id_user=<?= $item['id_user'] ?>" class="btn btn-primary">View</a>
                                        <a href="delete.php?id_user=<?= $item['id_user'] ?>" class="btn btn-danger ms-2">Delete</a>
                                        <a href="update.php?id_user=<?= $item['id_user'] ?>" class="btn btn-success ms-2">Update</a>
                                    </td>
                                </tr>

                            <?php } ?>

                        </tbody>
                    </table>
                </form>

            </div>
        </div>

    </div>
    <script src="bootstrap/js/bootstrap.min.js"></script>
</body>

</html>