$(function(){

    // if($(".test_container").length){
    //     $url = $(".test_container").data('url');
    //     $.get($url,function(data){
    //         $(".test_container").html(data);
    //             console.log('test data pulled');
    //         });    
    // }

    var prefix_url = 'https://prep.firstacademy.in/';

    if($("form").length){
        
        $(document).on('click', '.ajaxtestsubmit', function(e) {
            var slug = $(this).data('test');
            var container= $("."+slug);
            var url = submitTestUrl(slug);
            e.preventDefault();

            var formValues= $('.form_'+slug).serialize();
         
            $.get(url, formValues, function(data){
                var d = JSON.parse(data);
                console.log(d);
                container.html("<div class='bg-white w-100 p-3 h4'><p>Your score is "+d.score+"/"+d.total+"</p><button class='btn btn-soft-primary showanswers' data-container='"+slug+"'>Show Answers</button><button class='btn btn-soft-success ml-2 trytest' data-container='"+slug+"'>Retry Test</button></div>");
                $('html, body').animate({
                    scrollTop: container.offset().top - 200
                }, 500);

            });
        });

      
        
    }

    $(document).on('click', '.showanswers', function(e) {
           e.preventDefault();
        var slug = $(this).data('container');
        var container = $("."+slug);
        var url = testUrl(slug,true);
        $.get(url,function(data){
            container.html(data).append("<p class='mt-3'><button class='btn btn-soft-success ml-2 trytest' data-container='"+slug+"'>Retry Test</button></p>");
                console.log('test data pulled');
            });    
    });

    $(document).on('click', '.trytest', function(e) {
           e.preventDefault();
        var slug = $(this).data('container');
        var container = $("."+slug);
        var url = testUrl(slug);
        $.get(url,function(data){
            container.html(data);
            $('html, body').animate({
                    scrollTop: container.offset().top - 200
            }, 500);

        });    
    });

    function submitTestUrl(slug){
        return prefix_url+'apitestget/'+slug;
    }
	
    function testUrl(slug,answers=false){
        if(answers)
            return prefix_url+'apitest/'+slug+'?answers=1';
        else
            return prefix_url+'apitest/'+slug;
    }
});