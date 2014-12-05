/// <reference path="dts/jquery.d.ts" />
/// <reference path="dts/jquery.cookie.d.ts" />
var AlertManager = (function () {
    function AlertManager(options) {
        this.options = {};
        this.options = $.extend(true, {}, AlertManager.DEFAULTS, options || {});
        this.overlay = $(this.options["overlayId"]);
        this.modal = $(this.options["modalId"]);
        this.closeBtn = $(this.options["closeBtnId"]);
        if (this.checkCookie()) {
            this.initEvents();
            this.open();
        }
        else {
            this.close();
        }
    }
    AlertManager.prototype.open = function () {
        this.overlay.addClass("open");
        this.modal.addClass("open");
    };
    AlertManager.prototype.checkCookie = function () {
        return $.cookie(this.options["cookieKeyName"]) == undefined;
    };
    AlertManager.prototype.close = function () {
        if ($.cookie(this.options["cookieKeyName"]) == undefined) {
            $.cookie(this.options["cookieKeyName"], "ok", { expires: 1 });
        }
        this.modal.remove();
        this.overlay.fadeOut(400, function () {
            this.remove();
        });
    };
    AlertManager.prototype.initEvents = function () {
        var self = this;
        this.overlay.on("click", function (e) {
            e.preventDefault();
            self.close();
        });
        this.closeBtn.on("click", function (e) {
            e.preventDefault();
            self.close();
        });
    };
    AlertManager.DEFAULTS = {
        overlayId: "#alert-overlay",
        modalId: "#alert-modal",
        closeBtnId: "#alert-close-btn",
        cookieKeyName: "zpb.alert"
    };
    return AlertManager;
})();
//# sourceMappingURL=alert_manager.js.map