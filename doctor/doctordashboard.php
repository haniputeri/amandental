<?php
session_start();
include_once '../assets/conn/dbconnect.php';

if (!isset($_SESSION['userlogged'])) {
    header("Location: ../index.php");
}

$usersession = $_SESSION['userlogged'];
$staffID = $_SESSION['staffid'];
$res = mysqli_query($con, "SELECT * FROM staff WHERE staffid=" . $usersession);
$userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);

$res = mysqli_query($con, "SELECT a.*, p.*, s.*, t.*, r.*
                            FROM appointment a
                            JOIN patient p ON a.icpatient = p.icpatient
                            JOIN schedule s ON a.schedid = s.schedid
                            JOIN treatment r ON a.treatID = r.treatID
                            JOIN staff t ON a.staffid = t.staffid
                            WHERE a.staffid = $staffID");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Welcome Dr <?php echo $_SESSION['staffFirstName']; ?> <?php echo $_SESSION['staffLastName']; ?></title>
    <!-- Bootstrap Core CSS -->
    <!-- <link href="assets/css/bootstrap.css" rel="stylesheet"> -->
    <link href="assets/css/material.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="assets/css/sb-admin.css" rel="stylesheet">
    <link href="assets/css/time/bootstrap-clockpicker.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet">
    <!-- Special version of Bootstrap that only affects content wrapped in .bootstrap-iso -->
    <!-- Custom Fonts -->
</head>
<body>
<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="doctordashboard.php">Welcome Dr <?php echo $_SESSION['staffFirstName']; ?>
                <?php echo $_SESSION['staffLastName']; ?></a>
        </div>
        <!-- Top Menu Items -->
        <ul class="nav navbar-right top-nav">


            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['staffFirstName']; ?>
                    <?php echo $_SESSION['staffLastName']; ?><b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="logout.php?logout"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <li class="active">
                    <a href="doctordashboard.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                </li>
                    
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>
    <!-- navigation end -->

    <div id="page-wrapper">
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header">
                        Patient List
                    </h2>
                    <ol class="breadcrumb">
                        <li class="active">
                            <i class="fa fa-calendar"></i> Patient List
                        </li>
                    </ol>
                </div>
            </div>
            <!-- Page Heading end-->

            <!-- panel start -->
            <div class="panel panel-primary filterable">

                <!-- panel heading starat -->
                <div class="panel-heading">
                    <h3 class="panel-title">List of Patients</h3>
                    <div class="pull-right">
                        <button class="btn btn-default btn-xs btn-filter"><span
                                    class="fa fa-filter"></span> Filter
                        </button>
                    </div>
                </div>
                <!-- panel heading end -->

                <div class="panel-body">
                    <!-- panel content start -->
                    <!-- Table -->
                    <table class="table table-hover table-bordered">
                        <thead>
                        <tr class="filters">
                            <th><input type="text" class="form-control" placeholder="patient Ic" disabled></th>
                            <th><input type="text" class="form-control" placeholder="Treatment" disabled></th>
                            <th><input type="text" class="form-control" placeholder="Name" disabled></th>
                            <th><input type="text" class="form-control" placeholder="Contact No." disabled></th>
                            <th><input type="text" class="form-control" placeholder="Email" disabled></th>
                            <th><input type="text" class="form-control" placeholder="Day" disabled></th>
                            <th><input type="text" class="form-control" placeholder="Date" disabled></th>
                            <th><input type="text" class="form-control" placeholder="Time" disabled></th>
                        </tr>
                        </thead>
                        <?php
                        if (!$res) {
                            printf("Error: %s\n", mysqli_error($con));
                            exit();
                        }
                        while ($appointment = mysqli_fetch_array($res)) {
                            echo "<tbody>";
                            echo "<tr >";
                            echo "<td>" . $appointment['icPatient'] . "</td>";
                            echo "<td>" . $appointment['treatName'] . "</td>";
                            echo "<td>" . $appointment['patientFirstName'] . " " . $appointment['patientLastName'] . "</td>";
                            echo "<td>" . $appointment['patientPhone'] . "</td>";
                            echo "<td>" . $appointment['patientEmail'] . "</td>";
                            echo "<td>" . $appointment['schedDay'] . "</td>";
                            echo "<td>" . $appointment['appDate'] . "</td>";
                            echo "<td>" . $appointment['appTime'] . "</td>";
                            echo "</form>";
                        }
                        echo "</tr>";
                        echo "</tbody>";
                        echo "</table>";

                        ?>


                        <!-- panel content end -->
                        <!-- panel end -->
                </div>
            </div>
            <!-- panel start -->

        </div>
    </div>
    <!-- /#wrapper -->


    <!-- jQuery -->
    <script src="../patient/assets/js/jquery.js"></script>
    <script type="text/javascript">
        $(function () {
            $(".delete").click(function () {
                var element = $(this);
                var ic = element.attr("id");
                var info = 'ic=' + ic;
                if (confirm("Are you sure you want to delete this?")) {
                    $.ajax({
                        type: "POST",
                        url: "deletepatient.php",
                        data: info,
                        success: function () {
                        }
                    });
                    $(this).parent().parent().fadeOut(300, function () {
                        $(this).remove();
                    });
                }
                return false;
            });
        });
    </script>
    <script type="text/javascript">
        /*
        Please consider that the JS part isn't production ready at all, I just code it to show the concept of merging filters and titles together !
        */
        $(document).ready(function () {
            $('.filterable .btn-filter').click(function () {
                var $panel = $(this).parents('.filterable'),
                    $filters = $panel.find('.filters input'),
                    $tbody = $panel.find('.table tbody');
                if ($filters.prop('disabled') == true) {
                    $filters.prop('disabled', false);
                    $filters.first().focus();
                } else {
                    $filters.val('').prop('disabled', true);
                    $tbody.find('.no-result').remove();
                    $tbody.find('tr').show();
                }
            });

            $('.filterable .filters input').keyup(function (e) {
                /* Ignore tab key */
                var code = e.keyCode || e.which;
                if (code == '9') return;
                /* Useful DOM data and selectors */
                var $input = $(this),
                    inputContent = $input.val().toLowerCase(),
                    $panel = $input.parents('.filterable'),
                    column = $panel.find('.filters th').index($input.parents('th')),
                    $table = $panel.find('.table'),
                    $rows = $table.find('tbody tr');
                /* Dirtiest filter function ever ;) */
                var $filteredRows = $rows.filter(function () {
                    var value = $(this).find('td').eq(column).text().toLowerCase();
                    return value.indexOf(inputContent) === -1;
                });
                /* Clean previous no-result if exist */
                $table.find('tbody .no-result').remove();
                /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
                $rows.show();
                $filteredRows.hide();
                /* Prepend no-result row if all rows are filtered */
                if ($filteredRows.length === $rows.length) {
                    $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="' + $table.find('.filters th').length + '">No result found</td></tr>'));
                }
            });
        });
    </script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../patient/assets/js/bootstrap.min.js"></script>
    <script src="assets/js/bootstrap-clockpicker.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <!-- script for jquery datatable start-->
    <!-- Include Date Range Picker -->
</body>
</html>
