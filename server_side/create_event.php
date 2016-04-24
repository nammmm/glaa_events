<?php
require_once '../helper.php';
$errName = '';
$errDesc = '';
$errHost = '';

if (isset($_POST['submit'])) 
{
    require_once '../login.php';
    $conn = new mysqli($hn, $un, $pw, $db);
    if ($conn->connect_error) die($conn->connect_error);

    $eventName = sanitizeMySQL($conn, $_POST['eventName']);
    $description = sanitizeMySQL($conn, $_POST['description']);
    $host = sanitizeMySQL($conn, $_POST['host']);

    if (!$_POST['eventName'])
        $errName = 'Please enter an event name';

    if (strlen(sanitizeString($_POST['description']) > 255))
        $errDesc = 'Please enter less than 255 characters';

    if (!$_POST['host'])
        $errHost = 'Please enter an institution name';

    if (!$errName && !$errDesc && !$errHost) 
    {
        $query = "INSERT INTO Events (EventID, Name, Description, AcademicYear, Host)" .
        "VALUES(NULL, '$eventName', '$description', '$academicYear', '$host')";
        $result = $conn->query($query);
        if (!$result)
            phpAlert("Insert failed: " . $conn->error);
        else
            phpAlert("Insert succeeded!");
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>GLAA Event Manager</title>

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/dashboard.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">GLAA Event Manager</a>
            </div>
            <!-- /.navbar-header -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="index.php"><i class="fa fa-home fa-fw"></i> Overview</a>
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Report<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="report.php">Report 1</a>
                                </li>
                                <li>
                                    <a href="report.php">Report 2</a>
                                </li>
                                <li>
                                    <a href="report.php">Report 3</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-university fa-fw"></i> Institutions<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="institutions.php">View Institutions</a>
                                </li>
                                <li>
                                    <a href="add_institution.php">Add New</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-user fa-fw"></i> Participants<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="participants.php">View Participants</a>
                                </li>
                                <li>
                                    <a href="create_participant.php">Create New</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-list-alt fa-fw"></i> Events<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="events.php">View Events</a>
                                </li>
                                <li>
                                    <a href="create_event.php">Create New</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-check-square-o fa-fw"></i> Participation<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="participation.php">View Participation</a>
                                </li>
                                <li>
                                    <a href="add_participation.php">Add New</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-cog fa-fw"></i> Settings<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#">Import CSV</a>
                                </li>
                                <li>
                                    <a href="#">Export CSV</a>
                                </li>
                                <li>
                                    <a href="#">Back Up</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Create Event</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <!-- form -->
                <form role="form" action="create_event.php" method="post">
                    <div class="form-group">
                        <label>Event Name</label>
                        <input name="eventName" type="text" maxlength="100" class="form-control">
                        <? echo "<p class='text-danger'>$errName</p>"; ?>
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" maxlength="255" class="form-control" rows="3" placeholder="Enter description. Maximum 255 characters"></textarea>
                        <? echo "<p class='text-danger'>$errDesc</p>"; ?>
                    </div>

                    <div class="form-group">
                        <label>Academic Year</label>
                        <select name="academicYear" id="academicYear" class="form-control">
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Host Institution</label>
                        <input name="host" type="text" maxlength="100" class="form-control">
                        <? echo "<p class='text-danger'>$errHost</p>"; ?>
                    </div>
                    
                    <button type="submit" name="submit" class="btn btn-success">Submit</button>
                    <button type="reset" name="reset" class="btn btn-default">Reset</button>
                </form>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Populate Academic Year Selector -->
    <script>
        for (i = new Date().getFullYear(); i >= 2000; i--) {
            $('#academicYear').append($('<option />').val(i).html(i.toString()+"-"+(i+1).toString().substring(2)));
        }
    </script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>
