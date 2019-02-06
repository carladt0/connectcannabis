<?php require_once '../../core/includes.php'; //allows us to have access to our classes and other good stuff

if( !empty($_POST['username']) && !empty($_POST['password']) ){


    $u = new User;
    $u->login();

}

header("Location: /");
