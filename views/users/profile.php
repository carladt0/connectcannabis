<?php  require_once("../../core/includes.php");
    // unique html head vars
    $title = 'Kelowna&#8217;s Cannabis Network | CONNECT Profile';
    require_once("../../elements/html_head.php");
    require_once("../../elements/nav.php");



if (!empty($_SESSION['user_logged_in']) ){ //user logged in
    if(!empty($_GET['id']) ){
        $user=$u->get_by_id($_GET['id']);
    }
    ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
        </div><!-- .col-md-6-->

                <div class="col-md-6">
                    <div class="feed end-space">

                        <h2>PROFILE</h2>
                        <div class="clearfix"></div>
                        <hr class="profile-divider">


<!--EDIT PROFILE BUTTON-->
                        <div class="edit-profile-btn">
                            <?php if(empty($_GET['id']) || $_SESSION['user_logged_in'] == $_GET['id'] ){ ?>
                            <a class="btn connect-btn edit-btn" href="/users/edit.php">EDIT</a>
                            <?php } ?>
                        </div><!-- .edit-profile-btn-->
                        <div class="clearfix"></div>
<!--PROFILE PIC ROW-->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="username-display">
                                <h3 class="username"><?= strtoupper($user['username'])?></h3>
                                <img class="profile-leaf-icon img-responsive" src="/assets/img/Connect-leaf-08.png" alt="connect cannabis leaf">
                                <p class="connected-since">CONNECTED SINCE <br> <?=date('F d, Y', $user['created_time'] )?></p>
                            </div>
                        </div><!--.col-md-6 USERNAME INFO-->

                        <div class="col-md-6">
                            <div class="profile-picture-display">
                                <?php
                                $profile_picture = "/assets/img/Connect-symbolmark-08.png";
                                if (!empty($user['profile_picture'])   ){
                                    $profile_picture = '/assets/files/' . $user['profile_picture'];
                                }
                                ?>
                                    <img id="profile-picture-image" class="img-fluid" src="<?=$profile_picture?>" alt="User Profile Picture">
                            </div>
                            <div class="clearfix"></div>
                        </div><!--.col-md-6 IMAGE-->
                    </div><!--.row-->

                        <blockquote>
                            <?=strtoupper($user['quote'])?>
                        </blockquote>

                    <hr class="profile-divider">
                    <div class="row">
                        <div class="col-md-5 nopadding">
                            <h1>CANNA-FAN<br> SINCE <span class="date-since-joining"><br>2004</span></h1>
                        </div><!--.col-md-5-->
                        <div class="col-md-7 nopadding">
                            <div class="profile-user-information">
                                <p><span class="first-last-name"><?= strtoupper($user['firstname'])?> <?= strtoupper($user['lastname'])?></span>
                                <br>Is a fan of cannabis.
                                <br><br>
                                <?= strtoupper($user['firstname'])?>  is <?=$user['age']?> years old,
                                <br>
                                & lives in <?=strtoupper($user['location'])?>.
                                <br><br>
                                <?= strtoupper($user['firstname'])?>  is fond of <?=strtoupper($user['interesta'])?>,<br>
                                <?=strtoupper($user['interestb'])?>, and <?=strtoupper($user['interestc'])?>.
                                <br><br>
                                <?= strtoupper($user['firstname'])?>  best enjoys
                                Cannabis<br> in the form of <?=strtoupper($user['cannabisform'])?>.
                                </p>
                            </div>
                        </div><!--.col-md-7-->
                    </div><!--.row-->
            </div><!--.feed-->
        </div><!-- .col-md-6-->
    </div><!-- .row -->
</div><!-- .container -->



<?php
}else{ //else show login page

    require_once("../../elements/signup-login-forms.php");

}
    require_once("../../elements/footer.php");
