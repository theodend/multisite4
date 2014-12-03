/// <reference path="dts/jquery.d.ts" />
var NewRestaurantManager = (function () {
    function NewRestaurantManager($element, options) {
        this.$element = $element;
        this.options = {};
        this.options = $.extend(true, {}, NewRestaurantManager.DEFAULTS, options || {});
        this.datas = {
            name: "",
            description: "",
            num: null,
            image: "",
            thumb: ""
        };
        this.saveBtn = $(this.options["saveBtnId"], this.$element);
        this.nameIpt = $(this.options["nameId"], this.$element);
        this.imageIpt = $(this.options["imageId"], this.$element);
        this.thumbIpt = $(this.options["thumbId"], this.$element);
        this.numIpt = $(this.options["numId"], this.$element);
        this.descriptionIpt = $(this.options["descriptionId"], this.$element);
        this.noImageAlert = $(this.options["noImageId"], this.$element);
        this.loader = this.saveBtn.next(".loader");
        this.noImageAlert.text("Pas d'image uploadée.");
        this.initEvents();
    }
    NewRestaurantManager.prototype.save = function () {
        var self = this;
        this.saveBtn.hide();
        this.loader.show();
        $.ajax({
            type: "POST",
            url: this.options["saveUrl"],
            data: this.datas
        }).done(function (response) {
            if (response.error == false) {
                location.reload(true);
            }
            else {
                self.options["showMsg"](response.msg, false);
                self.saveBtn.show();
                self.loader.hide();
            }
        }).fail(function (xhr) {
            self.options["showMsg"](xhr.statusCode + " " + xhr.statusText, false);
            self.saveBtn.show();
            self.loader.hide();
        });
    };
    NewRestaurantManager.prototype.addImage = function (datas) {
        this.imageIpt.val(datas["image"]);
        this.datas.image = datas["image"];
        this.thumbIpt.val(datas["thumb"]);
        this.datas.thumb = datas["thumb"];
    };
    NewRestaurantManager.prototype.getDatas = function () {
        return this.datas;
    };
    NewRestaurantManager.prototype.testDatas = function () {
        if (this.datas.name == "" || this.datas.description == "" || this.datas.image == "" || this.datas.thumb == "" || this.datas.num == "") {
            return false;
        }
        return true;
    };
    NewRestaurantManager.prototype.fillDatas = function () {
        this.datas.name = this.nameIpt.val();
        this.datas.description = this.descriptionIpt.val();
        this.datas.image = this.imageIpt.val();
        this.datas.num = this.numIpt.val();
        this.datas.thumb = this.thumbIpt.val();
    };
    NewRestaurantManager.prototype.clearErrors = function () {
        var onError = this.$element.find(".has-error").removeClass("has-error");
        onError.removeClass("has-error");
        this.noImageAlert.hide();
    };
    NewRestaurantManager.prototype.showErrors = function () {
        this.clearErrors();
        if (this.datas.name == "") {
            this.nameIpt.parents(".form-group").addClass("has-error");
        }
        if (this.datas.num == "") {
            this.numIpt.parents(".form-group").addClass("has-error");
        }
        if (this.datas.description == "") {
            this.descriptionIpt.parents(".form-group").addClass("has-error");
        }
        if (this.datas.image == "") {
            this.noImageAlert.show();
        }
    };
    NewRestaurantManager.prototype.initEvents = function () {
        var self = this;
        this.saveBtn.on("click", function (e) {
            e.preventDefault();
            self.fillDatas();
            if (self.testDatas() === false) {
                self.showErrors();
                return false;
            }
            self.save();
        });
    };
    NewRestaurantManager.DEFAULTS = {
        saveUrl: "",
        saveBtnId: "",
        nameId: "",
        descriptionId: "",
        numId: "",
        imageId: "",
        noImageId: "",
        showMsg: function () {
        }
    };
    return NewRestaurantManager;
})();
//# sourceMappingURL=new_restaurant_manager.js.map