/// <reference path="dts/jquery.d.ts" />
var CarouselSlidesManager = (function () {
    function CarouselSlidesManager($element, slides, options) {
        this.$element = $element;
        this.slides = slides;
        this.options = {};
        this.options = $.extend(true, {}, CarouselSlidesManager.DEFAULTS, options || {});
        this.init();
        this.initEvents();
    }
    CarouselSlidesManager.prototype.init = function () {
    };
    CarouselSlidesManager.prototype.addSlide = function (slide) {
        var row;
        this.slides.push(slide);
        row = this.createRow(slide);
        this.$element.append(row);
    };
    CarouselSlidesManager.prototype.getSlideById = function (id) {
        var result = null;
        $.each(this.slides, function (i, e) {
            if (e.id == id) {
                result = e;
            }
        });
        return result;
    };
    CarouselSlidesManager.prototype.getSlideIndex = function (id) {
        var result = null;
        $.each(this.slides, function (i, e) {
            if (e.id == id) {
                result = i;
            }
        });
        return result;
    };
    CarouselSlidesManager.prototype.removeSlide = function (btn, id) {
        var slide, idx, loader, self = this;
        slide = this.getSlideById(id);
        idx = this.getSlideById(id);
        loader = btn.next(".loader");
        btn.hide();
        loader.show();
        if (slide != null && idx != null) {
            $.ajax({
                type: "DELETE",
                url: this.options["deleteSlideUrl"],
                data: { id: id }
            }).done(function (response) {
                if (response.error == false) {
                    var rowId = self.options["rowPrefix"] + id;
                    $("#" + rowId).remove();
                    self.slides.splice(idx, 1);
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
    CarouselSlidesManager.prototype.confirm = function (msg) {
        return window.confirm(msg);
    };
    CarouselSlidesManager.prototype.initEvents = function () {
        var self = this;
        $(document).on("click", "button.slide-delete-btn", function (e) {
            e.preventDefault();
            if (self.confirm(self.options["deleteMessage"])) {
                self.removeSlide($(this), $(this).data("slide"));
            }
            return false;
        });
    };
    CarouselSlidesManager.prototype.createRow = function (slide) {
        var html = this.options["rowTmpl"];
        html = html.replace("[[webRoot]]", slide.webRoot).replace("[[position]]", slide.position + "").replace(/\[\[id\]\]/g, slide.id);
        if (slide.title != null) {
            html = html.replace("[[title]]", slide.title);
        }
        else {
            html = html.replace("[[title]]", "");
        }
        return $(html);
    };
    CarouselSlidesManager.DEFAULTS = {
        deleteMessage: "Attention! cette action est irréversible. Vous confirmez la suppression ?",
        deleteSlideUrl: "",
        rowPrefix: "slide_",
        showMsg: function () {
        },
        rowTmpl: "<div class=\'slide\' id=\'slide_[[id]]\'><table><tr><td class=\'slide-handle\'></td><td class=\'slide-position\'>[[position]]</td><td class=\'slide-img\'><img src=\'[[webRoot]]\' /></td><td class=\"slide-activation\"><label for=\"active_slide_[[id]]\"><input type=\"checkbox\" id=\"active_slide_[[id]]\"/> activer</label></td><td class=\"slide-title\"><input type=\"text\" value=\'[[title]]\'/></td><td class=\"slide-delete\"><button type=\'button\' class=\'btn btn-default slide-delete-btn\' data-slide=\'[[id]]\'><i class=\"fa fa-trash-o\"></i><div class=\"loader\"></div></button></td></tr></table></div>"
    };
    return CarouselSlidesManager;
})();
//# sourceMappingURL=carousel_slides_manager.js.map