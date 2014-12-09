/**
 * Created by Nicolas Canfrère on 09/12/2014.
 */
/*
          ____________________
 __      /     ______         \
{  \ ___/___ /       }         \
 {  /       / #      }          |
  {/ ô ô  ;       __}           |
  /          \__}    /  \       /\
<=(_    __<==/  |    /\___\     |  \
  (_ _(    |   |   |  |   |   /    #
   (_ (_   |   |   |  |   |   |
     (__<  |mm_|mm_|  |mm_|mm_|
*/
/// <reference path="dts/jquery.d.ts" />
var FrontboxManager = (function () {
    function FrontboxManager($form, $previewer, options) {
        this.$form = $form;
        this.$previewer = $previewer;
        this.options = {};
        this.options = $.extend(true, {}, FrontboxManager.DEFAULTS, options || {});
        this.initCreateForm();
        this.initPreviewer();
        this.curentColorClass = this.options["initColorClass"];
        this.initEvents();
    }
    FrontboxManager.prototype.initCreateForm = function () {
        this.titleIpt = $(this.options["titleIpt"], this.$form);
        this.subTitleIpt = $(this.options["subTitleIpt"], this.$form);
        this.linkIpt = $(this.options["linkIpt"], this.$form);
        this.imgIpt = $(this.options["imgIpt"], this.$form);
        this.imgRootIpt = $(this.options["imgRootIpt"], this.$form);
        this.colorIptName = $("input[name=" + this.options["colorIptName"] + "]", this.$form);
        this.saveFbBtn = $(this.options["saveFbBtn"], this.$form);
        this.newFbLoader = this.saveFbBtn.next(".loader");
    };
    FrontboxManager.prototype.initPreviewer = function () {
        this.imgPreview = $(this.options["imgPreviewId"], this.$previewer);
        this.titlePreview = $(this.options["titlePreviewId"], this.$previewer);
        this.subTitlePreview = $(this.options["subTitlePreviewId"], this.$previewer);
        this.colorClassPreview = $(this.options["colorClassPrviewId"], this.$previewer);
    };
    FrontboxManager.prototype.saveFrontbox = function () {
        var datas, self;
        self = this;
        datas = {
            title: this.titleIpt.val(),
            subtitle: this.subTitleIpt.val(),
            link: this.linkIpt.val(),
            image: this.imgIpt.val(),
            rootDir: this.imgRootIpt.val(),
            color: this.curentColorClass
        };
        this.saveFbBtn.hide();
        this.newFbLoader.show();
        $.ajax({
            type: "POST",
            url: this.options["createBoxUrl"],
            data: datas
        }).done(function (response) {
            if (response.error == false) {
                window.location.reload(true);
            }
            else {
                self.options["showMsg"](response.msg, false);
            }
            self.saveFbBtn.show();
            self.newFbLoader.hide();
        }).fail(function (xhr) {
            self.options["showMsg"](xhr.statusCode + " " + xhr.statusText, false);
            self.saveFbBtn.show();
            self.newFbLoader.hide();
        });
    };
    FrontboxManager.prototype.addImgVal = function (imgDatas) {
        this.imgIpt.val(imgDatas["image"]);
        this.imgRootIpt.val(imgDatas["rootDir"]);
        this.imgPreview.attr("src", imgDatas["image"]);
    };
    FrontboxManager.prototype.initEvents = function () {
        var self = this;
        this.titleIpt.on("keyup", function (e) {
            e.preventDefault();
            self.titlePreview.text($(this).val());
        });
        this.subTitleIpt.on("keyup", function (e) {
            e.preventDefault();
            self.subTitlePreview.text($(this).val());
        });
        this.colorIptName.on("change", function (e) {
            e.preventDefault();
            self.colorClassPreview.removeClass(self.curentColorClass);
            self.curentColorClass = $(this).val();
            self.colorClassPreview.addClass(self.curentColorClass);
        });
        this.saveFbBtn.on("click", function (e) {
            e.preventDefault();
            console.log("click");
            self.saveFrontbox();
        });
    };
    FrontboxManager.DEFAULTS = {
        titleIpt: "",
        subTitleIpt: "",
        linkIpt: "",
        imgIpt: "",
        imgRootIpt: "",
        colorIptName: "",
        saveFbBtn: "",
        createBoxUrl: "",
        imgPreviewId: "",
        titlePreviewId: "",
        subTitlePreviewId: "",
        colorClassPrviewId: "",
        initColorClass: "",
        showMsg: function () {
        }
    };
    return FrontboxManager;
})();
//# sourceMappingURL=frontbox_manager.js.map