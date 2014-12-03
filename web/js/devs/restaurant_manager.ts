/// <reference path="dts/jquery.d.ts" />

class RestaurantManager{
    static DEFAULTS = {
        imgBtn: "",
        restoImgClass: "",
        changeStatusUrl: "",
        rowRestoPrefix: "",
        statusBtnClass: ".js-status-btn",
        statusTextClass: "",
        deleteBtnClass: "",
        loaderClass: ".loader",
        openText: "",
        closeText: "",
        deleteUrl: "",
        confirmText: "Attention cette action est irréversible. Vous confirmez ?",
        showMsg: function(){}
    };

    private options = {};

    private imgBtns:JQuery;
    private imgs:JQuery;
    private overlay:JQuery;
    private statusBtns:JQuery;
    private deleteBtns:JQuery;

    constructor(public list:JQuery, options?:any){
        this.options = $.extend(true, {}, RestaurantManager.DEFAULTS, options||{});

        this.imgBtns = $(this.options["imgBtn"], this.list);
        this.imgs = $(this.options["restoImgClass"], this.list);
        this.statusBtns = $(this.options["statusBtnClass"]);
        this.deleteBtns = $(this.options["deleteBtnClass"]);
        this.overlay = $("<div id='overlay'></div>");
        $(document.body).append(this.overlay);

        this.initEvents();
    }

    deleteResto(btn:JQuery):void{
        var self, loader, id, parent;
        self = this;
        loader = btn.next(this.options["loaderClass"]);
        loader.show();
        btn.hide();
        id = btn.data("id");
        parent = btn.parents("#" + this.options["rowRestoPrefix"] + id);
        self.options["showMsg"]();
        if(window.confirm(this.options["confirmText"])){
            $.ajax({
                url: this.options["deleteUrl"],
                type: "DELETE",
                data: {id: id}
            })
                .done(function(response){
                    if(response.error == false){
                        parent.remove();
                        self.options["showMsg"](response.msg, true);
                    } else {
                        self.options["showMsg"](response.msg, false);
                    }
                    loader.hide();
                    btn.show();
                })
                .fail(function(xhr){
                    loader.hide();
                    btn.show();
                    self.options["showMsg"](xhr.statusCode + " " + xhr.statusText, false);
                });
        }
    }

    changeStatus(btn:JQuery):void{
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
            data: {id: id}
        })
            .done(function(response){
                if(response.error == false){
                    var text = (response.datas["isOpen"] == true) ? self.options["openText"] : self.options["closeText"];
                    statusText.text(text);
                    self.options["showMsg"](response.msg, true);
                } else {
                    self.options["showMsg"](response.msg, false);
                }
                loader.hide();
                btn.show();
            })
            .fail(function(xhr){
                loader.hide();
                btn.show();
                self.options["showMsg"](xhr.statusCode + " " + xhr.statusText, false);
            });
    }

    initEvents():void{
        var self = this;
        this.imgBtns.on("click", function(e){
            e.preventDefault();
            self.overlay.addClass("active");
            var img = $(this).next(".js-resto-img");
            img.addClass("active");
        });
        this.overlay.on("click", function(e){
            e.preventDefault();
            self.imgs.removeClass("active");
            $(this).removeClass("active");
        });
        this.statusBtns.on("click", function(e){
            e.preventDefault();
            self.changeStatus($(this));
        });
        this.deleteBtns.on("click", function(e){
            e.preventDefault();
            self.deleteResto($(this));
        });
    }
}
