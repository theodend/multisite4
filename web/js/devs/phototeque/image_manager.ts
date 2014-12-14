/// <reference path="../dts/jquery.d.ts" />


class ImageManager{

    static  DEFAULTS = {
        updateUrl: "",
        deleteUrl: "",
        showMsg: function(){}
    };

    private options = {};
    private image:any;
    private stepOne:JQuery;
    private stepTwo:JQuery;
    private stepThree:JQuery;

    private dropStep:JQuery;
    private confirmStep:JQuery;
    private infosStep:JQuery;

    private confirmBtn:JQuery;
    private deleteS2Btn:JQuery;

    private saveBtn:JQuery;
    private deleteS3Btn:JQuery;

    private imgThumb:JQuery;

    constructor(options?:any){

        this.options = $.extend(true, {}, ImageManager.DEFAULTS, options||{});
        this.init();
        this.initEvents();
    }

    init():void{
        this.stepOne = $("#upload-steps .step-one");
        this.stepTwo = $("#upload-steps .step-two");
        this.stepThree= $("#upload-steps .step-three");

        this.dropStep = $("#drop-step");
        this.confirmStep = $("#confirm-step");
        this.infosStep = $("#infos-step");

        this.confirmBtn = $(".js-confirm-btn");
        this.deleteS2Btn = $(".js-s2-delete-btn");

        this.saveBtn = $(".js-save-btn");
        this.deleteS3Btn = $(".js-s3-delete-btn");

        this.imgThumb = $("#js-thumb");
    }

    setImage(image:any):void{
        this.image = image;
        this.imgThumb.attr("src", this.image["src"]);
        this.initStepTwo();
    }

    initStepTwo():void{
        this.dropStep.hide();
        this.confirmStep.show();
        this.stepOne.removeClass("active").addClass("done");
        this.stepTwo.addClass("active");
    }

    initStepThree():void{

        this.infosStep.show();
        this.stepTwo.removeClass("active").addClass("done");
        this.stepThree.addClass("active");
    }

    reloadSteps():void{
        this.imgThumb.attr("src", "");
        this.stepOne.addClass("active").removeClass("done");
        this.stepTwo.removeClass("active").removeClass("done");
        this.stepThree.removeClass("active").removeClass("done");
        this.dropStep.show();
        this.confirmStep.hide();
        this.infosStep.hide();

    }

    deleteImage(btn:JQuery):void{
        var loader = btn.next(".loader"), self = this;
        btn.hide();
        loader.show();
        $.ajax({
            type: "DELETE",
            url : this.options["deleteUrl"],
            data: {id: this.image["img"]["id"]}
        }).done(function (response) {
            if(response.error == false){
                self.image = null;
                self.reloadSteps();
                self.options["showMsg"](response.msg, true);
            } else {
                self.options["showMsg"](response.msg, false);
                btn.show();
                loader.hide();
            }

        }).fail(function (xhr) {
            self.options["showMsg"](xhr.status + " " + xhr.statusText, false);
            btn.show();
            loader.hide();
        });
    }

    initEvents():void{

        var self = this;

        this.confirmBtn.on("click", function(e){
            e.preventDefault();
            self.initStepThree();
        });

        this.deleteS2Btn.on("click", function(e){
            e.preventDefault();
            self.deleteImage($(this));
            self.reloadSteps();
        });

        this.saveBtn.on("click", function(e){
            e.preventDefault();
            self.reloadSteps();
        });

        this.deleteS3Btn.on("click", function(e){
            e.preventDefault();
            self.deleteImage($(this));
            self.reloadSteps();
        });
    }
}
