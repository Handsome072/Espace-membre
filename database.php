<?php
$variable = "mysql:dbname=espace; host=localhost";

try{
    $db = new PDO ($variable ,'root' , null);
}catch(PDOException $error){
    echo "connexion failed: ".$error->getMessage();
}


?>