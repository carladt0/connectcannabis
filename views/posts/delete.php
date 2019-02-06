<?php require_once '../../core/includes.php';
header("Content-Type: application/json");
$post_data = array(
    'error' => true
);

if( !empty($_POST['post_id']) ){
    $p = new Post;
    $post_data = $p->delete();
    $post_data['error'] =  false;
}
echo json_encode($post_data);
die();
