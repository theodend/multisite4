$(function(){
    var topMenuDropdowns = $("#main-top-bar-navs-desktop li.dropdown");
    $("#stickytop").waypoint('sticky');


    var carousel = new Caroussel($("#carousel"),{
        duration: sliderDuration || 3000,
        fadeTransionTime: 500
    });

    $("#menu-toggler").on("click", function(e){
        e.preventDefault();
        $.scrollTo( $(this).data("target"), 300);

    });

    topMenuDropdowns.on("click", function(e){
        e.preventDefault();
        e.stopPropagation();
        if($(this).hasClass("open")){
            $(this).removeClass("open");
        } else{
            topMenuDropdowns.removeClass("open");
            $(this).addClass("open");
        }
    });

    $(document).on("click", function(e){
        topMenuDropdowns.removeClass("open");
    });

    var topBarMenu, topBarMenuToggleBtn;
    topBarMenuToggleBtn = $("#main-top-bar-navs-toggler");
    topBarMenu = $("#toggle-menu");
    topBarMenuToggleBtn.on("click", function(e){
        e.preventDefault();
        if(topBarMenu.hasClass("toggle-menu-is-up")){
            topBarMenu.removeClass("toggle-menu-is-up").addClass("toggle-menu-is-down");
        } else {
            topBarMenu.removeClass("toggle-menu-is-down").addClass("toggle-menu-is-up");
        }
    })
});
