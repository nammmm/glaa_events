$("#institutionForm").submit(function(e) {
    // cancels the form submission
    e.preventDefault();
    var clickType = $('#form-update').val();
    if (clickType === "add") {
        submitForm('#institutionForm');
    }
    else if (clickType === "update") {
        updateForm('#institutionForm');
    }
    else if (clickType === "delete") {

    }
} );

function submitForm(form) {

}

function updateForm(form) {
    switch(form) {
        case '#institutionForm':
            var formData = {
                table: 'Institutions',
                institutionID: $('#institutionForm').find('[name="id"]').val(),
                isGLAA: $('input[name=optionsRadiosInline]:checked').val()
            }
            $.ajax( {
                type: "POST",
                url: "../server_side/form_update.php",
                data: formData,
                success: function(html) {
                    $('#institutionsTable tbody').html(html);
                },
                error: function(text) {

                }
            } );
            break;
        default:
            break;
    }

    // // Initiate Variables With Form Content
    // var name = $("#name").val();
    // var email = $("#email").val();
    // var message = $("#message").val();
 
    // $.ajax({
    //     type: "POST",
    //     url: "php/form-process.php",
    //     data: "name=" + name + "&email=" + email + "&message=" + message,
    //     success : function(text){
    //         if (text == "success"){
    //             formSuccess();
    //         }
    //     }
    // });
}

function deleteForm(form) {

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