<?php  require_once("../../core/includes.php");

    $u= new User; //getting users information

    if(!empty($_POST) ){ //form was submitted
        $u->edit();
        header('Location:/users/profile.php');
        exit();
    }

    $user = $u->get_by_id($_SESSION['user_logged_in']); //pass the user number into the function
    $title = 'Kelowna&#8217;s Cannabis Network | CONNECT Edit Profile';
    require_once("../../elements/html_head.php");
    require_once("../../elements/nav.php");
?>


        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                </div><!-- .col-md-6-->

                        <div class="col-md-6">
                            <div class="feed end-space">
                                    <form enctype="multipart/form-data" method="post">


                                <h2>EDIT PROFILE</h2>
                                <div class="clearfix"></div>
                                <hr class="profile-divider">
                                <!--PROFILE PIC ROW-->
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="username-display-edit">
                                                                <h3 class="username"><?=$user['username']?></h3>
                                                                <img class="profile-leaf-icon img-responsive" src="/assets/img/Connect-leaf-08.png" alt="connect cannabis leaf">
                                                                <p class="connected-since">CONNECTED SINCE <br><?=date('F d, Y', $user['created_time'] )?></p>
                                                            </div>
                                                        </div><!--.col-md-6 USERNAME INFO-->

                                                        <div class="col-md-6">
                                                            <div class="profile-picture-display-edit">
                                                                <?php
                                                                $profile_picture = "/assets/img/Connect-symbolmark-08.png";
                                                                if (!empty($user['profile_picture'])   ){
                                                                    $profile_picture = '/assets/files/' . $user['profile_picture'];
                                                                }
                                                                ?>
                                                                    <img id="profile-picture-edit-image" class="img-fluid" src="<?=$profile_picture?>" alt="User Profile Picture">
                                                                <label for='file-with-preview' class="edit-profile-image img-fluid">
                                                                    <div class="content">
                                                                        <i class="fa fa-camera" aria-hidden="true"></i>
                                                                    </div>
                                                                </label>
                                                                <input class="d-none" onchange="previewFile()" id="file-with-preview" type="file" name="fileToUpload">

                                                            </div><!--.profile-picture-display-edit-->
                                                            <div class="clearfix"></div>
                                                        </div><!--.col-md-6 IMAGE-->
                                                    </div><!--.row-->


                                                        <blockquote>
                                                            <div class="form-group">
                                                                <textarea class="form-control project-bar quote-input" name="quote" placeholder="*INSERT FAVOURITE QUOTE, OR TELL US MORE ABOUT YOURSELF"><?=$user['quote']?></textarea>
                                                            </div>
                                                        </blockquote>
                                                        <div class="clearfix"></div>

                                                <div class="row nopadding nomargin">
                                                    <div class="col-lg-4 nopadding nomargin canna-fan">
                                                        <h1>CANNA-FAN<br> SINCE <span class="date-since-joining"><br><?=$user['startedusing']?></span></h1>
                                                    </div><!--.col-md-4-->
                                                    <div class="col-lg-8 form-input-style nopadding nomargin">
                                                            <div class="form-group edit-profile-form">
                                                                <div class="row">
                                                                <label class="col-lg-4 nopadding nomargin"  for="firstname">FIRST NAME:</label>
                                                                <div class="col-lg-8 form-input-style nopadding nomargin ">
                                                                    <input class="form-control " type="text" name="firstname" value="<?=strtoupper($user['firstname'])?>"required>
                                                                </div>
                                                                </div>
                                                                <div class="row">
                                                                <label class="col-lg-4 nopadding"  for="lastname">LAST NAME:</label>
                                                                <div class="col-lg-8 form-input-style nopadding">
                                                                    <input class="form-control " type="text" name="lastname" value="<?=strtoupper($user['lastname'])?>"required>
                                                                </div>
                                                                </div>
                                                                <div class="row">
                                                                <label class="col-lg-4 nopadding"  for="age">AGE:</label>
                                                                <div class="col-lg-8 form-input-style nopadding">
                                                                    <input class="form-control " type="text" name="age" value="<?=$user['age']?>">
                                                                </div>
                                                                </div>
                                                                <div class="row">
                                                                <label class="col-lg-4 nopadding"  for="location">LOCATION:</label>
                                                                <div class="col-lg-8 form-input-style nopadding">
                                                                    <input class="form-control " type="text" name="location" value="<?=strtoupper($user['location'])?>">
                                                                </div>
                                                                </div>
                                                                <div class="row">
                                                                <label class="col-lg-4 nopadding"  for="interesta">INTEREST:</label>
                                                                <div class="col-lg-8 form-input-style nopadding">
                                                                    <input class="form-control " type="text" name="interesta" value="<?=strtoupper($user['interesta'])?>">
                                                                </div>
                                                                </div>
                                                                <div class="row">
                                                                <label class="col-lg-4 nopadding"  for="interestb">INTEREST:</label>
                                                                <div class="col-lg-8 form-input-style nopadding">
                                                                    <input class="form-control " type="text" name="interestb" value="<?=strtoupper($user['interestb'])?>">
                                                                </div>
                                                                </div>
                                                                <div class="row">
                                                                <label class="col-lg-4 nopadding" for="interestc">INTEREST:</label>
                                                                <div class="col-lg-8 form-input-style nopadding">
                                                                    <input class="form-control " type="text" name="interestc" value="<?=strtoupper($user['interestc'])?>">
                                                                </div>
                                                                </div>
                                                                <div class="row">
                                                                <label class="col-lg-4 nopadding"  for="startedusing">YEAR I STARTED USING CANNABIS:</label>
                                                                <div class="col-lg-8 form-input-style nopadding">
                                                                    <input class="form-control" type="text" name="startedusing" value="<?=$user['startedusing']?>">
                                                                </div>
                                                                </div>
                                                                <div class="row">
                                                                <label class="col-lg-4 nopadding" for="cannabisform">PREFERRED METHOD OF CANNABIS USE:</label>
                                                                <div class="col-lg-8 form-input-style nopadding">
                                                                    <input class="form-control" type="text" name="cannabisform" value="<?=strtoupper($user['cannabisform'])?>">
                                                                </div>
                                                                </div>
                                                                <div class="row">
                                                                <label class="col-lg-4 nopadding"  for="username">USERNAME:</label>
                                                                <div class="col-lg-8 form-input-style nopadding">
                                                                    <input class="form-control " type="text" name="username" value="<?=strtoupper($user['username'])?>"required>
                                                                </div>
                                                                </div>
                                                                <div class="row">
                                                                <label class="col-lg-4 nopadding"  for="password">PASSWORD:</label>
                                                                <div class="col-lg-8 form-input-style  nopadding">
                                                                    <input class="form-control " type="password" name="password" placeholder="Leave Empty to Keep Same">
                                                                </div>
                                                                </div>
                                                                <div class="row">
                                                                <label class="col-lg-4 nopadding"  for="email">EMAIL:</label>
                                                                <div class="col-lg-8 form-input-style nopadding">
                                                                    <input class="form-control " type="email" name="email" value="<?=$user['email']?>"required>
                                                                </div>
                                                                </div>
                                                                <input class="btn connect-btn project-btn submit-edit-btn" type="submit" value="submit">
                                                                <div class="clearfix"></div>
                                                            </div><!--.form-group-->
                                                        </div><!--.col-md-8-->
                                                    </div><!--.row-->
                                                </form>
                                            </div><!--.feed-->
                                        </div><!-- .col-md-6-->
                                    </div><!-- .row -->
                                </div><!-- .container -->



<?php
    require_once("../../elements/footer.php");
