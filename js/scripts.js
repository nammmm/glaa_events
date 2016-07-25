/***************************************************************************
 *  Form handling code
 ***************************************************************************/

$("#institutionForm").submit(function(e) {
    // cancels the form submission
    e.preventDefault();
    doAction('#institutionForm');
} );

$("#participantForm").submit(function(e) {
    // cancels the form submission
    e.preventDefault();
    doAction('#participantForm');
} );

$("#eventForm").submit(function(e) {
    // cancels the form submission
    e.preventDefault();
    doAction('#eventForm');
} );

$("#participationByPaForm").submit(function(e) {
    // cancels the form submission
    e.preventDefault();
    doAction('#participationByPaForm');
} );

$("#participationByEvForm").submit(function(e) {
    // cancels the form submission
    e.preventDefault();
    doAction('#participationByEvForm');
} );

$("#reportForm").submit(function(e) {
    saveReportFilters();
} );

// Check operation type
function doAction(form) {
    var clickType;
    if (form == "#participationByPaForm")       clickType = $('#form-update-by-pa').val();
    else if (form == "#participationByEvForm")  clickType = $('#form-update-by-ev').val();
    else                                        clickType = $('#form-update').val();

    if (clickType === "add")                addForm(form);
    else if (clickType === "update")        updateForm(form);
    else if (clickType === "delete")        deleteForm(form);
}

// Add data to database
function addForm(form) {
    var msg = "Record has been added.";
    switch(form) {
        case '#institutionForm':
            var formData = {
                table: 'Institutions',
                institutionName: $('#institution-name').val(),
                isGLCA: $('input[name=optionsRadiosInline]:checked').val()
            };
            msg = "Institution \"" + formData['institutionName'] + "\" has been added.";
            break;
        case '#participantForm':
            var formData = {
                table: 'Participants',
                firstName: $('#first-name').val(),
                lastName: $('#last-name').val(),
                institutionID: $('#select-institution').val(),
                role: $('#role').val(),
                title: $('#title').val(),
                email: $('#email').val()
            };
            msg = "Participant \"" + formData['firstName'] + " " + formData['lastName'] + "\" has been added.";
            break;
        case '#eventForm':
            var formData = {
                table: 'Events',
                eventName: $('#event-name').val(),
                description: $('#event-description').val(),
                academicYear: $('#select-year').val(),
                hostID: $('#select-institution').val()
            };
            msg = "Event \"" + formData['eventName'] + "\" has been added.";
            break;
        case '#participationByPaForm':
            var eventsSelected = $('#select-events').val() || [];
            if (eventsSelected.length > 1)
                msg = "Records have been added.";

            var JSONString = JSON.stringify(eventsSelected);
            var formData = {
                table: 'ParticipationsPa',
                participantID: $('#select-participant').val(),
                eventIDs: JSONString
            };
            break;
        case '#participationByEvForm':
            var participantsSelected = $('#select-participants').val() || [];
            if (participantsSelected.length > 1)
                msg = "Records have been added.";

            var JSONString = JSON.stringify(participantsSelected);
            var formData = {
                table: 'ParticipationsEv',
                eventID: $('#select-event').val(),
                participantIDs: JSONString
            };
            break;
        default:
            break;
    }

    var scrollPosition = $(window).scrollTop();
    $.ajax( {
        type: "POST",
        url: "../server_side/form_add.php",
        data: formData,
        success: function(text) {
            if (text == "success") {
                localStorage.setItem('form', 'true');
                localStorage.setItem('msg', msg);
                window.location.reload();
                $(window).scrollTop(scrollPosition); 
            }
            else {
                localStorage.setItem('form', 'false');
                localStorage.setItem('msg', text);
                window.location.reload();
                $(window).scrollTop(scrollPosition); 
            }                   
        }
    } );
}

// Modify data in database
function updateForm(form) {
    var msg = "Record has been updated.";
    switch(form) {
        case '#institutionForm':
            var formData = {
                table: 'Institutions',
                institutionID: $('#institution-id').val(),
                institutionName: $('#institution-name').val(),
                isGLCA: $('input[name=optionsRadiosInline]:checked').val()
            };
            msg = "Record \"" + formData['institutionName'] + "\" has been update.";
            break;
        case '#participantForm':
            var formData = {
                table: 'Participants',
                participantID: $('#participant-id').val(),
                firstName: $('#first-name').val(),
                lastName: $('#last-name').val(),
                institutionID: $('#select-institution').val(),
                role: $('#role').val(),
                title: $('#title').val(),
                email: $('#email').val()
            };
            msg = "Record \"" + formData['firstName'] + " " + formData['lastName'] + "\" has been updated.";
            break;
        case '#eventForm':
            var formData = {
                table: 'Events',
                eventID: $('#event-id').val(),
                eventName: $('#event-name').val(),
                description: $('#event-description').val(),
                academicYear: $('#select-year').val(),
                hostID: $('#select-institution').val()
            };
            msg = "Record \"" + formData['name'] + "\" has been updated.";
            break;
        case '#participationByPaForm':
            var formData = {
                table: 'Participations',
                participantID: $('#select-participant').val(),
                eventID: $('#select-events-edit').val()
            };
            break;
        case '#participationByEvForm':
            break;
        default:
            break;
    }

    var scrollPosition = $(window).scrollTop();
    $.ajax( {
        type: "POST",
        url: "../server_side/form_update.php",
        data: formData,
        success: function(text) {
            if (text == "success") {
                localStorage.setItem('form', 'true');
                localStorage.setItem('msg', msg);
                window.location.reload();
                $(window).scrollTop(scrollPosition); 
            }
            else {
                localStorage.setItem('form', 'false');
                localStorage.setItem('msg', text);
                window.location.reload();
                $(window).scrollTop(scrollPosition); 
            }                
        }
    } );
}

// Delete data
function deleteForm(form) {
    var msg = "Record has been deleted.";
    switch(form) {
        case '#institutionForm':
            var formData = {
                table: 'Institutions',
                institutionID: $('#institutionForm').find('[name="id"]').val()
            };
            msg = "Record \"" + $('#institutionForm').find('[name="institutionName"]').val() + "\" has been deleted.";
            break;
        case '#participantForm':
            var formData = {
                table: 'Participants',
                participantID: $('#participantForm').find('[name="id"]').val()
            };
            msg = "Record \"" + $('#participantForm').find('[name="firstName"]').val() + " " + $('#participantForm').find('[name="lastName"]').val() + "\" has been deleted.";
            break;
        case '#eventForm':
            var formData = {
                table: 'Events',
                eventID: $('#eventForm').find('[name="id"]').val()
            };
            msg = "Record \"" + $('#eventForm').find('[name="name"]').val() + "\" has been deleted.";
            break;
        case '#participationForm':
            var formData = {
                table: 'Participations',
                participantID: $('#participationForm').find('[name="participantID"]').val(),
                eventID: $('#participationForm').find('[name="eventID"]').val()
            };
            break;
        default:
            break;
    }

    var scrollPosition = $(window).scrollTop();
    $.ajax( {
        type: "POST",
        url: "../server_side/form_delete.php",
        data: formData,
        success: function(text) {
            if (text == "success") {
                localStorage.setItem('form', 'true');
                localStorage.setItem('msg', msg);
                window.location.reload();
                $(window).scrollTop(scrollPosition); 
            }
            else {
                localStorage.setItem('form', 'false');
                localStorage.setItem('msg', text);
                window.location.reload();
                $(window).scrollTop(scrollPosition); 
            }                     
        }
    } );
}

/***************************************************************************
 *  Report page functions
 ***************************************************************************/

function saveReportFilters() {
    localStorage.setItem('select-institution', $('select[name=select-institution]').val());
    localStorage.setItem('select-event', $('select[name=select-event]').val());
    localStorage.setItem('select-year', $('select[name=select-year]').val());
    localStorage.setItem('select-host', $('select[name=select-host]').val());
    localStorage.setItem('scrollPosition', $(window).scrollTop());
}

function loadReportFilters() {
    var selectIns = localStorage.getItem('select-institution');
    var selectEvent = localStorage.getItem('select-event');
    var selectYear = localStorage.getItem('select-year');
    var selectHost = localStorage.getItem('select-host');
    var scrollPosition = localStorage.getItem('scrollPosition');
    if (selectIns != 'empty') {
        $('select[name=select-institution] option').filter(function() {
            return $(this).val() == selectIns; 
        }).prop('selected', true);
        $('select[name=select-event] option').filter(function() {
            return $(this).val() == selectEvent; 
        }).prop('selected', true);
        $('select[name=select-year] option').filter(function() {
            return $(this).val() == selectYear; 
        }).prop('selected', true);
        $('select[name=select-host] option').filter(function() {
            return $(this).val() == selectHost; 
        }).prop('selected', true);
        $(window).scrollTop(scrollPosition);
    }
    localStorage.setItem('select-institution', 'All');
    localStorage.setItem('select-event', 'All');
    localStorage.setItem('select-year', 'All');
    localStorage.setItem('select-host', 'All');
    localStorage.setItem('scrollPosition', 'empty');
}

/***************************************************************************
 *  Custom jQuery validator methods
 ***************************************************************************/

 // Check if select option is valid
$.validator.addMethod(
    "valueNotEquals", 
    function(value, element, arg){
        return arg != value;
    },
    "Please choose an option."
);

// Input Regex validity check
$.validator.addMethod(
    "regex", 
    function(value, element, regexp){
        var re = new RegExp(regexp);
        return this.optional(element) || re.test(value);
    },
    "Please check your input."
);

/***************************************************************************
 *  Alert setting function
 ***************************************************************************/

function checkAlert() {
    var succeed = localStorage.getItem('form');
    var msg = localStorage.getItem('msg');
    if (succeed == 'true') {
        bootstrap_alert.success(msg);
        $('#alert-holder').show();
        localStorage.setItem('msg', 'empty');
    }
    else if (succeed == 'false') {
        bootstrap_alert.danger(msg);
        $('#alert-holder').show();
        localStorage.setItem('msg', 'empty');
    }
    localStorage.setItem('form', 'empty');
}

bootstrap_alert = function() {}
bootstrap_alert.success = function(msg) {
$('#alert-holder').html('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Success!</strong> ' + msg + '</div>');
}
bootstrap_alert.warning = function(msg) {
$('#alert-holder').html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>warning!</strong> ' + msg + '</div>');
}
bootstrap_alert.danger = function(msg) {
$('#alert-holder').html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Oh snap!</strong> ' + msg + '</div>');
}