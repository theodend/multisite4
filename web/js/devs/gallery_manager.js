/// <reference path="dts/jquery.d.ts" />
var GalleryManager = (function () {
    function GalleryManager($element, imgs, options) {
        this.$element = $element;
        this.imgs = imgs;
        this.options = {};
        this.options = $.extend(true, {}, GalleryManager.DEFAULTS, options || {});
        this.initEvents();
    }
    GalleryManager.prototype.addImg = function (img) {
        var row;
        this.imgs.push(img);
        row = this.createRow(img);
        this.$element.append(row);
    };
    GalleryManager.prototype.createRow = function (img) {
        var html = this.options["rowTmpl"];
        html = html.replace("[[webRoot]]", img.webRoot).replace("[[position]]", img.position + "").replace(/\[\[id\]\]/g, img.id);
        if (img.title != null) {
            html = html.replace("[[title]]", img.title);
        }
        else {
            html = html.replace("[[title]]", "");
        }
        return $(html);
    };
    GalleryManager.prototype.getImgById = function (id) {
        var result = null;
        $.each(this.imgs, function (i, e) {
            if (e.id == id) {
                result = e;
            }
        });
        return result;
    };
    GalleryManager.prototype.getImageIndex = function (id) {
        var result = null;
        $.each(this.imgs, function (i, e) {
            if (e.id == id) {
                result = i;
            }
        });
        return result;
    };
    GalleryManager.prototype.removeImage = function (btn, id) {
        var img, idx, loader, self = this;
        img = this.getImgById(id);
        if (img != null) {
            idx = this.getImageIndex(id);
            loader = btn.next(".loader");
            btn.hide();
            loader.show();
            self.options["showMsg"]();
            $.ajax({
                type: "DELETE",
                url: this.options["deleteImgUrl"],
                data: { id: id }
            }).done(function (response) {
                if (response.error == false) {
                    var rowId = self.options["rowPrefix"] + id;
                    $("#" + rowId).remove();
                    self.imgs.splice(idx, 1);
                    self.options["showMsg"](response.msg, true);
                }
                else {
                    btn.show();
                    loader.hide();
                    self.options["showMsg"](response.msg, false);
                }
            }).fail(function (xhr) {
                btn.show();
                loader.hide();
                self.options["showMsg"](xhr.statusCode + " " + xhr.statusText, false);
            });
        }
    };
    GalleryManager.prototype.changeActiveState = function (id, checkbox) {
        var img, loader, self = this, btn;
        img = this.$element.find("#" + this.options["rowPrefix"] + id);
        console.log(img);
        if (img.length > 0) {
            btn = img.find("button.delete-img-btn");
            loader = btn.next(".loader");
            btn.hide();
            loader.show();
            self.options["showMsg"]();
            $.ajax({
                type: "PUT",
                url: this.options["changeActiveStateUrl"],
                data: { id: id }
            }).done(function (response) {
                if (response.error == false) {
                    img.isActive = !img.isActive;
                    self.options["showMsg"](response.msg, true);
                }
                else {
                    self.options["showMsg"](response.msg, false);
                }
                btn.show();
                loader.hide();
            }).fail(function (xhr) {
                btn.show();
                loader.hide();
                self.options["showMsg"](xhr.statusCode + " " + xhr.statusText, false);
            });
        }
    };
    GalleryManager.prototype.confirm = function (msg) {
        return window.confirm(msg);
    };
    GalleryManager.prototype.initEvents = function () {
        var self = this;
        $(document).on("click", "button.delete-img-btn", function (e) {
            e.preventDefault();
            if (self.confirm(self.options["deleteMessage"])) {
                self.removeImage($(this), $(this).data("img"));
            }
            return false;
        });
        $(document).on("change", "[data-activation='']", function (e) {
            e.preventDefault();
            var id = parseInt($(this).attr("id").replace(self.options["checkboxIdPrefix"], ""));
            self.changeActiveState(id, $(this));
        });
    };
    GalleryManager.DEFAULTS = {
        updateUrl: "",
        deleteMessage: "Attention! cette action est irréversible. Vous confirmez la suppression ?",
        deleteImgUrl: "",
        rowPrefix: "img_",
        checkboxIdPrefix: "active_img_",
        showMsg: function () {
        },
        rowTmpl: "<div class=\'image\' id=\'img_[[id]]\'><table><tr><td class=\"img-handle\"></td><td class=\"img-position\">[[position]]</td> <td class=\"img-img\"><img src=\"[[webRoot]]\" alt=\"\"/></td><td class=\"img-activation\"><label for=\"active_img_[[id]]\"><input type=\"checkbox\" id=\"active_img_[[id]]\" data-activation=\'\'/> Activer</label></td><td class=\"img-title\"><input type=\"text\" value=\'[[title]]\'/></td><td class=\"img-delete\"><button type=\"button\" class=\"btn btn-default delete-img-btn\" data-img=\'[[id]]\'><i class=\"fa fa-trash-o\"></i></button></td></tr></table></div>"
    };
    return GalleryManager;
})();
//# sourceMappingURL=gallery_manager.js.map