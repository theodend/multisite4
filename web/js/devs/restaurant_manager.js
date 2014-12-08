/// <reference path="dts/jquery.d.ts" />
var RestaurantManager = (function () {
    function RestaurantManager(list, restos, options) {
        this.list = list;
        this.restos = restos;
        this.options = {};
        this.options = $.extend(true, {}, RestaurantManager.DEFAULTS, options || {});
        this.imgBtns = $(this.options["imgBtn"], this.list);
        this.imgs = $(this.options["restoImgClass"], this.list);
        this.statusBtns = $(this.options["statusBtnClass"]);
        this.deleteBtns = $(this.options["deleteBtnClass"]);
        this.editBtns = $(this.options["editBtnClass"]);
        this.overlay = $("<div id='overlay'></div>");
        this.updateBtn = $(this.options["updateBtnId"]);
        this.cancelUpdateBtn = $(this.options["cancelUpdateBtnId"]);
        $(document.body).append(this.overlay);
        this.initEvents();
    }
    RestaurantManager.prototype.deleteResto = function (btn) {
        var self, loader, id, parent, editor;
        self = this;
        loader = btn.next(this.options["loaderClass"]);
        loader.show();
        btn.hide();
        id = btn.data("id");
        parent = btn.parents("#" + this.options["rowRestoPrefix"] + id);
        editor = parent.next("#" + "restaurant_edit_row_next_" + id);
        self.options["showMsg"]();
        if (window.confirm(this.options["confirmText"])) {
            $.ajax({
                url: this.options["deleteUrl"],
                type: "DELETE",
                data: { id: id }
            }).done(function (response) {
                if (response.error == false) {
                    editor.remove();
                    parent.remove();
                    self.options["showMsg"](response.msg, true);
                }
                else {
                    self.options["showMsg"](response.msg, false);
                }
                loader.hide();
                btn.show();
            }).fail(function (xhr) {
                loader.hide();
                btn.show();
                self.options["showMsg"](xhr.statusCode + " " + xhr.statusText, false);
            });
        }
    };
    RestaurantManager.prototype.editResto = function (btn) {
        var self, loader, id, edit, resto;
        self = this;
        id = btn.data("id");
        edit = $("#restaurant_edit");
        resto = this.findRestoById(id);
        var nameIpt = $("#js-edit-resto-name");
        var numIpt = $("#js-edit-resto-num");
        var descIpt = $("#js-edit-resto-description");
        var hiddenImage = $("#js-edit-resto-image");
        var hiddenThumb = $("#js-edit-resto-thumb");
        var thumb = $("#resto-thumb");
        if (resto != null) {
            thumb.attr("src", resto.thumb);
            nameIpt.val(resto.name);
            numIpt.val(resto.num);
            descIpt.val(resto.description);
            hiddenImage.val(resto.image);
            hiddenThumb.val(resto.thumb);
            edit.data("id", id);
            if (edit.hasClass("js-is-close")) {
                edit.slideDown(500, function () {
                    edit.removeClass("js-is-close").addClass("js-is-open");
                });
            }
            else {
                edit.slideUp(500, function () {
                    edit.removeClass("js-is-open").addClass("js-is-close");
                });
            }
        }
    };
    RestaurantManager.prototype.updateResto = function (btn) {
        var self = this;
        var loader = btn.next(".loader");
        var nameIpt = $("#js-edit-resto-name");
        var numIpt = $("#js-edit-resto-num");
        var descIpt = $("#js-edit-resto-description");
        var hiddenImage = $("#js-edit-resto-image");
        var hiddenThumb = $("#js-edit-resto-thumb");
        var thumb = $("#resto-thumb");
        var edit = $("#restaurant_edit");
        var datas = {
            id: edit.data("id"),
            name: nameIpt.val(),
            num: numIpt.val(),
            description: descIpt.val(),
            image: hiddenImage.val(),
            thumb: hiddenThumb.val()
        };
        btn.hide();
        loader.show();
        $.ajax({
            type: "PUT",
            url: this.options["updateRestoUrl"],
            data: datas
        }).done(function (response) {
            if (response.error == false) {
                location.reload(true);
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
    };
    RestaurantManager.prototype.updateImg = function (datas) {
        var hiddenImage = $("#js-edit-resto-image");
        var hiddenThumb = $("#js-edit-resto-thumb");
        var thumb = $("#resto-thumb");
        hiddenImage.val(datas.image);
        hiddenThumb.val(datas.thumb);
        thumb.attr("src", datas.thumb);
    };
    RestaurantManager.prototype.cancelUpdate = function (btn) {
        var nameIpt = $("#js-edit-resto-name");
        var numIpt = $("#js-edit-resto-num");
        var descIpt = $("#js-edit-resto-description");
        var thumb = $("#resto-thumb");
        var hiddenImage = $("#js-edit-resto-image");
        var hiddenThumb = $("#js-edit-resto-thumb");
        var edit = $("#restaurant_edit");
        thumb.attr("src", "");
        nameIpt.val("");
        numIpt.val("");
        descIpt.val("");
        hiddenImage.val("");
        hiddenThumb.val("");
        edit.slideUp(500, function () {
            edit.removeClass("js-is-open").addClass("js-is-close");
        });
    };
    RestaurantManager.prototype.findRestoById = function (id) {
        var result = null;
        $.each(this.restos, function (i, e) {
            if (e["id"] == id) {
                result = e;
            }
        });
        return result;
    };
    RestaurantManager.prototype.changeStatus = function (btn) {
        var self, loader, id, parent, statusText;
        self = this;
        loader = btn.next(this.options["loaderClass"]);
        loader.show();
        btn.hide();
        id = btn.data("id");
        parent = btn.parents("#" + this.options["rowRestoPrefix"] + id);
        statusText = parent.find(this.options["statusTextClass"]);
        self.options["showMsg"]();
        $.ajax({
            url: this.options["changeStatusUrl"],
            type: "POST",
            data: { id: id }
        }).done(function (response) {
            if (response.error == false) {
                var text = (response.datas["isOpen"] == true) ? self.options["openText"] : self.options["closeText"];
                statusText.text(text);
                var btnTxt = (response.datas["isOpen"] == true) ? self.options["statusBtnCloseText"] : self.options["statusBtnOpenText"];
                btn.text(btnTxt);
                var resto;
                resto = self.findRestoById(id);
                if (resto != null) {
                    resto.isOpen = response.datas["isOpen"];
                }
                self.options["showMsg"](response.msg, true);
            }
            else {
                self.options["showMsg"](response.msg, false);
            }
            loader.hide();
            btn.show();
        }).fail(function (xhr) {
            loader.hide();
            btn.show();
            self.options["showMsg"](xhr.statusCode + " " + xhr.statusText, false);
        });
    };
    RestaurantManager.prototype.initEvents = function () {
        var self = this;
        this.imgBtns.on("click", function (e) {
            e.preventDefault();
            self.overlay.addClass("active");
            var img = $(this).next(".js-resto-img");
            img.addClass("active");
        });
        this.overlay.on("click", function (e) {
            e.preventDefault();
            self.imgs.removeClass("active");
            $(this).removeClass("active");
        });
        this.statusBtns.on("click", function (e) {
            e.preventDefault();
            self.changeStatus($(this));
        });
        this.deleteBtns.on("click", function (e) {
            e.preventDefault();
            self.deleteResto($(this));
        });
        this.editBtns.on("click", function (e) {
            e.preventDefault();
            self.editResto($(this));
        });
        this.updateBtn.on("click", function (e) {
            e.preventDefault();
            self.updateResto($(this));
        });
        this.cancelUpdateBtn.on("click", function (e) {
            e.preventDefault();
            self.cancelUpdate($(this));
        });
    };
    RestaurantManager.DEFAULTS = {
        imgBtn: "",
        restoImgClass: "",
        changeStatusUrl: "",
        updateRestoUrl: "",
        rowRestoPrefix: "",
        statusBtnClass: ".js-status-btn",
        statusTextClass: "",
        deleteBtnClass: "",
        editBtnClass: "",
        loaderClass: ".loader",
        openText: "",
        closeText: "",
        statusBtnOpenText: "Ouvrir",
        statusBtnCloseText: "Fermer",
        deleteUrl: "",
        updateBtnId: "",
        cancelUpdateBtnId: "",
        confirmText: "Attention cette action est irréversible. Vous confirmez ?",
        showMsg: function () {
        }
    };
    return RestaurantManager;
})();
//# sourceMappingURL=restaurant_manager.js.map