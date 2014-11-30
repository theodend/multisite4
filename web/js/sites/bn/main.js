$(function(){
    $("#stickytop").waypoint('sticky');



    var carousel = new Caroussel($("#carousel"),{
        duration: sliderDuration || 10000,
        fadeTransionTime: 500
    });
});
