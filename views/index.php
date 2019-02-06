<?php  require_once("../core/includes.php");
    // unique html head vars
    $title = 'Kelowna&#8217;s Cannabis Network | CONNECT Home';
    require_once("../elements/html_head.php");
    require_once("../elements/nav.php");

    if (!empty($_SESSION['user_logged_in']) ){ //user logged in ?>



    <div class="container-fluid">

        <div class="row">
            <div class="col-md-6 nopadding">
            </div><!-- .col-md-6-->
<!--FEED-->
            <div class="col-md-6 nopadding">
                <div class="feed">
                    <h2>YOUR FEED</h2>
                    <div class="clearfix"></div>
        <!--SEARCH-->
                    <div id="search-form" class="right-inner-addon search">
                        <form action="/" method="get">
                            <div class="form-group">
                                <input id="search-bar" class="form-control"  type="text" name="search" placeholder="SEARCH">
                            </div>
                            <button type="submit" class="icon-search icon-large"><i class="fas fa-search fa-flip-horizontal"></i></button>
                        </form>

                    </div class="right-inner-addon">
                    <hr class="feed-divider">


        <!--USER ADD post-->
                    <div class="add-post" id="add-new-post">
                        <form class="add-post-form" action="/posts/add.php" method="post">
                            <div class="form-group">
                                <textarea class="form-control post-bar" name="name" placeholder="LET'S CONNECT..."required></textarea>
                                <div class="clearfix"></div>
                            </div>
                            <input class="btn connect-btn post-btn" type="submit" value="SHARE">
                            <div class="clearfix"></div>
                        </form>
                    </div><!--.add-post-->

                    <hr class="feed-divider">

                <!--post FEED-->
                <div id="post-feed">

                    <?php
                    $p = new Post;
                    $posts = $p->get_all();

                    // $c = new Comment;

                    foreach($posts as $post){
                    ?>


                    <div class="single-post-feed post-wrapper" data-postID="<?=$post['id']?>">
                        <p class="post-date"> <?=date('F d, Y', $post['posted_time'] )?></p>
                        <p class="post-feed-text"><?=$post['name']?></p>
                        <p>

                            <?php
                            if( $post['user_id'] == $_SESSION['user_logged_in'] ){  //only runs for that post if owner user is logged in at the time
                            ?>
                            <span class="user-post-controls">
                                <a class="edit-post" href="/posts/edit.php?id=<?=$post['id']?>">EDIT</a>
                            </span>
                            <?php
                            }
                            ?>

                            <?php
                            if( $post['user_id'] == $_SESSION['user_logged_in'] ){
                            ?>
                            <span class="user-post-controls">
                               <a class="text-danger delete-post" href="/posts/delete.php?id=<?=$post['id']?>">DELETE <span class="separator">&nbsp;|&nbsp;&nbsp;<span>
                               </a>
                            </span>
                        <?php
                        }
                         ?>

                     </p>
                     <div class="clearfix"></div>


                        <p class="post-username"><a href="http://connectcannabis.carlabardwell.com/users/profile.php?id=<?=$post['user_id']?>">-<?=$post['username']?></a></p>
                        <div class="commented-count">
                            <span class="comment-count-btn">
                                <img class="cannabis-leaf-for-comment img-fluid" src="/assets/img/Connect-leaf-08.png" alt="connect cannabis leaf icon for comment">
                                <span class="comment-count">12 | <span class="comment-btn-text">comment</span></span>
                            </span>

                            <?php
                            $like_text = 'like it';
                            if ( !empty($post['like_id']) ){ //will either hold null or hold the id (checking that 'they liked it')
                                $like_text = 'liked';
                            }
                             ?>

                            <a class="like-btn" href="/likes/add.php?id=<?=$post['id']?>">
                                <i class="fas fa-fire like-icon"></i>
                                <span class="likes-count"><?=$post['like_count']?></span> | <span class="like-btn-text"><?=$like_text?></span>
                            </a>
                        </div><!--.comment-count-->
                        <hr class="posts-divider">
                    </div><!--.single-post-feed-->

                    <?php } //end foreach ?>


            </div><!--.post-feed-->

                <div class="clearfix"></div>
            
            </div><!-- .feed-->
        </div><!-- .col-md-6-->
    </div><!-- .row -->
</div><!-- .container -->





    <?php
    }else{ //else show login page

        require_once("../elements/signup-login-forms.php");

    }
        require_once("../elements/footer.php");
