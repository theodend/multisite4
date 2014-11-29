$(function(){
    $("#stickytop").waypoint('sticky');



    var carousel = new Caroussel($("#carousel"),{
        duration: 7000,
        fadeTransionTime: 500
    });
});
