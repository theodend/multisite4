
/// <reference path="../dts/jquery.d.ts" />

class FaqManager{

    static DEFAULTS = {
        creation: {
            createFormName: "",
            createUrl: "",
            onDone: function(){},
            onFail: function(){},
            onServerFail: function(){}
        },
        update: {
            updateFormName: "",
            updateUrl: "",
            editBtnClass: "",
            updateFormBtnClass: "",
            onDone: function(){},
            onFail: function(){},
            onServerFail: function(){}
        },
        "delete": {
            deleteBtnClass: "",
            deleteUrl: "",
            onDone: function(){},
            onFail: function(){},
            onServerFail: function(){}
        }
    };

    private options = {};
    private createForm:JQuery;
    private createLoader:JQuery;
    private updateForm:JQuery;
    private updateFormBtn:JQuery;
    private updateLoader:JQuery;
    private editBtns:JQuery;
    private deleteBtns:JQuery;

    constructor(public faqs:any[], options?:any){
        this.options = $.extend(true, {}, FaqManager.DEFAULTS, options||{});
        this.init();
        this.initCreateEvents();
        this.initUpdateEvents();
        this.initDeleteEvents();
    }

    init():void{
        this.createForm = $("form[name='"+this.getCreate("createFormName")+"']");
        this.createLoader = this.createForm.find(".loader");

        this.editBtns = $(this.getUpdate("editBtnClass"));
        this.updateForm = $("form[name='"+this.getUpdate("updateFormName")+"']");
        this.updateLoader = this.updateForm.find(".loader");
        this.updateFormBtn = this.updateForm.find(this.getUpdate("updateFormBtnClass"));

        this.deleteBtns = $(this.getDelete("deleteBtnClass"));
    }

    initCreateEvents():void{
        var self = this;
        this.createForm.on("submit", function(){
            $.ajax({
                url: self.getCreate("createUrl"),
                type: "POST",
                data: $(this).serialize()
            })
                .done(function (response) {
                    if (response.error === false) {
                        self.getCreate("onDone")(response.msg, response.datas);
                    } else {
                        self.getCreate("onFail")(response.msg, response.datas);
                    }
                })
                .fail(function (xhr) {
                    self.getCreate("onServerFail")(xhr.statusCode + " " + xhr.statusText);
                });
            return false;
        });
    }

    initUpdateEvents():void{
        var self = this;
        this.editBtns.on("click", function(e){
            e.preventDefault();

            var id = $(this).data("id");
            var faq = self.getById(parseInt(id));
            if(faq == null){
                return;
            }


            self.dispatchDatasInUpdateForm(faq);
        });

        this.updateForm.on("submit", function(){
            if($(this).data("id") == ""){
                return false;
            }
            var url = self.getUpdate("updateUrl") + "&id=" + $(this).data("id");
            self.updateFormBtn.hide();
            self.updateLoader.show();
            $.ajax({
                type: "PUT",
                url: url,
                data: $(this).serialize()
            })
                .done(function (response) {
                    if (response.error === false) {
                        self.getCreate("onDone")(response.msg, response.datas);
                    } else {
                        self.getCreate("onFail")(response.msg, response.datas);
                    }
                    console.log(response);
                    self.updateFormBtn.show();
                    self.updateLoader.hide();
                })
                .fail(function (xhr) {
                    self.getCreate("onServerFail")(xhr.statusCode + " " + xhr.statusText);
                    self.updateFormBtn.show();
                    self.updateLoader.hide();
                });
            return false;
        });
    }

    initDeleteEvents():void{
        var self = this;
        this.deleteBtns.on("click", function(e){
            e.preventDefault();
            var url = self.getDelete("deleteUrl");
            var datas = {};
            $.ajax({
                url: url,
                type: "DELETE",
                data: datas
            })
                .done(function(response){
                    if (response.error === false) {
                        self.getDelete("onDone")(response.msg, response.datas);
                    } else {
                        self.getDelete("onFail")(response.msg, response.datas);
                    }
                })
                .fail(function(xhr){
                    self.getDelete("onServerFail")(xhr.statusCode + " " + xhr.statusText);
                });
        })
    }

    dispatchDatasInUpdateForm(faq:any):void{
        this.updateForm.data("id", faq["id"]);
        this.updateForm.find("#update_faq_form_question").val(faq["question"]);
        this.updateForm.find("#update_faq_form_response").val(faq["response"]);
        this.updateForm.find("#update_faq_form_site").val(faq["site"]["id"]);
    }

    getCreate(index:string):any{
        if(this.options["creation"].hasOwnProperty(index)){
            return this.options["creation"][index];
        }
        return "";
    }

    getUpdate(index:string):any{
        if(this.options["update"].hasOwnProperty(index)){
            return this.options["update"][index];
        }
        return "";
    }

    getDelete(index:string):any{
        if(this.options["delete"].hasOwnProperty(index)){
            return this.options["delete"][index];
        }
        return "";
    }

    getById(id:number):any{
        var result = null;
        $.each(this.faqs, function(i,e){
            if(e["id"] == id){
                result = e;
            }
        });
        return result;
    }
}
