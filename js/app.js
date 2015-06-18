/**
 * Submit the login form using AJAX
 *
 * @author Timothy OBrien
 * @version 0.1.0 June 2015
 */
$(document).ready(function() {
    $('form').submit(function(event) {
        $('#messages').html('');

        var formData = {
            'username': $('input[name=username]').val(),
            'password': $('input[name=password]').val()
        };

        $('input[name=username]').prop('disabled', function(i, v) { return !v; });
        $('input[name=password]').prop('disabled', function(i, v) { return !v; });
        $('button[type=submit]').prop('disabled', function(i, v) { return !v; });
        $('button[type=submit]').html('<i class="fa fa-circle-o-notch fa-spin"></i> Loading');

        $.ajax({
            type 		: 'POST',
            url 		: 'authenticate.php',
            data 		: formData,
            dataType 	: 'json',
            encode 		: true
        })
        .done(function(data) {
            $('input[name=username]').prop('disabled', function(i, v) { return !v; });
            $('input[name=password]').prop('disabled', function(i, v) { return !v; });
            $('button[type=submit]').prop('disabled', function(i, v) { return !v; });
            $('button[type=submit]').html('Log In');

            if (!data.success) {
                // error
                $('#messages').html('<div class="alert alert-danger"><i class="fa fa-warning"></i> ' + data.message + '</div>');
            } else {
                // success, pass token
                window.location = data.message;
            }
        });
        event.preventDefault();
    });
});