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

    <!-- DataTables Select CSS -->
    <link href="../bower_components/datatables.net-select-bs/css/select.bootstrap.min.css" rel="stylesheet">

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
    
    <!-- DataTables Selects JavaScript -->
    <script src="../bower_components/datatables.net-select/js/dataTables.select.min.js"></script>

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
                    
                    <!-- Alert Placeholder-->
                    <div id="alert-holder" style="display: none"></div>

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
                                    <td><? echo $evInfo['Host']; ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->

                    <!-- Participation by participant form -->
                    <form id="participationByPaForm" method="post" class="form-horizontal" style="display: none; margin: 0px 100px;">
                        <input type="hidden" name="participantID">
                        <input type="hidden" name="eventID">
                        <!-- Select participant -->
                        <div class="form-group">
                            <label class="control-label" style="padding-bottom: 6px;">Select Participant</label>
                            <select id="select-participant" name="select-participant" class="form-control" placeholder="Select participant" required>
                                <option>Select participant</option>
                                <?php
                                $query  = "SELECT ParticipantID, FirstName, LastName FROM Participants";
                                $result = $conn->query($query);
                                if (!$result) 
                                    die ("Database access failed: " . $conn->error);

                                $rows = $result->num_rows;
                                for ($j = 0 ; $j < $rows ; ++$j)
                                {
                                    $result->data_seek($j);
                                    $row = $result->fetch_array(MYSQLI_ASSOC);
                                    ?>
                                    <option value="<? echo $row['ParticipantID']; ?>" ><? echo $row['FirstName'] . " " . $row['LastName']; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <script>
                            $('#select-participant').selectize({
                                sortField: {
                                    field: 'text',
                                    direction: 'asc'
                                }
                            });
                        </script>
                        <!-- /.Select participant -->

                        <!-- Select event -->
                        <div class="form-group">
                            <label class="control-label" style="padding-bottom: 6px;">Select Events</label>
                            <select id="select-events" name="select-events" multiple class="form-control" placeholder="Select events" required>
                                <option>Select events</option>
                            </select>
                        </div>
                        <script>
                            $('#select-events').selectize({
                                sortField: {
                                    field: 'text',
                                    direction: 'asc'
                                }
                            });
                            // get events that the selected participant can attend
                            $('#select-participant').change(function() {
                                var pa_selected = $('#select-participant').val();
                                
                                if (pa_selected) {
                                    var formdata = {
                                        file: "participations",
                                        participantID: pa_selected
                                    };
                                    
                                    $.ajax( {
                                        type: 'POST',
                                        url: '../server_side/server_processing.php',
                                        data: formdata,
                                        dataType: 'JSON',
                                        success: function(data) {
                                            var selector = $('#select-events').selectize()[0].selectize;
                                            selector.clearOptions();
                                            $.each(data, function(){
                                                selector.addOption([{
                                                    value: this.EventID,
                                                    text: this.Name
                                                }]);
                                            } );
                                        }
                                    } );
                                }
                            });
                        </script>
                        <button type="submit" id="form-update" class="hidden"></button>
                    </form>
                    <!-- /hidden form -->


                    <!-- Participation by event form -->
                    <form id="participationByEvForm" method="post" class="form-horizontal" style="display: none; margin: 0px 100px;">
                        <input type="hidden" name="participantID">
                        <input type="hidden" name="eventID">
                        <!-- Select participant -->
                        <div class="form-group">
                            <label class="control-label" style="padding-bottom: 6px;">Select Event</label>
                            <select id="select-event" name="select-event" class="form-control" placeholder="Select event" required>
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
                        <script>
                            $('#select-event').selectize({
                                sortField: {
                                    field: 'text',
                                    direction: 'asc'
                                }
                            });
                        </script>
                        <!-- /.Select participant -->

                        <!-- Select event -->
                        <div class="form-group">
                            <label class="control-label" style="padding-bottom: 6px;">Select Events</label>
                            <select id="select-participants" name="select-participants" multiple class="form-control" placeholder="Select participants" required>
                                <option>Select participants</option>
                            </select>
                        </div>
                        <script>
                            $('#select-participants').selectize({
                                sortField: {
                                    field: 'text',
                                    direction: 'asc'
                                }
                            });
                            // get participants that the selected event can have
                            $('#select-event').change(function() {
                                var ev_selected = $('#select-event').val();
                                
                                if (ev_selected) {
                                    var formdata = {
                                        file: "participations",
                                        eventID: ev_selected
                                    };
                                    
                                    $.ajax( {
                                        type: 'POST',
                                        url: '../server_side/server_processing.php',
                                        data: formdata,
                                        dataType: 'JSON',
                                        success: function(data) {
                                            var selector = $('#select-participants').selectize()[0].selectize;
                                            selector.clearOptions();
                                            $.each(data, function(){
                                                selector.addOption([{
                                                    value: this.ParticipantID,
                                                    text: this.FirstName + " " + this.LastName
                                                }]);
                                            } );
                                        }
                                    } );
                                }
                            });
                        </script>
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

    <!-- Custom JavaScript -->
    <script src="../js/scripts.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
        $(document).ready(function() {
            checkAlert();
            var table = $('#participationsTable').DataTable( {
                "lengthChange": false,
                "language": {
                    "emptyTable": "There is no participation at this point"
                },
                "autoWidth": false,
                "columns": [ 
                    { "width": "5%" }, 
                    { "width": "0%" },
                    { "width": "17%" }, 
                    { "width": "15%" }, 
                    { "width": "0%" },
                    { "width": "25%" },
                    { "width": "5%" },
                    { "width": "17%" }
                ],
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
                                text: 'Add By Participant',
                                action: function ( e, dt, node, config ) {
                                    bootbox
                                        .dialog({
                                            title: 'Add participation',
                                            message: $('#participationByPaForm'),
                                            buttons: {
                                                add: {
                                                    label: 'Add',
                                                    className: 'btn btn-success',
                                                    callback: function() {
                                                        if (!$('#participationByPaForm').valid()) {
                                                            return false;
                                                        }
                                                        $('#form-update').val("add").end();
                                                        $('button#form-update').click();
                                                    }
                                                },
                                                cancel: {
                                                    label: 'Cancel',
                                                    className: 'btn btn-default',
                                                    callback: function() {
                                                        $('#participationByPaForm').closest('form')[0].reset();
                                                    }
                                                }
                                            },
                                            show: false
                                        })
                                        .on('show.bs.modal', function() {
                                            $('#participationByPaForm').show();
                                        })
                                        .on('hide.bs.modal', function(e) {
                                            $('#participationByPaForm').hide().appendTo('body');
                                        })
                                        .modal('show');
                                }
                            },
                            {
                                text: 'Add By Event',
                                action: function ( e, dt, node, config ) {
                                    bootbox
                                        .dialog({
                                            title: 'Add participation',
                                            message: $('#participationByEvForm'),
                                            buttons: {
                                                add: {
                                                    label: 'Add',
                                                    className: 'btn btn-success',
                                                    callback: function() {
                                                        if (!$('#participationByEvForm').valid()) {
                                                            return false;
                                                        }
                                                        $('#form-update').val("add").end();
                                                        $('button#form-update').click();
                                                    }
                                                },
                                                cancel: {
                                                    label: 'Cancel',
                                                    className: 'btn btn-default',
                                                    callback: function() {
                                                        $('#participationByEvForm').closest('form')[0].reset();
                                                    }
                                                }
                                            },
                                            show: false
                                        })
                                        .on('show.bs.modal', function() {
                                            $('#participationByEvForm').show();
                                        })
                                        .on('hide.bs.modal', function(e) {
                                            $('#participationByEvForm').hide().appendTo('body');
                                        })
                                        .modal('show');
                                }
                            },
                            {
                                text: 'Edit',
                                action: function ( e, dt, node, config ) {
                                    var rowData = dt.row( { selected: true } ).data();
                                    $('#participationByPaForm').find('[name="participantID"]').val(rowData[1]).end();
                                    $('select[name=select-institution] option').filter(function() {
                                        return $(this).text() == rowData[2]; 
                                    }).prop('selected', true);
                                    $('select[name=select-institution]').prop('disabled', true);
                                    $('#select-participants-group').hide();
                                    $('#participant-group').show();
                                    $('#participationForm').find('[name="participant"]').text(rowData[3]).end();
                                    $('#participationForm').find('[name="eventID"]').val(rowData[4]).end();
                                    $('select[name=select-event] option').filter(function() {
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
                                                        if (!$('#participationForm').valid()) {
                                                            return false;
                                                        }
                                                        $('#form-update').val("update").end();
                                                        $('button#form-update').click();
                                                    }
                                                },
                                                cancel: {
                                                    label: 'Cancel',
                                                    className: 'btn btn-default',
                                                    callback: function() {
                                                        $('#participationForm').closest('form')[0].reset();
                                                        $('select[name=select-institution]').prop('disabled', false);
                                                        $('#participant-group').hide();
                                                        $('#select-participants-group').show();
                                                    }
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

            $('#participationByPaForm').validate({
                ignore: ':hidden:not([class~=selectized]),:hidden > .selectized, .selectize-control .selectize-input input',
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

            $('#participationByEvForm').validate({
                ignore: ':hidden:not([class~=selectized]),:hidden > .selectized, .selectize-control .selectize-input input',
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
