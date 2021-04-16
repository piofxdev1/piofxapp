$(function(){

    if($(".test_container").length){
        $url = $(".test_container").data('url');
        $.get($url,function(data){
                
            $(".test_container").html(data);
                console.log('test data pulled');

               
            });    
    }

    if($("form").length){
        $url = $("form").attr('action');
        $url1 = $(".test_container").data('url2');
        $(document).on('click', '.ajaxtestsubmit', function(e) {
            e.preventDefault();

            var formValues= $('.test').serialize();
            console.log(formValues);
            $.get($url1, formValues, function(data){
                $(".test_container").html("<div class='bg-white w-100 p-3 h4'>Your score is "+data+"</div><button class='btn bnt-primary showanswers'>Show Answers</button>");
                $('html, body').animate({
        scrollTop: $(".test_container").offset().top - 200
    }, 500);

            });
        });

      
        
    }

    $(document).on('click', '.showanswers', function(e) {
        $url = $(".test_container").data('url')+'?answers=1';
        $.get($url,function(data){
                
            $(".test_container").html(data);
                console.log('test data pulled');

               
            });    
    });
	
});