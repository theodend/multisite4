/**
 * Created by Nicolas Canfrère on 03/12/2014.
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
interface IRestaurantDatas{
    name:string;
    description:string;
    num:string;
    image:string;
    thumb:string;
}

class NewRestaurantManager{
    static DEFAULTS = {
        saveUrl: "",
        saveBtnId: "",
        nameId: "",
        descriptionId: "",
        numId: "",
        imageId: "",
        noImageId: "",
        imgHolder: "",
        showMsg: function(){}
    };

    private options = {};
    private datas:IRestaurantDatas;
    private saveBtn:JQuery;
    private nameIpt:JQuery;
    private imageIpt:JQuery;
    private thumbIpt:JQuery;
    private numIpt:JQuery;
    private descriptionIpt:JQuery;
    private noImageAlert:JQuery;
    private loader:JQuery;
    private imgHolder:JQuery;

    constructor(public $element, options?:any){
        this.options = $.extend(true, {}, NewRestaurantManager.DEFAULTS, options||{});
        this.datas = {
            name:"",
            description:"",
            num:null,
            image:"",
            thumb:""
        };

        this.saveBtn = $(this.options["saveBtnId"], this.$element);
        this.nameIpt = $(this.options["nameId"], this.$element);
        this.imageIpt = $(this.options["imageId"], this.$element);
        this.thumbIpt = $(this.options["thumbId"], this.$element);
        this.numIpt = $(this.options["numId"], this.$element);
        this.descriptionIpt = $(this.options["descriptionId"], this.$element);
        this.noImageAlert = $(this.options["noImageId"], this.$element);
        this.imgHolder = $(this.options["imgHolder"], this.$element);
        this.loader = this.saveBtn.next(".loader");

        this.noImageAlert.text("Pas d'image uploadée.");

        this.initEvents();
    }

    save():void{
        var self = this;
        this.saveBtn.hide();
        this.loader.show();
        $.ajax({
            type: "POST",
            url: this.options["saveUrl"],
            data: this.datas
        })
            .done(function(response){
                if(response.error == false){
                    location.reload(true);
                } else {
                    self.options["showMsg"](response.msg, false);
                    self.saveBtn.show();
                    self.loader.hide();
                }
            })
            .fail(function(xhr){
                self.options["showMsg"](xhr.statusCode + " " + xhr.statusText, false);
                self.saveBtn.show();
                self.loader.hide();
            });
    }


    addImage(datas:any):void{
        this.imageIpt.val(datas["image"]);
        this.datas.image = datas["image"];
        this.thumbIpt.val(datas["thumb"]);
        this.datas.thumb = datas["thumb"];
        this.imgHolder.empty();
        var img = $("<img />", {src: this.datas.image});
        this.imgHolder.append(img);
    }

    getDatas():IRestaurantDatas{
        return this.datas;
    }

    testDatas():boolean{
        if(
            this.datas.name == "" ||
            this.datas.description == "" ||
            this.datas.image == "" ||
            this.datas.thumb == "" ||
            this.datas.num == ""
        ){
            return false;
        }
        return true;
    }

    fillDatas():void{
        this.datas.name = this.nameIpt.val();
        this.datas.description = this.descriptionIpt.val();
        this.datas.image = this.imageIpt.val();
        this.datas.num = this.numIpt.val();
        this.datas.thumb = this.thumbIpt.val();
    }

    clearErrors():void{
        var onError = this.$element.find(".has-error").removeClass("has-error");
        onError.removeClass("has-error");
        this.noImageAlert.hide();
    }

    showErrors():void{
        this.clearErrors();
        if(this.datas.name == ""){
            this.nameIpt.parents(".form-group").addClass("has-error")
        }
        if(this.datas.num == ""){
            this.numIpt.parents(".form-group").addClass("has-error")
        }
        if(this.datas.description == ""){
            this.descriptionIpt.parents(".form-group").addClass("has-error")
        }
        if(this.datas.image == ""){
            this.noImageAlert.show();
        }

    }

    initEvents():void{
        var self = this;
        this.saveBtn.on("click", function(e){
            e.preventDefault();
            self.fillDatas();
            if(self.testDatas() === false){
                self.showErrors();
                return false;
            }
            self.save();

        });
    }
}
