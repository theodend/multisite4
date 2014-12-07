$(function(){
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
    });

    $("#menu-toggler").on("click", function(e){
        e.preventDefault();
        $("body").toggleClass("is-open");
    });

    $("#site-overlay").on("click", function(e){
        e.preventDefault();
        $("body").toggleClass("is-open");
    });
    var dropdownLinks = $("li.dropdown>a");
    var dropdowns = $("li.dropdown");
    dropdownLinks.on("click", function(e){
        e.preventDefault();
        var had = $(this).parent("li").hasClass("is-open");
        dropdowns.removeClass("is-open");
        if(!had){
            $(this).parent("li").addClass("is-open");
        }
    });
});
