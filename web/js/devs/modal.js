/**
 * Created by Nicolas Canfrere on 07/12/2014.
 */
/// <reference path="dts/jquery.d.ts" />
var Modal = (function () {
    function Modal($element, options) {
        this.$element = $element;
        this.options = {};
        this.isOpen = false;
        this.isResizing = null;
        this.options = $.extend(true, {}, Modal.DEFAULTS, options || {});
        this.$element.addClass("hide");
        this.$overlay = $("<div />", { id: this.options["overlayId"], "class": "hide" });
        $("body").append(this.$overlay);
        this.initEvents();
    }
    Modal.prototype.close = function () {
        this.$element.addClass("hide");
        this.$overlay.addClass("hide");
        this.isOpen = false;
        this.options["onClose"](this);
    };
    Modal.prototype.open = function () {
        if (this.isOpen) {
            return;
        }
        this.$element.removeClass("hide");
        this.$overlay.removeClass("hide");
        this.position();
        this.isOpen = true;
        this.options["onOpen"](this);
    };
    Modal.prototype.position = function () {
        this.$element.css({
            "left": (($(window).width() - this.$element.width()) / 2) + "px"
        });
    };
    Modal.prototype.initEvents = function () {
        var self = this;
        $(this.options["closeElementClass"]).on("click", function (e) {
            e.preventDefault();
            self.close();
        });
        $(this.$overlay).on("click", function (e) {
            e.preventDefault();
            self.close();
        });
        $(window).on("resize", function () {
            if (self.isResizing !== null) {
                window.clearTimeout(self.isResizing);
                self.isResizing = null;
            }
            self.isResizing = window.setTimeout(function () {
                self.position();
            }, 150);
        });
    };
    Modal.DEFAULTS = {
        closeElementClass: ".js-modal-close",
        overlayId: "modal-overlay",
        onOpen: function () {
        },
        onClose: function () {
        }
    };
    return Modal;
})();
//# sourceMappingURL=modal.js.map