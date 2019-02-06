<?php
class User extends Db {

    // function get_all(){
    //
    //     $sql = "SELECT * FROM `users`";
    //
    //     $users = $this->select($sql);
    //
    //     return $users;
    //
    // }

    function get_by_id($id){ //this function grabs users information
        $id = (int)$id; //this is typecasting - if on the off chance a string got in here instead of a number, it will force it to be a number (SQL injection prevention)
        $sql = "SELECT * FROM users WHERE id = '$id'";

        $user = $this->select($sql)[0]; //only bringing back one, so we need to put a number

        return $user;
    }



    function add(){
        $firstname = trim($this->data['firstname']);
        $lastname= trim($this->data['lastname']);
        $username = trim($this->data['username']);
        $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);
        $email = trim($this->data['email']);
        $created_time = time();

        $sql = "INSERT INTO users (firstname, lastname, username, password, email, created_time) VALUES ('$firstname', '$lastname', '$username', '$password', '$email', '$created_time')";

        $new_user_id = $this->execute_return_id($sql);

        return $new_user_id;

    }


    function exists(  ){
        $username = $this->data['username'];

        $sql="SELECT * FROM users WHERE username = '$username'";

        $user = $this->select($sql);

        return $user; //this is a function to check if the user exists

    }



    function login(){
        $_SESSION = array(); //Empty session to start fresh.

        //Get the user's details from the db and store it in a variable

        $username = $this->data['username'];
        $sql = "SELECT * FROM users WHERE username = '$username'";

        $user = $this->select($sql)[0];


        //check if the password from the form matches the password from //

        if(password_verify($_POST['password'], $user['password'])  ){
            $_SESSION['user_logged_in'] = $user['id'];


        }else{ //login attempt failed.
            $_SESSION['login_attempt_msg'] = '<p class="text-danger">*Incorrect username and/or password</p>';


        }
    }



    function edit(){

        $id = (int)$_SESSION['user_logged_in'];
        $firstname = trim($this->data['firstname']);
        $lastname = trim($this->data['lastname']);
        $username = trim($this->data['username']);
        $password = password_hash(trim($this->data['password']), PASSWORD_DEFAULT);
        $email = trim($this->data['email']);
        $age = trim($this->data['age']);
        $location = trim($this->data['location']);
        $interesta = trim($this->data['interesta']);
        $interestb = trim($this->data['interestb']);
        $interestc = trim($this->data['interestc']);
        $cannabisform = trim($this->data['cannabisform']);
        $quote = trim($this->data['quote']);
        $startedusing = trim($this->data['startedusing']);
        $file_query = '';

        if(!empty($_FILES['fileToUpload']['name']) ){ //$_FILES is similar to post, created when a form is submitted with a file - checking to see if there is a filename that is associated - ***this section is checking if there is a new file submitted
            //in order to upload an image, we need to delete the old image and information - needs to be overrided
            $util = new Util; //upload the file that is in this array (function file_upload detects if there's something in the $_FILES array, if there is it will upload it. Key fileToUpload. Returns what filename was.)
            $filename = $util->file_upload(); //$filename holds name of file as a string

            $file_query=", profile_picture='$filename'";

        }

        if (!empty(trim($_POST['password'])) ){
            $sql ="UPDATE users SET firstname='$firstname', lastname='$lastname', username='$username', password='$password', email='$email', age='$age', location='$location', interesta='$interesta', interestb='$interestb', interestc='$interestc', cannabisform='$cannabisform', quote='$quote',  startedusing='$startedusing' $file_query WHERE id='$id'";
        }else{
            $sql ="UPDATE users SET firstname='$firstname', lastname='$lastname', username='$username', email='$email', age='$age', location='$location', interesta='$interesta', interestb='$interestb', interestc='$interestc', cannabisform='$cannabisform', quote='$quote', startedusing='$startedusing' $file_query WHERE id='$id'";
        }
        $this->execute($sql);
        }
}
