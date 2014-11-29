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
        console.log("self", self);
        $(this).removeClass(self.options["hoverClass"]);
        if (self.isDroppable) {
            self.options["onDropped"](self);
            self.isDroppable = false;
            self.upload(e.dataTransfer.files);
        }
    };
    ImageUpload.prototype.upload = function (files) {
        var file = files[0], self = this, xhr = null;
        if (!('size' in file)) {
            self.options["onError"]("Ce n'est pas un fichier");
            return false;
        }
        if (file.size > this.options["fileMaxSize"]) {
            self.options["onError"]("Taille maiximun de fichier dépassé");
            return false;
        }
        if (this.options["allowedTypes"].indexOf(file.type) < 0) {
            self.options["onError"]("Type de fichier non reconnu");
            return false;
        }
        xhr = new XMLHttpRequest();
        xhr.upload.addEventListener("progress", function (e) {
            if (e.lengthComputable) {
                var percent = Math.round((e.loaded / e.total) * 100) + "%";
                self.options["onProgress"](percent);
            }
        }, false);
        xhr.open("post", this.options["uploadUrl"], true);
        xhr.onreadystatechange = function (e) {
            if (xhr.readyState === 4) {
                self.isDroppable = false;
                if (xhr.status >= 200 && xhr.status < 400) {
                    var response = $.parseJSON(e.target["responseText"]);
                    if (response.hasOwnProperty("error")) {
                        if (response.error === false) {
                            self.options["onDone"](response, self);
                        }
                        else {
                            self.options["onFail"](response, self);
                        }
                    }
                    else {
                        self.options["onLoad"](response, self);
                    }
                    self.isDroppable = true;
                    self.options["always"](self);
                }
                else {
                    self.options["onError"](xhr.status + " " + xhr.statusText, self);
                    self.options["always"](self);
                }
            }
        };
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.setRequestHeader('Content-Type', 'multipart/form-data');
        xhr.setRequestHeader('X-File-Name', file.name);
        xhr.setRequestHeader('X-File-Type', file.type);
        xhr.setRequestHeader('X-File-Size', file.size);
        xhr.send(file);
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
        dropClass: "dropped",
        uploadUrl: "",
        fileMaxSize: 1000000,
        allowedTypes: ['image/jpeg', 'image/gif', 'image/png'],
        onProgress: function () {
        },
        onDone: function () {
        },
        onDropped: function () {
        },
        onFail: function () {
        },
        onLoad: function () {
        },
        always: function () {
        },
        onError: function () {
        }
    };
    return ImageUpload;
})();
//# sourceMappingURL=images_upload.js.map