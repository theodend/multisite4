$(function(){
    $("#stickytop").waypoint('sticky');

    $("button#stop").on("click", function(e){
        e.preventDefault();
        carousel.stop();
    });

    // devs

    var carousel = new Caroussel($("#carousel"),{
        duration: 7000,
        fadeTransionTime: 500
    });
});
