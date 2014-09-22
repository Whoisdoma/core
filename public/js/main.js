$(document).ready(function(){

    $("#addserver-form").submit(function(e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "http://" + location.hostname + location.pathname + "/new",
            data: {
                tld: $("#tld").val(),
                server: $("#server").val()
            },
            success: function(data) {
                if (!data.success)
                {
                    //there were errors
                    var errmsgs = data.errors;
                    $.each(errmsgs, function(key, value) {

                        //display the errors
                        $("#addserver-form").prepend('<div class="alert alert-warning alert-dismissible" role="alert">' +
                            '<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span>' +
                            '<span class="sr-only">Close</span></button>'+ value +'</div>');

                    });

                } else {

                    //there were no errors, display success message
                    $("#addserver-form").prepend('<div class="alert alert-success alert-dismissible" role="alert">' +
                        '<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span>' +
                        '<span class="sr-only">Close</span></button>'+ data.successMsg +'</div>');
                }
            }
        });
    });

    $('#addServerModal').on('hidden.bs.modal', function (e) {
        //reload page
        location.reload(true);
    })

});