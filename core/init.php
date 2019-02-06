<?php
// For functionality like checking if a user is an admin before page is loaded
date_default_timezone_set('America/Vancouver'); //this is the default for if something goes wrong (pick the one most of your users will be in)

if( empty($_SESSION['user_logged_in']) ){ //if not logged in then this function runs
        //allowed to access when logged out
        $allowed_urls = array(
            '/',
            '/index.php',
            '/users/signup.php', //may need to add other php pages like add if not working
            '/connect.php',
            '/users/add.php',
            '/users/login.php',
        );

        $allowed = false;

        foreach($allowed_urls as $allowed_url){ //loops through allowed urls, if url they are trying to access is equal to allows, then they are allowed to access it. If this doesnt happen, they will be redirected away.
            if($_SERVER['REQUEST_URI'] == $allowed_url){
                $allowed=true;
                break;
            }

        }

        if( $allowed === false) {
            header("Location: /"); //redirects to homepage if logged out
        }



        }else{ //this will run if the user IS logged in

            //Set the users timezone (we need to goto database and get the user that is logged into the database to get his/her timezone)

            $u = new User;
            $user = $u->get_by_id($_SESSION['user_logged_in']);

        }
