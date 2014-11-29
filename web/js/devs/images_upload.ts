/**
 * Created by Nicolas Canfrere on 29/11/2014.
 */
/// <reference path="dts/jquery.d.ts" />

class ImageUpload{

    static DEFAULTS = {
        hoverClass: "hover",
        uploadUrl: "",
        fileMaxSize: 1000000,
        allowedTypes: ['image/jpeg', 'image/gif', 'image/png'],
        onDone: function(){},
        onFail: function(){},
        sendMsg: function(){}

    };
    private options = {};
    private $element:JQuery;
    private isDroppable:boolean;
    private xhr:XMLHttpRequest;

    constructor(public element:HTMLElement, options?:any){
        this.options = $.extend(true, {}, ImageUpload.DEFAULTS, options||{});
        this.$element = $(this.element);
        this.$element.data("uploader", this);
        this.isDroppable = true;
        this.initEvents();
    }

    onDragEnter(e:any):void{
        e.preventDefault();
    }
    onDragOver(e:any):void{
        e.preventDefault();
        var self = $(this).data("uploader");
        $(this).addClass(self.options["hoverClass"]);
    }
    onDragLeave(e:any):void{
        e.preventDefault();
        var self = $(this).data("uploader");
        $(this).removeClass(self.options["hoverClass"]);
    }
    onDrop(e:any):void{
        e.preventDefault();
        var self = $(this).data("uploader");
        $(this).removeClass(self.options["hoverClass"]);
    }
    upload(files:any[]):void{

        this.xhr = new XMLHttpRequest();
    }

    initEvents():void{

        this.$element.on({
            dragenter: this.onDragEnter,
            dragover: this.onDragOver,
            dragleave: this.onDragLeave,
            drop: this.onDrop
        });
    }
}
