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

class FrontboxManager{

    static DEFAULTS = {
        titleIpt: "",
        subTitleIpt: "",
        linkIpt: "",
        imgIpt: "",
        imgRootIpt: "",
        colorIptName: "",
        saveFbBtn: "",
        createBoxUrl: "",
        imgPreviewId: "",
        titlePreviewId:"",
        subTitlePreviewId:"",
        colorClassPrviewId: "",
        initColorClass: "",
        showMsg: function(){}
    };

    private options = {};

    private titleIpt:JQuery;
    private subTitleIpt:JQuery;
    private linkIpt:JQuery;
    private imgIpt:JQuery;
    private imgRootIpt:JQuery;
    private colorIptName:JQuery;
    private newFbLoader:JQuery;
    private saveFbBtn:JQuery;
    private imgPreview:JQuery;
    private titlePreview:JQuery;
    private subTitlePreview:JQuery;
    private colorClassPreview:JQuery;
    private curentColorClass:string;

    constructor(public $form:JQuery, public $previewer:JQuery, options?:any){
        this.options = $.extend(true, {}, FrontboxManager.DEFAULTS, options||{});
        this.initCreateForm();
        this.initPreviewer();
        this.curentColorClass = this.options["initColorClass"];
        this.initEvents();
    }

    initCreateForm():void{
        this.titleIpt = $(this.options["titleIpt"], this.$form);
        this.subTitleIpt = $(this.options["subTitleIpt"], this.$form);
        this.linkIpt = $(this.options["linkIpt"], this.$form);
        this.imgIpt = $(this.options["imgIpt"], this.$form);
        this.imgRootIpt = $(this.options["imgRootIpt"], this.$form);
        this.colorIptName = $("input[name="+ this.options["colorIptName"] +"]", this.$form);
        this.saveFbBtn = $(this.options["saveFbBtn"], this.$form);
        this.newFbLoader = this.saveFbBtn.next(".loader");
    }

    initPreviewer():void{
        this.imgPreview = $(this.options["imgPreviewId"], this.$previewer);
        this.titlePreview = $(this.options["titlePreviewId"], this.$previewer);
        this.subTitlePreview = $(this.options["subTitlePreviewId"], this.$previewer);
        this.colorClassPreview = $(this.options["colorClassPrviewId"], this.$previewer);
    }

    saveFrontbox():void{
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
        }).done(function(response){
            if(response.error == false){
                window.location.reload(true);
            } else {
                self.options["showMsg"](response.msg, false);
            }
            self.saveFbBtn.show();
            self.newFbLoader.hide();
        }).fail(function(xhr){
            self.options["showMsg"](xhr.statusCode + " " + xhr.statusText, false);
            self.saveFbBtn.show();
            self.newFbLoader.hide();
        });
    }

    addImgVal(imgDatas:any[]):void{
        this.imgIpt.val(imgDatas["image"]);
        this.imgRootIpt.val(imgDatas["rootDir"]);
        this.imgPreview.attr("src", imgDatas["image"]);
    }

    initEvents():void{
        var self = this;
        this.titleIpt.on("keyup", function(e){
            e.preventDefault();
            self.titlePreview.text($(this).val());
        });
        this.subTitleIpt.on("keyup", function(e){
            e.preventDefault();
            self.subTitlePreview.text($(this).val());
        });
        this.colorIptName.on("change", function(e){
            e.preventDefault();
            self.colorClassPreview.removeClass(self.curentColorClass);
            self.curentColorClass = $(this).val();
            self.colorClassPreview.addClass(self.curentColorClass);
        });
        this.saveFbBtn.on("click", function(e){
            e.preventDefault();
            console.log("click");
            self.saveFrontbox();
        });
    }
}
