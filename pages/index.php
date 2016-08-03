<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>GLAA Event Manager</title>

    <link rel="shortcut icon" href="../dist/img/favicon.ico" type="image/x-icon">

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

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

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
                            <a href="report.php"><i class="fa fa-bar-chart-o fa-fw"></i> Report</a>
                        </li>

                        <li>
                            <a href="institutions.php"><i class="fa fa-university fa-fw"></i> Institutions</a>
                        </li>

                        <li>
                            <a href="participants.php"><i class="fa fa-user fa-fw"></i> Participants</a>
                        </li>

                        <li>
                            <a href="events.php"><i class="fa fa-list-alt fa-fw"></i> Events</a>
                        </li>

                        <li>
                            <a href="participations.php"><i class="fa fa-check-square-o fa-fw"></i> Participation</a>
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-cog fa-fw"></i> Settings<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="importCSV.php">Import CSV</a>
                                </li>
                                <li>
                                    <a href="backup.php">Back Up</a>
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
                        <h1 class="page-header">Overview</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->

                <div class="row">
                    <?php
                    require_once '../server_side/login.php';
                    require_once '../server_side/server_processing.php';
                    $conn = new mysqli($hn, $un, $pw, $db);
                    if ($conn->connect_error) die($conn->connect_error);

                    $conn->set_charset('utf8mb4');
                    ?>

                    <!-- Institutions -->
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-university fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php
                                        $query  = "SELECT COUNT(*) as total FROM Institutions";
                                        $result = $conn->query($query);
                                        if (!$result) 
                                            die ("Database access failed: " . $conn->error);
                                        $data=mysqli_fetch_assoc($result);
                                        ?>
                                        <div class="huge"><? echo $data['total']; ?></div>
                                        <div>Institutions</div>
                                    </div>
                                </div>
                            </div>
                            <a href="institutions.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- Participants -->
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php
                                        $query  = "SELECT COUNT(*) as total FROM Participants";
                                        $result = $conn->query($query);
                                        if (!$result) 
                                            die ("Database access failed: " . $conn->error);
                                        $data=mysqli_fetch_assoc($result);
                                        ?>
                                        <div class="huge"><? echo $data['total']; ?></div>
                                        <div>Participants</div>
                                    </div>
                                </div>
                            </div>
                            <a href="participants.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- Events -->
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list-alt fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php
                                        $query  = "SELECT COUNT(*) as total FROM Events";
                                        $result = $conn->query($query);
                                        if (!$result) 
                                            die ("Database access failed: " . $conn->error);
                                        $data=mysqli_fetch_assoc($result);
                                        ?>
                                        <div class="huge"><? echo $data['total']; ?></div>
                                        <div>Events</div>
                                    </div>
                                </div>
                            </div>
                            <a href="events.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- Participations -->
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-check-square-o fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php
                                        $query  = "SELECT COUNT(*) as total FROM Participations";
                                        $result = $conn->query($query);
                                        if (!$result) 
                                            die ("Database access failed: " . $conn->error);
                                        $data=mysqli_fetch_assoc($result);
                                        ?>
                                        <div class="huge"><? echo $data['total']; ?></div>
                                        <div>Participations</div>
                                        <?php
                                        $result->close();
                                        $conn->close();
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <a href="participations.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-2"></div>

                    <div class="col-lg-8 text-center">
                        <a href="report.php" class="btn btn-lg btn-info btn-block" type="button"><i class="fa fa-pencil"></i> Generate Report</a>
                    </div>
                    
                    <div class="col-lg-2"></div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>
