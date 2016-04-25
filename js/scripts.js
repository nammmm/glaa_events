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

function addForm(form) {
    switch(form) {
        case '#institutionForm':
            var formData = {
                table: 'Institutions',
                institutionName: $('#institutionForm').find('[name="institutionName"]').val(),
                isGLAA: $('input[name=optionsRadiosInline]:checked').val()
            };
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
            break;
        case '#eventForm':
            var formData = {
                table: 'Events',
                name: $('#eventForm').find('[name="name"]').val(),
                description: $('#eventForm').find('[name="description"]').val(),
                academicYear: $('select[name=year-select]').val(),
                hostID: $('select[name=institution-select]').val()
            };
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
            window.location.reload();
            $(window).scrollTop(scrollPosition);                    
        },
        error: function(text) {

        }
    } );
}

function updateForm(form) {
    switch(form) {
        case '#institutionForm':
            var formData = {
                table: 'Institutions',
                institutionID: $('#institutionForm').find('[name="id"]').val(),
                isGLAA: $('input[name=optionsRadiosInline]:checked').val()
            };
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
            window.location.reload();
            $(window).scrollTop(scrollPosition);                    
        },
        error: function(text) {

        }
    } );
}

function deleteForm(form) {
    switch(form) {
        case '#institutionForm':
            var formData = {
                table: 'Institutions',
                institutionID: $('#institutionForm').find('[name="id"]').val()
            };
            break;
        case '#participantForm':
            var formData = {
                table: 'Participants',
                participantID: $('#participantForm').find('[name="id"]').val()
            };
            break;
        case '#eventForm':
            var formData = {
                table: 'Events',
                eventID: $('#eventForm').find('[name="id"]').val()
            };
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
            window.location.reload();
            $(window).scrollTop(scrollPosition);                    
        },
        error: function(text) {

        }
    } );
}

function ajaxRequest() {
    try {
        var request = new XMLHttpRequest();
    }
    catch(e1) {
        try {
            request = new ActiveXObject("Msxml2.XMLHTTP");
        }
        catch(e2) {
            try {
                request = new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch(e3) {
                request = false;
            }
        } 
    }
    return request;
}