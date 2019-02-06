<?php

class like extends Db {

    function add($like_data){

        $post_id = $this->data['post_id']; //wrapped with mySQLi function to make it safe
        $user_id = (int)$_SESSION['user_logged_in']; //int is for safety too, forces it to be an integer

        //Check if already liked
        $sql = "SELECT * FROM likes WHERE post_id = '$post_id' AND user_id = '$user_id'";
        $like = $this->select($sql)[0]; //this means that like holds the entry, 0 returns an array (select statements are built so that it returns many entries, but we only want to return one)

        if( !empty ($like['id']) ){ //if already liked, delete the like
            $sql = "DELETE FROM likes WHERE post_id = '$post_id' AND user_id = '$user_id'";
            $this->execute($sql);
            $like_data['liked'] = 'unliked'; //now we can send this back to javascript
            $like_data['error'] = false;
        }else{  //else, create a new like

        $sql = "INSERT INTO likes (post_id, user_id) VALUES('$post_id', '$user_id')";
        $like_id = (int)$this->execute_return_id($sql); //sends SQL to database, which will add a like when they click the like button, execute is a custom function that brings back the id of the one that was inserted - once a new entry is inserted, it will give you the id from the column which we can store in the variable $like_id
        if (!empty($like_id) ){
            if( $like_id !=0 && is_numeric($like_id) ){
                $like_data['liked'] = 'liked';
                $like_data['error'] = false; //this is keeping track of what happened, was it successfully entered into database? record this.
                }
            }
        }

        $sql = "SELECT COUNT(id) AS like_count FROM likes WHERE post_id = '$post_id'"; //essentially counting the rows (counting every id column) to show how many likes there are
        $like_count = $this->select($sql)[0]; //creating the variable like_count which holds the number of likes, but we want to store it into the like data array
        $like_data['like_count'] = $like_count['like_count']; //now like_data has all the data (liked, error, and likecount) - 3 keys in this array. Now we can return the data

        return $like_data;

    }
}
