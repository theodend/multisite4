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
    })
});
