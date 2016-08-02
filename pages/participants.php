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
                    <h1 class="page-header">Participants</h1>                   
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    
                    <!-- Alert Placeholder-->
                    <div id="alert-holder" style="display: none"></div>

                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="participantsTable">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Participant ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Institution ID</th>
                                    <th>Institution</th>
                                    <th>Role</th>
                                    <th>Title</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            require_once '../server_side/login.php';
                            require_once '../server_side/server_processing.php';
                            $conn = new mysqli($hn, $un, $pw, $db);
                            if ($conn->connect_error) die($conn->connect_error);

                            $conn->set_charset('utf8mb4');
                            
                            $query  = "SELECT * FROM Participants";
                            $result = $conn->query($query);
                            if (!$result) 
                                die ("Database access failed: " . $conn->error);

                            $rows = $result->num_rows;
                            for ($j = 0 ; $j < $rows ; ++$j)
                            {
                                $result->data_seek($j);
                                $row = $result->fetch_array(MYSQLI_ASSOC);
                                ?>
                                <tr>
                                    <td></td>
                                    <td><? echo $row['ParticipantID']; ?></td>
                                    <td><? echo $row['FirstName']; ?></td>
                                    <td><? echo $row['LastName']; ?></td>
                                    <td><? echo $row['InstitutionID']; ?></td>
                                    <td><? echo getInstitution($conn, $row['InstitutionID']); ?></td>
                                    <td><? echo $row['Role']; ?></td>
                                    <td><? echo $row['Title']; ?></td>
                                    <td><? echo $row['Email']; ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->

                    <!-- The form which is used to populate the item data -->
                    <form id="participantForm" method="post" class="form-horizontal" style="display: none;">
                        <input type="hidden" id="participant-id">
                        <div class="form-group">
                            <label class="col-xs-4 control-label">First Name:</label>
                            <div class="col-xs-8">
                                <input id="first-name" name="firstName" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-4 control-label">Last Name:</label>
                            <div class="col-xs-8">
                                <input id="last-name" name="lastName" type="text" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-xs-4 control-label">Institution:</label>
                            <div class="col-xs-8">
                                <select id="select-institution" name="selectInstitution" class="form-control" placeholder="Select institution">
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
                        <div class="form-group">
                            <label class="col-xs-4 control-label">Role:</label>
                            <div class="col-xs-8">
                                <input id="role" name="role" type="text" class="form-control" placeholder="Optional">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-4 control-label">Title:</label>
                            <div class="col-xs-8">
                                <input id="title" name="title" type="text" class="form-control" placeholder="Optional">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-4 control-label">Email:</label>
                            <div class="col-xs-8">
                                <input id="email" name="email" type="email" class="form-control" placeholder="Optional">
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

    <!-- Custom JavaScript -->
    <script src="../js/scripts.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Scripts -->
    <script>
        var rowsData;   // global variable to hold multiple rows data
        $(document).ready(function() {
            checkAlert();
            var table = $('#participantsTable').DataTable( {
                "lengthChange": false,
                "language": {
                    "emptyTable": "There is no participant at this point",
                    buttons: {
                        selectAll: "Select all items",
                        selectNone: "Select none"
                    }
                },
                "autoWidth": false,
                "columns": [ 
                    { "width": "5%" }, 
                    { "width": "0%" },
                    { "width": "7%" },
                    { "width": "7%" },
                    { "width": "0%" }, 
                    { "width": "15%" }, 
                    { "width": "13%" }, 
                    { "width": "27%" }, 
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
                    style: 'multi'
                },
                order: [[ 1, 'asc' ]],
                responsive: true,
                initComplete: function(){
                    var api = this.api();
                    new $.fn.dataTable.Buttons(api, {
                        buttons: [
                            'selectAll',
                            'selectNone',
                            {
                                text: 'New',
                                action: function ( e, dt, node, config ) {
                                    bootbox
                                        .dialog({
                                            title: 'Add participant',
                                            message: $('#participantForm'),
                                            buttons: {
                                                add: {
                                                    label: 'Add',
                                                    className: 'btn btn-success',
                                                    callback: function() {
                                                        if (!$('#participantForm').valid()) {
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
                                                        $('#participantForm').closest('form')[0].reset();
                                                        validatorParticipant.resetForm();
                                                        controlSelectIns.clear();
                                                    }
                                                }
                                            },
                                            show: false
                                        })
                                        .on('show.bs.modal', function() {
                                            $('#participantForm').show();
                                        })
                                        .on('hide.bs.modal', function(e) {
                                            $('#participantForm').hide().appendTo('body');
                                        })
                                        .modal('show');
                                }
                            },
                            {
                                text: 'Edit',
                                action: function ( e, dt, node, config ) {
                                    var rowData = dt.row( { selected: true } ).data();
                                    $('#participant-id').val(rowData[1]).end();
                                    $('#first-name').val(rowData[2]).end();
                                    $('#last-name').val(rowData[3]).end();
                                    controlSelectIns.setValue(rowData[4]);
                                    $('#role').val(rowData[6]).end();
                                    $('#title').val(rowData[7]).end();
                                    $('#email').val(rowData[8]).end();

                                    bootbox
                                        .dialog({
                                            title: 'Edit participant',
                                            message: $('#participantForm'),
                                            buttons: {
                                                update: {
                                                    label: 'Update',
                                                    className: 'btn btn-primary',
                                                    callback: function() {
                                                        if (!$('#participantForm').valid()) {
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
                                                        $('#participantForm').closest('form')[0].reset();
                                                        validatorParticipant.resetForm();
                                                        controlSelectIns.clear();
                                                    }
                                                }
                                            },
                                            show: false
                                        })
                                        .on('show.bs.modal', function() {
                                            $('#participantForm').show();
                                        })
                                        .on('hide.bs.modal', function(e) {
                                            $('#participantForm').hide().appendTo('body');
                                        })
                                        .modal('show');
                                },
                                enabled: false
                            },
                            {
                                text: 'Delete',
                                action: function ( e, dt, node, config ) {

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
                                                    rowsData = table.rows('.selected').data().toArray();
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
                table.button( 3 ).enable();
                table.button( 4 ).enable();
            } );

            table.on( 'deselect', function () {
                var count = table.rows( { selected: true } ).count();
                if (!count) {
                    table.button( 3 ).disable();
                    table.button( 4 ).disable();
                }
            } );

            /** 
            * Form validation code
            */
            var validatorParticipant = $('#participantForm').validate({
                ignore: ':hidden:not([class~=selectized]),:hidden > .selectized, .selectize-control .selectize-input input',
                rules: {
                    firstName: {
                        maxlength: 30,
                        required: true,
                        regex: /^[A-Za-z]{1,}$/
                    },
                    lastName: {
                        maxlength: 30,
                        required: true,
                        regex: /^[A-Za-z]{1,}$/
                    },
                    selectInstitution: {
                        required: true
                    },
                    role: {
                        maxlength: 100,
                        regex: /^[A-Za-z0-9\s]{1,}$/
                    },
                    title: {
                        maxlength: 100,
                        regex: /^[A-Za-z0-9\s]{1,}$/
                    },
                    email: {
                        maxlength: 120,
                        regex: /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/
                    }
                },
                messages: {
                    email: "Please check the email format."
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
