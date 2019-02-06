<?php require_once '../../core/includes.php';
//header('Content-Type: application/json'); //this means you dont have to parse.json, it tells information about the data coming back. Basically saying to ajax that the information coming back in JSON.
$like_data = array( //all the data coming back, we are going to put it into the $like_data array
    'error' => true
);
if( !empty($_POST['post_id'])  ){ //checking if project_id sent

    //Add new like to db
    $l = new Like ; //takes like class and stores it in variable "l"
    $like_data = $l->add($like_data); //we are passing the like data into the add function, which will mess with the like data array and create new keys - we are going to reset the error to false to show everything is OK - processes and returns it, and stores it back in the $like_data

}
echo json_encode($like_data);
die();
