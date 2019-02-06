<!--Navbar-->


<nav class="navbar navbar-light light-blue lighten-4">

  <!-- Navbar brand -->
  <a class="navbar-brand" href="#"> <img class="img-responsive" src="/assets/img/Connect-logo-final.png" alt="connect kelownas cannabis network logo"> </a>

  <!-- Collapse button -->
  <button class="navbar-toggler toggler-example" type="button" data-toggle="collapse" data-target="#navbarSupportedContent1"
    aria-controls="navbarSupportedContent1" aria-expanded="false" aria-label="Toggle navigation"><span class="white"><i
        class="fas fa-bars"></i></span></button>

  <!-- Collapsible content -->
  <div class="collapse navbar-collapse" id="navbarSupportedContent1">

    <!-- Links -->
    <ul class="navbar-nav ml-auto">

        <?php
        //check if user is logged in, show welcome links.

            if( $_SESSION['user_logged_in']  ){
                $u = new User;
                $user = $u->get_by_id( $_SESSION['user_logged_in']);

                ?>

      <li class="nav-item active">
        <a class="nav-link" href="/">LOGIN</a>
      </li>
      <li>
         <div class="dropdown-divider"></div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/">FEED</a>
      </li>
      <li>
         <div class="dropdown-divider"></div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/users/profile.php">PROFILE</a>
      </li>
      <li>
         <div class="dropdown-divider"></div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/connect.php">CONTACT US</a>
      </li>
      <li>
         <div class="dropdown-divider"></div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/users/logout.php">LOGOUT</a>
      </li>
      <li>
         <div class="dropdown-divider"></div>
      </li>
<?php }else{ //user not logged in ?>
    <li class="nav-item active">
      <a class="nav-link" href="/">LOGIN</a>
    </li>
    <li>
       <div class="dropdown-divider"></div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="../users/signup.php">SIGN-UP</a>
    </li>
    <li>
       <div class="dropdown-divider"></div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/connect.php">CONTACT US</a>
    </li>
    <li>
       <div class="dropdown-divider"></div>
    </li>
    <?php } ?>
    </ul>
    <!-- Links -->

  <!-- Collapsible content -->

</nav>
<!--/.Navbar-->
