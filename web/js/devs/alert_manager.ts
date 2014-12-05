
/// <reference path="dts/jquery.d.ts" />
/// <reference path="dts/jquery.cookie.d.ts" />

class AlertManager{

    private overlay:JQuery;
    private modal:JQuery;
    private closeBtn:JQuery;
    private options = {};

    static DEFAULTS = {
        overlayId: "#alert-overlay",
        modalId: "#alert-modal",
        closeBtnId: "#alert-close-btn",
        cookieKeyName: "zpb.alert"
    };

    constructor(options?:any){
        this.options = $.extend(true, {}, AlertManager.DEFAULTS, options||{});
        this.overlay = $(this.options["overlayId"]);
        this.modal = $(this.options["modalId"]);
        this.closeBtn = $(this.options["closeBtnId"]);

        if(this.checkCookie()){
            this.initEvents();
            this.open();
        } else {
            this.close();
        }
    }

    open():void{
        this.overlay.addClass("open");
        this.modal.addClass("open");
    }

    checkCookie():boolean{
        return $.cookie(this.options["cookieKeyName"]) == undefined;

    }

    close():void{
        if($.cookie(this.options["cookieKeyName"]) == undefined ){
            $.cookie(this.options["cookieKeyName"], "ok");
        }
        this.modal.remove();
        this.overlay.fadeOut(400, function(){
            this.remove();
        });
    }

    initEvents():void{
        var self = this;

        this.overlay.on("click", function(e){
            e.preventDefault();
            self.close();
        });
        this.closeBtn.on("click", function(e){
            e.preventDefault();
            self.close();
        });

    }
}
