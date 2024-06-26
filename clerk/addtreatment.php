<?php 
include_once '../assets/conn/dbconnect.php';

// Redirect to the login page if the user is not logged in
if (!isset($_SESSION['userlogged'])) {
    header("Location: ../index.php");
    exit();
}
if (isset($_POST['submit'])) {
    $treatName = mysqli_real_escape_string($con, $_POST['treatName']);
    $treatDesc = mysqli_real_escape_string($con, $_POST['treatDesc']);
    $treatPrice = mysqli_real_escape_string($con, $_POST['treatPrice']);
    $treatImg = mysqli_real_escape_string($con, $_FILES["treatImg"]["name"]);

    //INSERT
    $query = " INSERT INTO treatment (  treatName, treatDesc, treatPrice, treatImg )
    VALUES ( '$treatName', '$treatDesc', '$treatPrice', '$treatImg' ) ";
    $result = mysqli_query($con, $query);

    if ($result) {
        move_uploaded_file($_FILES["treatImg"]["tmp_name"], "upload/" . $_FILES["treatImg"]["name"]);
        $_SESSION['success'] = "Dental treatment added successfully.";
    } else {
        $_SESSION['success'] = "Added fail. Please try again.";
        header('Location: treatment.php');
    }

}
?>
<html><!-- Page Heading -->
<div class="row">
                    <div class="col-lg-12">
                        <h2 class="page-header">
                            Dental Treatments
                        </h2>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-edit"></i> Dental Treatments
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- Page Heading end-->

                <!-- panel start -->
                <div class="panel panel-primary">

                    <!-- panel heading starat -->
                    <div class="panel-heading">
                        <h3 class="panel-title">Add Dental Treatment</h3>
                    </div>
                    <!-- panel heading end -->

                    <div class="panel-body">
                        <!-- panel content start -->
                        <div class="bootstrap-iso">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <form class="form-horizontal" method="post" enctype="multipart/form-data">
                                            <div class="form-group form-group-lg">
                                                <label class="control-label col-sm-2 requiredField" for="treatName">
                                                    Name
                                                    <span class="asteriskField">
                                                        *
                                                    </span>
                                                </label>
                                                <div class="col-sm-10">
                                                    <div class="input-group">
                                                        <input class="form-control" id="treatName" name="treatName"
                                                            type="text" required />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-group-lg">
                                                <label class="control-label col-sm-2 requiredField" for="treatDesc">
                                                    Description
                                                    <span class="asteriskField">
                                                        *
                                                    </span>
                                                </label>
                                                <div class="col-sm-10">
                                                    <div class="input-group">
                                                        <input class="form-control" id="treatDesc" name="treatDesc"
                                                            type="textarea" required />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-group-lg">
                                                <label class="control-label col-sm-2 requiredField" for="treatPrice">
                                                    Price
                                                    <span class="asteriskField">
                                                        *
                                                    </span>
                                                </label>
                                                <div class="col-sm-10">
                                                    <div class="input-group">
                                                        <input class="form-control" id="treatPrice" name="treatPrice"
                                                            type="text" required />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-group-lg">
                                                <label class="control-label col-sm-2 requiredField" for="treatImage">
                                                    Image
                                                    <span class="asteriskField">
                                                        *
                                                    </span>
                                                </label>
                                                <div class="col-sm-10">
                                                    <input type="file" id="treatImg" name="treatImg" required />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-10 col-sm-offset-2">
                                                    <button class="btn btn-primary" name="submit" type="submit">
                                                        Submit
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- panel content end -->
                        <!-- panel end -->
                    </div>
                </div>
</html>