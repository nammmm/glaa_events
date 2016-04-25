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

    <!-- DataTables CSS -->
    <link href="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.1.2/css/buttons.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.1.2/css/select.bootstrap.min.css">

    <!-- DataTables Responsive CSS -->
    <link href="../bower_components/datatables-responsive/css/responsive.dataTables.min.css" rel="stylesheet">

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
                            <a href="institutions.php"><i class="fa fa-university fa-fw"></i> Institutions</a>
                        </li>

                        <li>
                            <a href="participants.php"><i class="fa fa-user fa-fw"></i> Participants</a>
                        </li>

                        <li>
                            <a href="events.php"><i class="fa fa-list-alt fa-fw"></i> Events</a>
                        </li>

                        <li>
                            <a href="participation.php"><i class="fa fa-check-square-o fa-fw"></i> Participation</a>
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

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Participations</h1>                   
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="participationsTable">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>ParticipantID</th>
                                    <th>Institution</th>
                                    <th>Name</th>
                                    <th>EventID</th>
                                    <th>Event</th>
                                    <th>Academic Year</th>
                                    <th>Host</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            require_once '../server_side/login.php';
                            require_once '../server_side/server_processing.php';
                            $conn = new mysqli($hn, $un, $pw, $db);
                            if ($conn->connect_error) die($conn->connect_error);

                            $query  = "SELECT * FROM Participations";
                            $result = $conn->query($query);
                            if (!$result) 
                                die ("Database access failed: " . $conn->error);

                            $rows = $result->num_rows;
                            for ($j = 0 ; $j < $rows ; ++$j)
                            {
                                $result->data_seek($j);
                                $row = $result->fetch_array(MYSQLI_ASSOC);
                                $paInfo = getInstitutionByType($conn, $row['ParticipantID'], "pa");
                                $evInfo = getInstitutionByType($conn, $row['EventID'], "ev");
                                ?>
                                <tr>
                                    <td></td>
                                    <td><? echo $row['ParticipantID']; ?></td>
                                    <td><? echo $paInfo['Institution']; ?></td>
                                    <td><? echo $paInfo['FirstName'] . " " . $paInfo['LastName']; ?></td>
                                    <td><? echo $row['EventID']; ?></td>
                                    <td><? echo $evInfo['Name']; ?></td>
                                    <td><? echo $evInfo['AcademicYear']; ?></td>
                                    <td><? echo $evInfo['Institution']; ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->

                    <!-- The form which is used to populate the item data -->
                    <form id="participationForm" method="post" class="form-horizontal" style="display: none;">
                        <input type="hidden" name="participantID">
                        <input type="hidden" name="eventID">
                        <div class="form-group">
                            <label class="col-xs-4 control-label">Event:</label>
                            <div class="col-xs-8">
                                <select name="event-select" class="form-control">
                                    <option>Select event</option>
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
                        </div>
                        <div class="form-group">
                            <label class="col-xs-4 control-label">Institution:</label>
                            <div class="col-xs-8">
                                <select name="institution-select" class="form-control">
                                    <option>Select institution</option>
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
                                    $result->close();
                                    $conn->close();
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div id="participants-select-group" class="form-group">
                            <label class="col-xs-4 control-label">Participants:</label>
                            <div class="col-xs-8">
                                <select name="participants-select" multiple class="form-control">
                                </select>
                            </div>
                        </div>
                        <div id="participant-group" class="form-group" style="display: none">
                            <label class="col-xs-4 control-label">Participant:</label>
                            <div class="col-xs-8">
                                <input name="participant" type="text" class="form-control" disabled="true">
                            </div>
                        </div>
                        <button type="submit" id="form-update" class="hidden"></button>
                    </form>
                    <!-- /hidden form -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
    
    <!-- DataTables Buttons -->
    <script src="https://cdn.datatables.net/buttons/1.1.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.bootstrap.min.js"></script>
    
    <!-- DataTables Selects -->
    <script src="https://cdn.datatables.net/select/1.1.2/js/dataTables.select.min.js"></script>

    <!-- Bootbox JavaScript -->
    <script src="../js/bootboxjs/bootbox.min.js"></script>

    <!-- Custom JavaScript -->
    <script src="../js/scripts.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
        $(document).ready(function() {
            var table = $('#participationsTable').DataTable( {
                "lengthChange": false,
                "language": {
                    "emptyTable": "There is no participation at this point"
                },
                columnDefs: [ 
                    {
                        orderable: false,
                        className: 'select-checkbox',
                        targets: 0
                    },
                    {   
                        visible: false,
                        targets: [1, 4]
                    } 
                ],
                select: {
                    style: 'os'
                },
                order: [[ 1, 'asc' ]],
                responsive: true,
                initComplete: function(){
                    var api = this.api();
                    new $.fn.dataTable.Buttons(api, {
                        buttons: [
                            {
                                text: 'New',
                                action: function ( e, dt, node, config ) {
                                    bootbox
                                        .dialog({
                                            title: 'Add participation',
                                            message: $('#participationForm'),
                                            buttons: {
                                                add: {
                                                    label: 'Add',
                                                    className: 'btn btn-success',
                                                    callback: function() {
                                                        $('#form-update').val("add").end();
                                                        $('button#form-update').click();
                                                    }
                                                },
                                                cancel: {
                                                    label: 'Cancel',
                                                    className: 'btn btn-default'
                                                }
                                            },
                                            show: false
                                        })
                                        .on('show.bs.modal', function() {
                                            $('#participationForm').show();
                                        })
                                        .on('hide.bs.modal', function(e) {
                                            $('#participationForm').hide().appendTo('body');
                                        })
                                        .modal('show');
                                }
                            },
                            {
                                text: 'Edit',
                                action: function ( e, dt, node, config ) {
                                    var rowData = dt.row( { selected: true } ).data();
                                    $('#participationForm').find('[name="participantID"]').val(rowData[1]).end();
                                    $('select[name=institution-select] option').filter(function() {
                                        return $(this).text() == rowData[2]; 
                                    }).prop('selected', true);
                                    $('select[name=institution-select]').prop('disabled', true);
                                    $('#participants-select-group').hide();
                                    $('#participant-group').show();
                                    $('#participationForm').find('[name="participant"]').val(rowData[3]).end();
                                    $('#participationForm').find('[name="eventID"]').val(rowData[4]).end();
                                    $('select[name=event-select] option').filter(function() {
                                        return $(this).text() == rowData[5]; 
                                    }).prop('selected', true);
                                    
                                    bootbox
                                        .dialog({
                                            title: 'Edit participation',
                                            message: $('#participationForm'),
                                            buttons: {
                                                update: {
                                                    label: 'Update',
                                                    className: 'btn btn-primary',
                                                    callback: function() {
                                                        $('#form-update').val("update").end();
                                                        $('button#form-update').click();
                                                    }
                                                },
                                                cancel: {
                                                    label: 'Cancel',
                                                    className: 'btn btn-default'
                                                }
                                            },
                                            show: false
                                        })
                                        .on('show.bs.modal', function() {
                                            $('#participationForm').show();
                                        })
                                        .on('hide.bs.modal', function(e) {
                                            $('#participationForm').hide().appendTo('body');
                                        })
                                        .modal('show');
                                },
                                enabled: false
                            },
                            {
                                text: 'Delete',
                                action: function ( e, dt, node, config ) {
                                    var rowData = dt.row( { selected: true } ).data();
                                    $('#participationForm').find('[name="participantID"]').val(rowData[1]).end();
                                    $('#participationForm').find('[name="eventID"]').val(rowData[4]).end();

                                    bootbox
                                        .confirm( {
                                            title: 'Delete',
                                            message: 'Are you sure?',
                                            reorder: true,
                                            buttons: {
                                                confirm: {
                                                    label: 'Delete',
                                                    className: 'btn btn-success'
                                                },
                                                cancel: {
                                                    label: 'No',
                                                    className: 'btn btn-danger'
                                                }
                                            },
                                            callback: function(result) {
                                                if (result) {
                                                    $('#form-update').val("delete").end();
                                                    $('button#form-update').click();
                                                }
                                            }
                                        } );
                                },
                                enabled: false
                            }
                        ]
                    });
                    api.buttons().container().appendTo( '#' + api.table().container().id + ' .col-sm-6:eq(0)' );  
                }
            } );

            table.on( 'select', function () {
                table.button( 1 ).enable();
                table.button( 2 ).enable();
            } );

            table.on( 'deselect', function () {
                table.button( 1 ).disable();
                table.button( 2 ).disable();
            } );

            $('select[name=event-select]').change(function() {
                var ev_selected = $('select[name=event-select]').val();
                var ins_selected = $('select[name=institution-select]').val();
                if (ev_selected !== "Select event") {
                    var formdata = {
                            eventID: ev_selected,
                            institutionID: ins_selected
                    };
                    
                    $.ajax( {
                        type: 'POST',
                        url: '../server_side/server_processing.php',
                        data: formdata,
                        dataType: 'JSON',
                        success: function(data) {
                            $('select[name=participants-select]').html('');
                            var dataCount = data.length;
                            if (dataCount > 4) {
                                $('select[name=participants-select]').size('8');
                            }
                            $.each(data, function(){
                                $('select[name=participants-select]').append('<option value="'+ this.ParticipantID +'">'+ this.FirstName + ' ' + this.LastName +'</option>')
                            } );
                        }
                    } );
                }
            });

            $('select[name=institution-select]').change(function() {
                var pa_selects = $('select[name=participants-select] option').length;
                var ins_selected = $('select[name=institution-select]').val();
                var ev_selected = $('select[name=event-select]').val();
                if (pa_selects != 0 && ev_selected !== "Select event" && ins_selected !== "Select institution") {
                    var formdata = {
                            eventID: ev_selected,
                            institutionID: ins_selected
                    };
                    
                    $.ajax( {
                        type: 'POST',
                        url: '../server_side/server_processing.php',
                        data: formdata,
                        dataType: 'JSON',
                        success: function(data) {
                            $('select[name=participants-select]').html('');
                            $.each(data, function(){
                                $('select[name=participants-select]').append('<option value="'+ this.ParticipantID +'">'+ this.FirstName + ' ' + this.LastName +'</option>')
                            } );
                        }
                    } );
                }
            });
        });
    </script>

</body>

</html>
