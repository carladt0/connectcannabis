<!--Login Form & Join Link-->
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-6">

            </div><!-- .col-md-6-->

            <div class="col-md-6">
                <div class="login-form">
                    <h2>LOGIN:</h2>
                    <?=!empty($_SESSION['login_attempt_msg']) ? $_SESSION['login_attempt_msg'] : '' ?>
                    <form action="users/login.php" method="post">
                        <div id="form-closer" class="form-group">
                            <input class="form-control" type="text" name="username" placeholder="username">
                        </div>
                        <div id="form-closer" class="form-group">
                            <input class="form-control" type="password" name="password" placeholder="password">
                        </div>
                        <input class="btn connect-btn" type="submit" value="SUBMIT">
                        <p class="forgot-password">forgot your password?</p>
                        <div class="clearfix"></div>
                        <p class="login-link-sign-up"><a href="/users/signup.php">SIGN-UP</a></p>
                        <div class="clearfix"></div>
                    </form>

                </div>

            </div><!-- .col-md-6-->
        </div>

            </div>
        </div><!-- .row -->
    </div><!-- .container -->
