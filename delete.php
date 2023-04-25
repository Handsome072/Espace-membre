<?php

require ('database.php');

$id= $_GET['id_user'];

$del = "DELETE FROM user WHERE id_user= ? ";

$stmt= $db ->prepare ($del);
$stmt->execute([$id]);
header("Location: index.php");


?>