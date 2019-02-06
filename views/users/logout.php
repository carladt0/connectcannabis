<?php
session_start();
session_destroy(); //logout
header("Location:/"); //redirect back to homepage
