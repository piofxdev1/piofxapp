$(function(){

    if($("form").length){
        $url = $("form").attr('action');
        if($("form").data('api')==1){
        $("form").on("submit", function(event){
            event.preventDefault();
     

            var formValues= $(this).serialize();
            $.get('/contact/api',function(data){
                var token = JSON.parse(data).token;
                var d = formValues+'&_token='+token+'&api=1';


                $.post($url, d, function(data){
                // Display the returned data in browser
                $('.contact_block').hide();
                $('.alert_message').html(data);
                $('.alert_block').show();

            });
            });
     

        });
        }
    }
	

});