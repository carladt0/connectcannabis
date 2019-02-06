<?php

class Post extends Db {

    function get_all(){

        $user_id = (int)$_SESSION['user_logged_in'];

        if( !empty($_POST['search']) ){ // They're searching something

            $search = $this->data['search'];

            $sql = "SELECT DISTINCT posts.*, users.username, likes.id AS like_id,
            (SELECT COUNT(likes.id) FROM likes WHERE likes.post_id = posts.id) AS like_count,
            IF(posts.user_id = '$user_id', 'true', 'false') AS user_owns
            FROM posts
            LEFT JOIN likes
            ON posts.id = likes.post_id
            AND likes.user_id = '$user_id'
            LEFT JOIN users
            ON posts.user_id = users.id
            WHERE posts.name
            LIKE '%$search%' OR CONCAT(users.firstname, ' ', users.lastname) LIKE '%$search%' OR users.username LIKE '%$search%'
            ORDER BY posts.posted_time DESC";

        }else{ // They're not searching
            $sql = "SELECT
             posts.*, users.username, likes.id AS like_id,
             (SELECT COUNT(likes.id) FROM likes WHERE likes.post_id = posts.id) AS like_count,
             IF(posts.user_id = '$user_id', 'true', 'false') AS user_owns
             FROM posts
             LEFT JOIN users
             ON posts.user_id = users.id
             LEFT JOIN likes
             ON posts.id = likes.post_id
             AND likes.user_id = '$user_id'
             ORDER BY posts.posted_time DESC"; //created a new column that tallies the like count and displays it in like_count (holds the number of likes)
        }

        $posts = $this->select($sql);

        return $posts;

    }

    function get_by_id($id){

        $id = (int)$id;

        $sql = "SELECT * FROM posts WHERE id = '$id'";

        $post = $this->select($sql)[0];

        return $post;

    }

    function get_by_user_id($id){ //this function grabs users information
    $id = (int)$id; //this is typecasting - if on the off chance a string got in here instead of a number, it will force it to be a number (SQL injection prevention), stored in $id
    $sql = "SELECT * FROM posts WHERE user_id = '$id'"; //change from users to posts for this case if copied from users

    $posts = $this->select($sql); //sql only brings back one from database, so we need to put a number

    return $posts; //brings it back
}



    function add(){

            $name = $this->data['name'];
            $user_id = (int)$_SESSION['user_logged_in']; //this user_logged_in holds the id of the person logged in (its they key) - int makes sure its a numeric number (integer) -allows us to not use the $this->data because there are no weird characters in integers, so we dont need to protect from injection (works the same, just the lazy way)

            $current_time = time();  //spits out unix timestamp of current time

            $sql = "INSERT INTO posts (name, user_id, posted_time) VALUES ('$name', '$user_id', '$current_time')"; //first set is the column titles, second set is the values set above- make sure order matches order in db

            $this->execute($sql);

    }


    function edit($id){

        $id = (int)$id;

        $this->check_ownership($id); // Make sure user owns post that's being editted

        $name = $this->data['name'];
        $current_user_id = (int)$_SESSION['user_logged_in'];

        $sql = "UPDATE posts SET name='$name' WHERE id='$id' AND user_id='$current_user_id'";

        $this->execute($sql);

    }

    function delete($post_data){

        $current_user_id = (int)$_SESSION['user_logged_in'];
        $id = (int)$this->data['post_id'];

        $sql = "DELETE FROM posts WHERE id='$id' AND user_id='$current_user_id'";
        $this->execute($sql);



    }

    function check_ownership($id){

        $id = (int)$id;

        $sql = "SELECT * FROM posts WHERE id = '$id'";

        $post = $this->select($sql)[0];

        if( $post['user_id'] == $_SESSION['user_logged_in'] ){
            return true;
        }else{
            header("Location: /");
            exit();
        }

    }

}
