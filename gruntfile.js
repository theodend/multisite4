module.exports = function(grunt){

    grunt.initConfig({
        uglify:{
            carousel: {
                files:{
                    "web/js/sites/common/Carousel.min.js":"web/js/devs/carousel/Carousel.js"
                }
            },
            carouselSlideManager:{
                files:{
                    "web/js/admin/common/carousel_slides_manager.min.js":"web/js/devs/carousel_slides_manager.js"
                }
            },
            galleryManager:{
                files:{
                    "web/js/admin/common/gallery_manager.min.js":"web/js/devs/gallery_manager.js"
                }
            },
            staticpage:{
                files:{
                    "web/js/admin/zooparc/static_page_actions.min.js":
                        [
                            "web/js/devs/static_page_add.js",
                            "web/js/devs/static_page_modifier.js",
                            "web/js/devs/static_page_delete.js"
                        ]
                }
            },
            uploadimage:{
                files:{
                    "web/js/admin/common/jquery.imgUpload.min.js":
                        [
                            "web/js/devs/images_upload.js",
                            "web/js/devs/jquery.imgUpload.js"
                        ]
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
    grunt.registerTask('staticpage', ["uglify:staticpage"]);
    grunt.registerTask('lib', ["concat:lib"]);
};
