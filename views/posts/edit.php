<?php  require_once("../../core/includes.php");

if(!empty($_GET) ){ //check if URL has id in it

    $p = new Post; //going to the whole post.php in models folder and grabbing all the code from the post class and putting it into the variable $p. Create a function inside that is going to the database and getting info, get_by_id is the function, which we now have to create (this function takes a number as an id for the post and goes and gets the rest of the information)
    $post = $p->get_by_id($_GET['id']); //this pulls the number from the URL, and passes it into the function

        if(!empty($_POST)) { //check if form was submitted
            $p->edit($_GET['id']);
            header("Location: /");
            exit();
        }

    }else{
    header("Location: /"); //if nothing in URL, redirect to homepage
    exit();
    }



    // unique html head vars
    $title = 'Edit Post';
    require_once("../../elements/html_head.php");
    require_once("../../elements/nav.php");

?>

<div class="change-post">
    <form method="post" enctype="multipart/form-data">

            <div class="form-group">
                <textarea class="form-control post-bar-change" name="name" placeholder="LET'S CONNECT..."required><?=$post['name']?></textarea>

                <div class="clearfix"></div>
                <input class="btn connect-btn post-btn-change" type="submit" value="RE-SUBMIT">
            </div><!--.form-group-->
    </form>
</div><!--.change-post-->


<?php require_once("../../elements/footer.php");
