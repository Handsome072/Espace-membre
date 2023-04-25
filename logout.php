<?php
// supprimer le cookies 

if(isset($_COOKIE['AUTH'])){
    setcookie('AUTH' , '', time() -3600, '/');
}
header('Location: index.php');