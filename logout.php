<?php
session_start();
unset($_SESSION['t_admin']);
session_destroy();
header("Location:index.php");