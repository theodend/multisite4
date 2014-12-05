
/// <reference path="dts/jquery.d.ts" />

class AlertManager{

    private overlay:JQuery;
    private modal:JQuery;
    private closeBtn:JQuery;
    private options = {};

    static DEFAULTS = {
        overlayId: "#alert-overlay",
        modalId: "#alert-modal",
        closeBtnId: "#alert-close-btn"
    };

    constructor(options?:any){
        this.options = $.extend(true, {}, AlertManager.DEFAULTS, options||{});
        this.overlay = $(this.options["overlayId"]);
        this.modal = $(this.options["modalId"]);
        this.closeBtn = $(this.options["closeBtnId"]);

        this.iinitEvents();
    }

    close():void{
        this.modal.remove();
        this.overlay.fadeOut(400, function(){
            this.remove();
        });
    }

    iinitEvents():void{
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
