/// <reference path="dts/jquery.d.ts" />
var AlertManager = (function () {
    function AlertManager(options) {
        this.options = {};
        this.options = $.extend(true, {}, AlertManager.DEFAULTS, options || {});
        this.overlay = $(this.options["overlayId"]);
        this.modal = $(this.options["modalId"]);
        this.closeBtn = $(this.options["closeBtnId"]);
        this.iinitEvents();
    }
    AlertManager.prototype.close = function () {
        this.modal.remove();
        this.overlay.fadeOut(400, function () {
            this.remove();
        });
    };
    AlertManager.prototype.iinitEvents = function () {
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
        closeBtnId: "#alert-close-btn"
    };
    return AlertManager;
})();
//# sourceMappingURL=alert_manager.js.map