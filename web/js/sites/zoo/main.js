$(function(){
    $("#stickytop").waypoint('sticky');


    var carousel = new Caroussel($("#carousel"),{
        duration: sliderDuration || 3000,
        fadeTransionTime: 500
    });
});
