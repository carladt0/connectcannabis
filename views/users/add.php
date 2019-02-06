<?php
require_once '../../core/includes.php';


if ( !empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['username']) &&  !empty($_POST['password']) && !empty($_POST['email']) ){

    $u = new User;

    //check if username already exists
    $exists = $u->exists();

    if( empty($exists)   ){ //if the user does not exist, then add this user in
        $new_user_id = $u->add();
        $_SESSION['user_logged_in'] = $new_user_id;
        header("Location: /");
        exit();

    }else{
        $_SESSION['create_acc_msg'] = '<p class="text-danger">*Username already exists</p>';
        header('Location: /signup.php');
        exit();
    }



}

header("Location: /");
exit();
