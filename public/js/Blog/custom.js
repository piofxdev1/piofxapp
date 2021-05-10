let modal_status = 0;
$(document).ready(function () {
    // Chat Bubble Animation
    setTimeout(function () {
        $(".chat_bubble").css("background", "#425b76");
        $(".chat_bubble").animate(
            {
                width: "4rem",
                height: "4rem",
                "font-size": "1.5rem",
                opacity: "1",
                padding: "1rem",
            },
            { duration: 300 }
        );
        $(".chat_bubble_outer").animate(
            {
                width: "4rem",
                height: "4rem",
                "font-size": "1.5rem",
                opacity: "1",
            },
            { duration: 300 }
        );
        $(".chat_bubble_outer").animate(
            {
                width: "5rem",
                bottom: "0.5rem",
                right: "0.5rem",
                height: "5rem",
                opacity: "0",
            },
            { duration: 500 }
        );
    }, 2000);

    // Chat Message Animation
    setTimeout(function () {
        $(".chat_message").animate({
            right: "1rem",
        });
    }, 3000);

    // Hide Alert
    setTimeout(function () {
        $(".piofx_alert").remove();
    }, 5000);

    // Modal Functionality
    if ($(".piofx_modal").data("position")) {
        $(window).scroll(function () {
            if (!modal_status) {
                if (
                    $(window).scrollTop() > $(".piofx_modal").data("position")
                ) {
                    $(".piofx_modal").modal("show");
                    modal_status = 1;
                } else {
                    $(".piofx_modal").remove();
                }
            }
        });
    } else {
        if (!modal_status) {
            setTimeout(function () {
                $(".piofx_modal").modal("show");
                modal_status = 1;
            }, $(".piofx_modal").data("time"));
        }
    }

    // Toast Functionality
    let toast_status = 0;
    if ($(".piofx_toast").data("position")) {
        console.log("here");
        $(window).scroll(function () {
            if (!toast_status) {
                if (
                    $(window).scrollTop() > $(".piofx_toast").data("position")
                ) {
                    $(".piofx_toast").toast("show");
                    toast_status = 1;
                } else {
                    $(".piofx_toast").remove();
                }
            }
        });
    } else {
        if (!toast_status) {
            setTimeout(function () {
                $(".piofx_toast").toast({ autohide: false });
                $(".piofx_toast").toast("show");
                toast_status = 1;
            }, $(".piofx_toast").data("time"));
        }
    }

    // Hide or show header text
    let header_text_status = 0;
    $(window).scroll(function () {
        if (header_text_status == 0) {
            if ($(window).scrollTop() >= 500) {
                header_text_status = 1;
                $(".header_text").slideUp();
            }
        } else if ($(window).scrollTop() < 500) {
            console.log("here");
            header_text_status = 0;
            $(".header_text").slideDown();
        }
    });
});
// End of document ready

// Hide Chat Message
function hide_message() {
    $(".chat_message").css("opacity", "0");
}

// Chat Box Functionality
function show_box() {
    $(".chat_box").toggle();
    $(".chat_message").css("opacity", "0");
    $(".open_chat_bubble").toggle();
    $(".close_chat_bubble").toggle();
}

// Close Toast
function close_toast() {
    toast_status = 1;
    $(".piofx_toast").remove();
}

// Hide Alert
function hide_alert() {
    $(".piofx_alert").remove();
}
