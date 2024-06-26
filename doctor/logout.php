<?php
session_start();

if(!isset($_SESSION['userlogged']))
{
 header("Location: doctordashboard.php");
}
else if(isset($_SESSION['userlogged'])!="")
{
 header("Location: ../index.php");
}

if(isset($_GET['logout']))
{
 session_destroy();
 unset($_SESSION['userlogged']);
 header("Location: ../index.php");
}
?>