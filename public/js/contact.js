$(function(){

	$url = $("form").attr('action');
    $("form").on("submit", function(event){
        event.preventDefault();
 
        var formValues= $(this).serialize();
 
        $.post($url, formValues, function(data){
            // Display the returned data in browser
            $("form").prepend('<div class="alert alert-primary alert-custom alert-notice alert-light-primary fade show" role="alert">\
    <div class="alert-icon"><i class="flaticon-warning"></i></div>\
    <div class="alert-text">Your request has been sent to the team. You can expect a callback in next 24 hours.</div>\
    <div class="alert-close">\
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">\
            <span aria-hidden="true"><i class="ki ki-close"></i></span>\
        </button>\
    </div>\
</div>');
        });
    });

});