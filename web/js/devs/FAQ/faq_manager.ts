
/// <reference path="../dts/jquery.d.ts" />

class FaqManager{

    static DEFAULTS = {
        creation: {
            createFormName: "",
            createUrl: "",
            updateFormBtnClass: "",
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
    private createFormBtn:JQuery;
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
        this.createFormBtn = $(this.getCreate("updateFormBtnClass"));

        this.editBtns = $(this.getUpdate("editBtnClass"));
        this.updateForm = $("form[name='"+this.getUpdate("updateFormName")+"']");
        this.updateLoader = this.updateForm.find(".loader");
        this.updateFormBtn = this.updateForm.find(this.getUpdate("updateFormBtnClass"));

        this.deleteBtns = $(this.getDelete("deleteBtnClass"));
    }

    initCreateEvents():void{
        var self = this;
        this.createForm.on("submit", function(){
            self.createFormBtn.hide();
            self.createLoader.show();
            $.ajax({
                url: self.getCreate("createUrl"),
                type: "POST",
                data: $(this).serialize()
            })
                .done(function (response) {
                    if (response.error === false) {
                        self.getCreate("onDone")(response.msg, response.datas);
                        self.faqs.push(response.datas);
                    } else {
                        self.getCreate("onFail")(response.msg, response.datas);
                    }
                    self.createFormBtn.show();
                    self.createLoader.hide();
                })
                .fail(function (xhr) {
                    self.getCreate("onServerFail")(xhr.statusCode + " " + xhr.statusText);
                    self.createFormBtn.show();
                    self.createLoader.hide();
                });
            return false;
        });
    }

    initUpdateEvents():void{
        var self = this;
        $(document).on("click", this.getUpdate("editBtnClass"), function(e){
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
                type: "POST",
                url: url,
                data: $(this).serialize()
            })
                .done(function (response) {
                    if (response.error === false) {
                        self.getUpdate("onDone")(response.msg, response.datas);
                    } else {
                        self.getUpdate("onFail")(response.msg, response.datas);
                    }
                    console.log(response);
                    self.updateFormBtn.show();
                    self.updateLoader.hide();
                })
                .fail(function (xhr) {
                    self.getUpdate("onServerFail")(xhr.statusCode + " " + xhr.statusText);
                    self.updateFormBtn.show();
                    self.updateLoader.hide();
                });
            return false;
        });
    }

    initDeleteEvents():void{
        var self = this;
        $(document).on("click",this.getDelete("deleteBtnClass"), function(e){
            e.preventDefault();
            var id = $(this).data("id");
            var faqIdx = self.getIndex(parseInt(id));
            if(faqIdx == null){
                return;
            }
            var btn = $(this);
            var url = self.getDelete("deleteUrl") + "&id=" + id;
            var datas = {id: id};
            var loader = $(this).next(".loader");
            btn.hide();
            loader.show();
            $.ajax({
                url: url,
                type: "DELETE",
                data: datas
            })
                .done(function(response){
                    if (response.error === false) {
                        response.datas["id"] = id;
                        self.getDelete("onDone")(response.msg, response.datas);
                        self.faqs.splice(faqIdx, 1);
                    } else {
                        self.getDelete("onFail")(response.msg, response.datas);
                    }
                    btn.show();
                    loader.hide();
                })
                .fail(function(xhr){
                    btn.show();
                    loader.hide();
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

    getIndex(id:number):number{
        var result = null;
        $.each(this.faqs, function(i,e){
            if(e["id"] == id){
                result = i;
            }
        })
        return 1;
    }
}
