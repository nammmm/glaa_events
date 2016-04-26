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

$("#participationForm").submit(function(e) {
    // cancels the form submission
    e.preventDefault();
    doAction('#participationForm');
} );

// Check operation type
function doAction(form) {
    var clickType = $('#form-update').val();
    if (clickType === "add") {
        addForm(form);
    }
    else if (clickType === "update") {
        updateForm(form);
    }
    else if (clickType === "delete") {
        deleteForm(form);
    }
}

// Add data to database
function addForm(form) {
    var msg = "Record has been added.";
    switch(form) {
        case '#institutionForm':
            var formData = {
                table: 'Institutions',
                institutionName: $('#institutionForm').find('[name="institutionName"]').val(),
                isGLAA: $('input[name=optionsRadiosInline]:checked').val()
            };
            msg = "Institution \"" + $('#institutionForm').find('[name="institutionName"]').val() + "\" has been added.";
            break;
        case '#participantForm':
            var formData = {
                table: 'Participants',
                firstName: $('#participantForm').find('[name="firstName"]').val(),
                lastName: $('#participantForm').find('[name="lastName"]').val(),
                institutionID: $('select[name=institution-select]').val(),
                role: $('#participantForm').find('[name="role"]').val(),
                title: $('#participantForm').find('[name="title"]').val(),
                email: $('#participantForm').find('[name="email"]').val()
            };
            msg = "Participant \"" + $('#participantForm').find('[name="firstName"]').val() + " " + $('#participantForm').find('[name="lastName"]').val() + "\" has been added.";
            break;
        case '#eventForm':
            var formData = {
                table: 'Events',
                name: $('#eventForm').find('[name="name"]').val(),
                description: $('#eventForm').find('[name="description"]').val(),
                academicYear: $('select[name=year-select]').val(),
                hostID: $('select[name=institution-select]').val()
            };
            msg = "Event \"" + $('#eventForm').find('[name="name"]').val() + "\" has been added.";
            break;
        case '#participationForm':
            var options = $('select[name=participants-select]').val() || [];
            var JSONString = JSON.stringify(options);
            var formData = {
                table: 'Participations',
                eventID: $('select[name=event-select]').val(),
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
                institutionID: $('#institutionForm').find('[name="id"]').val(),
                isGLAA: $('input[name=optionsRadiosInline]:checked').val()
            };
            msg = "Record \"" + $('#institutionForm').find('[name="institutionName"]').val() + "\" has been update.";
            break;
        case '#participantForm':
            var formData = {
                table: 'Participants',
                participantID: $('#participantForm').find('[name="id"]').val(),
                firstName: $('#participantForm').find('[name="firstName"]').val(),
                lastName: $('#participantForm').find('[name="lastName"]').val(),
                institutionID: $('select[name=institution-select]').val(),
                role: $('#participantForm').find('[name="role"]').val(),
                title: $('#participantForm').find('[name="title"]').val(),
                email: $('#participantForm').find('[name="email"]').val()
            };
            msg = "Record \"" + $('#participantForm').find('[name="firstName"]').val() + " " + $('#participantForm').find('[name="lastName"]').val() + "\" has been updated.";
            break;
        case '#eventForm':
            var formData = {
                table: 'Events',
                eventID: $('#eventForm').find('[name="id"]').val(),
                name: $('#eventForm').find('[name="name"]').val(),
                description: $('#eventForm').find('[name="description"]').val(),
                academicYear: $('select[name=year-select]').val(),
                hostID: $('select[name=institution-select]').val()
            };
            msg = "Record \"" + $('#eventForm').find('[name="name"]').val() + "\" has been updated.";
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
            }                     
        }
    } );
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