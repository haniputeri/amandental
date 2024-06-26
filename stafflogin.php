<?php
include_once 'assets/conn/dbconnect.php';

if (isset($_POST['login'])) {
    $staffid = mysqli_real_escape_string($con, $_POST['staffid']);
    $staffPass = mysqli_real_escape_string($con, $_POST['password']);

    $res = mysqli_query($con, "SELECT * FROM staff WHERE staffid = '$staffid'");
    $row = mysqli_fetch_array($res, MYSQLI_ASSOC);

    if ($row['staffPass'] == $staffPass)
{
        session_start();
        $_SESSION['userlogged'] = 1;

        if ($row['staffType'] == 1) {
            $_SESSION['staffid'] = $row['staffid'];
            $_SESSION['staffFirstName'] = $row['staffFirstName'];
            $_SESSION['staffLastName'] = $row['staffLastName'];
            echo $_SESSION['staffFirstName'];
            echo $_SESSION['staffLastName'];
            header("Location: clerk/clerkdashboard.php");
            exit;
        } elseif ($row['staffType'] == 2) {
            $_SESSION['staffid'] = $row['staffid'];
            $_SESSION['staffFirstName'] = $row['staffFirstName'];
            $_SESSION['staffLastName'] = $row['staffLastName'];
            echo $_SESSION['staffFirstName'];
            echo $_SESSION['staffLastName'];
            header("Location: doctor/doctordashboard.php");
            exit;
        }

        echo $_SESSION['staffTypeName'] = $row['staffTypeName'];
    } else {
        echo "<script language='javascript'>alert('Invalid staffID or password.');window.location='stafflogin.php';</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Aman Dental | Staff Login</title>
        <!-- Bootstrap -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/css/style.css" rel="stylesheet">
        <style>
        .card {
            /* Add shadows to create the "card" effect */
            max-width: 350px;
            height: 300px;
            text-align: center;
            padding: 10px 16px;
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
            transition: 0.3s;
            border-radius: 5px; /* 5px rounded corners */
        }
        
        /* On mouse-over, add a deeper shadow */
        .card:hover {
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
        }
        
        /* Add rounded corners to the top left and the top right corner of the image */
        /* img {
            border-radius: 5px 5px 0 0;
        } */
    </style>
    </head>
    <body>
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php"><img alt="Brand" src="assets/img/adlogo.png" height="45px"></a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    
                    
                    <ul class="nav navbar-nav navbar-right">
                        

                        <!-- <li><a href="adminlogin.php">Admin</a></li> -->
                        <li> <a href="stafflogin.php">Staff Login</a></li>
                        <li><a href="#" data-toggle="modal" data-target="#myModal">Sign Up</a></li>
                   
                        <li>
                            <p class="navbar-text">Already have an account?</p>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Login</b> <span class="caret"></span></a>
                            <ul id="login-dp" class="dropdown-menu">
                                <li>
                                    <div class="row">
                                        <div class="col-md-12">
                                            
                                            <form class="form" role="form" method="POST" accept-charset="UTF-8" >
                                                <div class="form-group">
                                                    <label class="sr-only" for="icPatient">Email</label>
                                                    <input type="text" class="form-control" name="icPatient" placeholder="IC Number" required>
                                                </div>
                                                <div class="form-group">
                                                    <label class="sr-only" for="password">Password</label>
                                                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" name="login" id="login" class="btn btn-primary btn-block">Sign in</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            <!-- start -->
            <div class="login-container">
                    <div id="output"></div>
                    <div class="avatar"></div>
                    <div class="form-box">
                        <form class="form" role="form" method="POST" accept-charset="UTF-8">
                            <h3> Welcome</h3>
                            <p>Please login with your staff ID and password</p>
                            <input name="staffid" type="text" placeholder="staff ID" required>
                            <input name="password" type="password" placeholder="Password" required>
                            <button class="btn btn-info btn-block login" type="submit" name="login">Login</button>
                        </form>
                    </div>
                </div>
            <!-- end -->
        </div>

        <script src="assets/js/jquery.js"></script>

        <!-- js start -->
        
        <!-- js end -->
    </body>
</html>