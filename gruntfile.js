module.exports = function(grunt){

    grunt.initConfig({
        uglify:{
            carousel: {
                files:{
                    "web/js/sites/common/Carousel.min.js":"web/js/devs/carousel/Carousel.js"
                }
            }
        },
        concat:{
            options: {
                separator: ';'
            },
            lib: {
                src: [
                    "web/js/vendor/jquery-2.1.1.min.js",
                    "web/js/vendor/jquery.scrollTo.min.js",
                    "web/js/vendor/waypoints.min.js",
                    "web/js/vendor/waypoints-sticky.min.js",
                    "web/js/sites/common/Carousel.min.js"
                ],
                dest: "web/js/vendor/lib.js"
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-concat');

    grunt.registerTask('default', function(){
        console.log("hello !");
    });

    grunt.registerTask('carousel', ["uglify:carousel"]);
    grunt.registerTask('lib', ["concat:lib"]);
};
