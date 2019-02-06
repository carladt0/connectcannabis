<?php
class Comment extends Db {

    //gets all comments by project id (gets all the comments for that specific project and loops through them) [we put $projet_id into the function params so that we can feed in a specific project ID]
    function get_all_by_project_id($project_id){
        $user_id = $_SESSION['user_logged_in'];
        $project_id = (int)$project_id; //forces it to be an integer
        $sql = "SELECT comments.*, users.username,
        IF(comments.user_id = '$user_id', 'true', 'false') AS user_owns
        FROM comments LEFT JOIN users ON comments.user_id=users.id
        WHERE project_id = '$project_id'
        ORDER BY posted_time DESC LIMIT 5
        "; //highest number descending down only showing 5 comments
        //the IF section adds a condition (if comments.user_id = '$user_id' is true, then evaluate to true, else false). Then we can store the result in a new column named whatever, here 'user_owns'
        $all_project_comments = $this->select($sql);//this select takes the SQL statement that we just created and goes to the database and comes back and evaluates to all the results based on the sql statement in a php array - now this is a php array with all the comments in it. Then we just run/return it. Essentially, the function equates to an array of comments
        return $all_project_comments;
    }



    function get_count($project_id){
        $project_id = (int)$project_id;//this is typecasting so we dont get any injection -has to be an integer

        $sql ="SELECT COUNT(id) AS comment_count FROM comments WHERE project_id = '$project_id'";

        $comment_count = $this->select($sql)[0];
        return $comment_count ['comment_count'];

    }
    function delete(){
        $comment_id = (int)$_POST['comment_id'];
        $project_id = (int)$this->data['project_id'];

        $sql = "DELETE FROM comments WHERE id='$comment_id'";
        $this->execute($sql);

        //get comment count total
        $comment_count = $this -> get_count($project_id);
        $comment_data['comment_count']=$comment_count;

        Return $comment_data;

    }

    function add($comment_data){

        $comment = $this->data['comment'];//the comment is what we set in our javascript
        $posted_time = time();
        $project_id = $this->data['project_id']; //this also comes from the js
        $user_id = (int)$_SESSION['user_logged_in'];


        $sql = "INSERT INTO comments (comment, posted_time, project_id, user_id)
        VALUES ('$comment', '$posted_time', '$project_id', '$user_id')"; //this inserts into the columns comment, project_id, etc, the values that we have stated above (what the user has submitted)

        //check if inserted successfully
        $comment_id = $this->execute_return_id($sql); //this function sends an sql comment to the database and returns the id number if successful. Error false is successful.
        if ( !empty($comment_id) ){
            if( $comment_id !=0 && is_numeric($comment_id) ){
                $comment_data['error'] = false;
            }
        }

        //Get comment count total
        $comment_count = $this->get_count($project_id);
        $comment_data['comment_count'] = $comment_count; //we are returning data and storing it


        //Return all comments for projects - now we want to go back to the database again and store the comment in an array so that javascript can return comments for project in real time
        $all_project_comments = $this-> get_all_by_project_id($project_id); //running the function to get all the comments for that project id (already set at the top)
        $comment_data['comments'] = $all_project_comments; //after action completes, we want to update the page with NO refresh

        return $comment_data;
    }
}
