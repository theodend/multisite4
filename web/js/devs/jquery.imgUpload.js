;(function($,w){
    jQuery.event.props.push( "dataTransfer" );
    $.fn.imgUpload = function(options){

        return this.each(function(){
            var uploader;
            if(!$.data(this, "hasUpload")){
                $.data(this, "hasUpload", true);
                uploader = new ImageUpload(this, options);
            }
        });
    }

})(jQuery, this);
