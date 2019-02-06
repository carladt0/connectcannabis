<?php  require_once("../../core/includes.php");
    // unique html head vars
    $title = 'Kelowna&#8217;s Cannabis Network | CONNECT Sign-Up';
    require_once("../../elements/html_head.php");
    require_once("../../elements/nav.php");
?>

<!--SIGNUP FORM-->
    <div class="container-fluid signup-container">
        <div class="row">
            <div class="col-md-6">
            </div><!-- .col-md-6-->

            <div class="col-md-6">
                <div class="signup-form">
                <h2>SIGN-UP:</h2>

                <?= !empty($_SESSION['create_acc_msg']) ? $_SESSION['create_acc_msg'] : '' ?>

                    <form id="sign-up-form" action="add.php" method="post">
                        <div id="form-closer" class="form-group">
                            <input class="form-control" type="text" name="firstname" placeholder="FIRST NAME"required>
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="text" name="lastname" placeholder="LAST NAME"required>
                        </div>
                        <div id="form-closer" class="form-group">
                            <input class="form-control" type="username" name="username" placeholder="USERNAME"required>
                        </div>
                        <div id="form-closer" class="form-group">
                            <input class="form-control" type="password" name="password" placeholder="PASSWORD"required>
                        </div>
                        <div id="form-closer" class="form-group">
                            <input class="form-control" type="email" name="email" placeholder="EMAIL"required>
                        </div>
                        <p class="agree-terms"><input class="checkbox" type="checkbox" name="agree" value="Agree"> I agree to CONNECT's <a href="https://www.facebook.com/terms.php">terms and conditions</a></p>
                        <input class="btn connect-btn" type="submit" value="SUBMIT">
                    </form>
                </div><!-- .signup-form-->
            </div><!-- .col-md-6-->
        </div><!-- .row-->
    </div><!-- .container-fluid-->




<?php
    require_once("../../elements/footer.php");
