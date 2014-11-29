/**
 * Created by Nicolas Canfrere on 29/11/2014.
 */
/// <reference path="dts/jquery.d.ts" />
var ImageUpload = (function () {
    function ImageUpload(element, options) {
        this.element = element;
        this.options = {};
        this.options = $.extend(true, {}, ImageUpload.DEFAULTS, options || {});
        this.$element = $(this.element);
        this.$element.data("uploader", this);
        this.isDroppable = true;
        this.initEvents();
    }
    ImageUpload.prototype.onDragEnter = function (e) {
        e.preventDefault();
    };
    ImageUpload.prototype.onDragOver = function (e) {
        e.preventDefault();
        var self = $(this).data("uploader");
        $(this).addClass(self.options["hoverClass"]);
    };
    ImageUpload.prototype.onDragLeave = function (e) {
        e.preventDefault();
        var self = $(this).data("uploader");
        $(this).removeClass(self.options["hoverClass"]);
    };
    ImageUpload.prototype.onDrop = function (e) {
        e.preventDefault();
        var self = $(this).data("uploader");
        $(this).removeClass(self.options["hoverClass"]);
    };
    ImageUpload.prototype.upload = function (files) {
        this.xhr = new XMLHttpRequest();
    };
    ImageUpload.prototype.initEvents = function () {
        this.$element.on({
            dragenter: this.onDragEnter,
            dragover: this.onDragOver,
            dragleave: this.onDragLeave,
            drop: this.onDrop
        });
    };
    ImageUpload.DEFAULTS = {
        hoverClass: "hover",
        uploadUrl: "",
        fileMaxSize: 1000000,
        allowedTypes: ['image/jpeg', 'image/gif', 'image/png'],
        onDone: function () {
        },
        onFail: function () {
        },
        sendMsg: function () {
        }
    };
    return ImageUpload;
})();
//# sourceMappingURL=images_upload.js.map