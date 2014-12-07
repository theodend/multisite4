/**
 * Created by Nicolas Canfrere on 07/12/2014.
 */

/// <reference path="dts/jquery.d.ts" />

class Modal{
    static DEFAULTS = {
        closeElementClass: ".js-modal-close",
        overlayId: "modal-overlay",
        onOpen: function(){},
        onClose: function(){}
    };

    private options = {};
    private isOpen:boolean = false;
    private $overlay:JQuery;
    private isResizing:any = null;

    constructor(public $element:JQuery, options?:any){
        this.options = $.extend(true, {}, Modal.DEFAULTS, options||{});
        this.$element.addClass("hide");

        this.$overlay = $("<div />", {id: this.options["overlayId"], "class":"hide"});
        $("body").append(this.$overlay);
        this.initEvents();
    }

    close():void{
        this.$element.addClass("hide");
        this.$overlay.addClass("hide");
        this.isOpen = false;
        this.options["onClose"](this);
    }

    open():void{
        if(this.isOpen){
            return;
        }
        this.$element.removeClass("hide");
        this.$overlay.removeClass("hide");
        this.position();
        this.isOpen = true;
        this.options["onOpen"](this);
    }

    position():void{

        this.$element.css({

            "left": (($(window).width() - this.$element.width()) / 2) + "px"
        })
    }

    initEvents():void{

        var self = this;

        $(this.options["closeElementClass"]).on("click", function(e){
            e.preventDefault();
            self.close();
        });

        $(this.$overlay).on("click", function(e){
            e.preventDefault();
            self.close();
        });

        $(window).on("resize",function(){
            if(self.isResizing !== null){
                window.clearTimeout(self.isResizing);
                self.isResizing = null;
            }
            self.isResizing = window.setTimeout(function(){
                self.position();
            }, 150);
        });
    }
}
