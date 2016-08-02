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

    <!-- DataTables CSS -->
    <link href="../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    
    <!-- DataTables Buttons CSS -->
    <link href="../bower_components/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../bower_components/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">

    <!-- Selectize CSS -->
    <link href="../bower_components/selectize/dist/css/selectize.bootstrap3.css" rel="stylesheet">

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

    <!-- DataTables JavaScript -->
    <script src="../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    
    <!-- DataTables Buttons JavaScript -->
    <script src="../bower_components/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../bower_components/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="../bower_components/datatables.net-buttons/js/buttons.html5.min.js"></script>

    <!-- DataTables Responsive JavaScript -->
    <script src="../bower_components/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../bower_components/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>

    <!-- Selectize JavaScript -->
    <script src="../bower_components/selectize/dist/js/standalone/selectize.min.js"></script>

    <!-- Bootbox JavaScript -->
    <script src="../bower_components/bootbox.js/bootbox.js"></script>

    <!-- jQuery Validation JavaScript -->
    <script src="../bower_components/jquery-validation/dist/jquery.validate.min.js"></script>

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
                                    <a href="importCSV.php">Import File</a>
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

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Report</h1>                   
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Filters
                        </div>
                        <div class="panel-body">
                            <form id="reportForm" method="post" class="form-horizontal">
                                <?php
                                require_once '../server_side/login.php';
                                require_once '../server_side/server_processing.php';
                                $conn = new mysqli($hn, $un, $pw, $db);
                                if ($conn->connect_error) die($conn->connect_error);

                                $conn->set_charset('utf8mb4');
                                ?>
                                <div class="row">
                                    <div class="col-lg-6">

                                        <!-- Choose Institution -->
                                        <div class="form-group">
                                            <label class="col-xs-4 control-label">Choose institution:</label>
                                            <div class="col-xs-8">
                                                <select id="select-institution" name="selectInstitution" class="form-control" required>
                                                    <option value="-1">-All-</option>
                                                    <?php
                                                    $query  = "SELECT InstitutionID, Institution FROM Institutions";
                                                    $result = $conn->query($query);
                                                    if (!$result) 
                                                        die ("Database access failed: " . $conn->error);

                                                    $rows = $result->num_rows;
                                                    for ($j = 0 ; $j < $rows ; ++$j)
                                                    {
                                                        $result->data_seek($j);
                                                        $row = $result->fetch_array(MYSQLI_ASSOC);
                                                        ?>
                                                        <option value="<? echo $row['InstitutionID']; ?>" ><? echo $row['Institution']; ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <script>
                                                var $selectizeInstitution = $('#select-institution').selectize({
                                                    sortField: {
                                                        field: 'text',
                                                        direction: 'asc'
                                                    }
                                                });
                                                var controlSelectIns = $selectizeInstitution[0].selectize;
                                            </script>
                                        </div>

                                        <!-- Choose Year -->
                                        <div class="form-group">
                                            <label class="col-xs-4 control-label">Choose year:</label>
                                            <div class="col-xs-8">
                                                <select id="select-year" name="selectYear" class="form-control">
                                                    <option value="-1">-All-</option>
                                                </select>
                                            </div>
                                            <script>
                                                // fill year options
                                                for (var i = new Date().getFullYear(); i >= 2015; i--) {
                                                    $('#select-year').append($('<option />').val( i.toString()+"-"+(i+1).toString().substring(2) ).html( i.toString()+"-"+(i+1).toString().substring(2) ));
                                                }
                                                // selectize
                                                var $selectizeYear = $('#select-year').selectize({
                                                    sortField: {
                                                        field: 'text',
                                                        direction: 'desc'
                                                    }
                                                });
                                                var controlSelectYear = $selectizeYear[0].selectize;
                                            </script>
                                        </div>
                                    </div>
                                    <!-- /.col-lg-6 (nested) -->
                                    <div class="col-lg-6">

                                        <!-- Choose Event -->
                                        <div class="form-group">
                                            <label class="col-xs-4 control-label">Choose event:</label>
                                            <div class="col-xs-8">
                                                <select id="select-event" name="selectEvent" class="form-control">
                                                    <option value="-1">-All-</option>
                                                    <?php
                                                    $query  = "SELECT EventID, Name FROM Events";
                                                    $result = $conn->query($query);
                                                    if (!$result) 
                                                        die ("Database access failed: " . $conn->error);

                                                    $rows = $result->num_rows;
                                                    for ($j = 0 ; $j < $rows ; ++$j)
                                                    {
                                                        $result->data_seek($j);
                                                        $row = $result->fetch_array(MYSQLI_ASSOC);
                                                        ?>
                                                        <option value="<? echo $row['EventID']; ?>" ><? echo $row['Name']; ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <script>
                                                var $selectizeEvent = $('#select-event').selectize({
                                                    sortField: {
                                                        field: 'text',
                                                        direction: 'asc'
                                                    }
                                                });
                                                var controlSelectEv = $selectizeEvent[0].selectize;
                                            </script>
                                        </div>

                                        <!-- Choose host -->
                                        <div class="form-group">
                                            <label class="col-xs-4 control-label">Choose host:</label>
                                            <div class="col-xs-8">
                                                <select id="select-host" name="selectHost" class="form-control">
                                                    <option value="-1">-All-</option>
                                                    <?php
                                                    $query  = "SELECT ins.InstitutionID, ins.Institution FROM Institutions ins LEFT JOIN Events ev ON ev.HostID = ins.InstitutionID WHERE ev.HostID IS NOT NULL";
                                                    $result = $conn->query($query);
                                                    if (!$result) 
                                                        die ("Database access failed: " . $conn->error);

                                                    $rows = $result->num_rows;
                                                    for ($j = 0 ; $j < $rows ; ++$j)
                                                    {
                                                        $result->data_seek($j);
                                                        $row = $result->fetch_array(MYSQLI_ASSOC);
                                                        ?>
                                                        <option value="<? echo $row['InstitutionID']; ?>" ><? echo $row['Institution']; ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <script>
                                                var $selectizeHost = $('#select-host').selectize({
                                                    sortField: {
                                                        field: 'text',
                                                        direction: 'asc'
                                                    }
                                                });
                                                var controlSelectHost = $selectizeHost[0].selectize;
                                            </script>
                                        </div>
                                    </div>
                                    <!-- /.col-lg-6 (nested) -->

                                    <div class="col-lg-12 text-center">
                                        <button type="submit" class="btn btn-primary" type="button"><i class="fa fa-search"></i> Search</button>
                                        <button type="submit" id="form-reset" class="btn btn-default" type="button"> Reset</button>
                                    </div>
                                    
                                </div>
                                <!-- /.row (nested) -->
                            </form>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->

                    <!-- Alert Placeholder-->
                    <div id="alert-holder" style="display: none"></div>

                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="reportTable">
                            <thead>
                                <tr>
                                    <th>Institution</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Role</th>
                                    <th>Title</th>
                                    <th>Email</th>
                                    <th>Event</th>
                                    <th>Academic Year</th>
                                    <th>Description</th>
                                    <th>Host</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $query = "SELECT * FROM Participations";
                            if (isset($_POST['selectInstitution']) || isset($_POST['selectEvent']) || isset($_POST['selectYear']) || isset($_POST['selectHost'])) {
                                $query = updateReport();
                            }
                            $result = $conn->query($query);
                            if (!$result) 
                                die ("Database access failed: " . $conn->error);

                            $rows = $result->num_rows;
                            for ($j = 0 ; $j < $rows ; ++$j)
                            {
                                $result->data_seek($j);
                                $row = $result->fetch_array(MYSQLI_ASSOC);
                                $paInfo = getInstitutionByType($conn, $row['ParticipantID'], "paAll");
                                $evInfo = getInstitutionByType($conn, $row['EventID'], "evAll");
                                ?>
                                <tr>
                                    <td><? echo $paInfo['Institution']; ?></td>
                                    <td><? echo $paInfo['FirstName']; ?></td>
                                    <td><? echo $paInfo['LastName'] ?></td>
                                    <td><? echo $paInfo['Role'] ?></td>
                                    <td><? echo $paInfo['Title'] ?></td>
                                    <td><? echo $paInfo['Email'] ?></td>
                                    <td><? echo $evInfo['Name']; ?></td>
                                    <td><? echo $evInfo['AcademicYear']; ?></td>
                                    <td><? echo $evInfo['Description']; ?></td>
                                    <td><? echo $evInfo['Host']; ?></td>
                                </tr>
                                <?php
                            }
                            ?>   
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Custom JavaScript -->
    <script src="../js/scripts.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Scripts -->
    <script>
        $(document).ready(function() {            
            loadReportFilters();
            $('#form-reset').click(function() {
                controlSelectIns.setValue(-1);
                controlSelectEv.setValue(-1);
                controlSelectYear.setValue(-1);
                controlSelectHost.setValue(-1);
            });
            var table = $('#reportTable').DataTable( {
                "lengthChange": false,
                "language": {
                    "emptyTable": "No record available"
                },
                "autoWidth": false,
                "columns": [ 
                    { "width": "10%" },
                    { "width": "5%" },
                    { "width": "5%" },
                    { "width": "5%" },
                    { "width": "10%" },
                    { "width": "10%" },
                    { "width": "10%" },
                    { "width": "5%" },
                    { "width": "25%" },
                    { "width": "10%" }
                ],
                order: [
                    [ 7, 'asc' ],
                    [ 1, 'asc' ]
                ],
                responsive: true,
                initComplete: function(){
                    var api = this.api();
                    new $.fn.dataTable.Buttons(api, {
                        buttons: [
                            {
                                extend: 'csvHtml5',
                                text: 'Convert to CSV',
                                className: 'btn btn-success'
                            }
                        ]
                    });
                    api.buttons().container().appendTo( '#' + api.table().container().id + ' .col-sm-6:eq(0)' );  
                }
            } );

            /** 
            * Form validation code
            */
            var validatorReport = $('#reportForm').validate({
                ignore: ':hidden:not([class~=selectized]),:hidden > .selectized, .selectize-control .selectize-input input',
                rules: {
                    selectInstitution: {
                        required: true
                    },
                    selectEvent: {
                        required: true
                    },
                    selectYear: {
                        required: true
                    },
                    selectHost: {
                        required: true
                    }
                },
                highlight: function(element) {
                    $(element).closest('.form-group').addClass('has-error');
                },
                unhighlight: function(element) {
                    $(element).closest('.form-group').removeClass('has-error');
                },
                errorElement: 'span',
                errorClass: 'help-block',
                errorPlacement: function(error, element) {
                    if(element.parent('.input-group').length) {
                        error.insertAfter(element.parent());
                    } else {
                        error.insertAfter(element);
                    }
                }
            });
        });
    </script>

</body>

</html>
