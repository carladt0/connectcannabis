<?php require_once '../../core/includes.php';

if (!empty($_POST['name'])   ){

    // Add new post to Database
    $p = new Post;
    $p->add();


}

header("Location: /"); //to redirect user back to homepage after creating a new project in db (otherwise would stay on blank screen)
exit();
