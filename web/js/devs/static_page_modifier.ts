/**
 * Created by Nicolas Canfrere on 28/11/2014.
 */
/// <reference path="dts/jquery.d.ts" />

class StaticPageModifier{
    static DEFAULTS = {
        formId: "#static-page-modifier-form",
        containerId: "#static-page-modifier",
        ipt_name:"#spm-name",
        ipt_slug:"#spm-slug",
        ipt_route:"#spm-route",
        ipt_url:"#spm-url",
        ipt_title:"#spm-title",
        ipt_description:"#spm-description",
        ipt_parent:"#spm-parent",
        ipt_keywords:"#spm-keywords",
        buttonClass: ".display-page",
        saveBtnId: "#save-modif-btn",
        saveUrl: ""
    };

    private options = {};
    private form:JQuery;
    private currentPageId:number = null;
    private currentPage:any = null;
    private index:number = null;
    private saveBtn:JQuery;
    private container:JQuery;
    private loader:JQuery;


    constructor(public pages:any[], options?:any){
        this.options = $.extend(true, {}, StaticPageModifier.DEFAULTS, options||{});
        this.container = $(this.options["containerId"]);
        this.form = $(this.options["formId"]);
        this.saveBtn = $(this.options["saveBtnId"]);
        this.loader = this.form.find(".loader");
        this.loader.hide();
        console.log(this.loader);
        this.initEvents();
    }

    clearForm():void{
        $(this.options["ipt_name"]).val("");
        $(this.options["ipt_slug"]).val("");
        $(this.options["ipt_route"]).val("");
        $(this.options["ipt_url"]).val("");
        $(this.options["ipt_title"]).val("");
        $(this.options["ipt_description"]).val("");
        $(this.options["ipt_keywords"]).val("");
        $(this.options["ipt_parent"]).val("");
    }

    formFill():void{
        var prop;
        this.clearForm();
        this.currentPage = this.getPage(this.currentPageId);
        console.log(this.currentPage);
        for(prop in this.currentPage){
            if(this.currentPage.hasOwnProperty(prop) && this.currentPage[prop] != null){
                $(this.options["ipt_" + prop]).val(this.currentPage[prop] + "");
            }
        }

        this.showForm();
    }

    showForm():void{
        this.container.show();
    }

    getPage(id):any{
        var result = null;
        var self = this;
        $.each(this.pages, function(i,el){
            if(el["id"] === id){
                result = el;
                self.index = i;
            }
        });
        return result;
    }

    savePage():void{
        var self = this;
        var datas = {
            id: this.currentPageId,
            name: $(this.options["ipt_name"]).val(),
            route: $(this.options["ipt_route"]).val(),
            title: $(this.options["ipt_title"]).val(),
            description: $(this.options["ipt_description"]).val(),
            parent: $(this.options["ipt_parent"]).val(),
            keywords: $(this.options["ipt_keywords"]).val()
        } ;

        this.saveBtn.hide();
        this.loader.show();
        $.ajax(
            {
                url: this.options["saveUrl"],
                type: "PUT",
                data: datas
            }
        )
            .done(function(response){
                if(response["error"] == false){
                    self.pages[self.index] = response["datas"];
                    self.currentPage = response["datas"];
                    self.formFill();
                } else {

                }
                self.saveBtn.show();
                self.loader.hide();
            })
            .fail(function(xhr){
                self.saveBtn.show();
                self.loader.hide();
            });
    }

    initEvents():void{
        var self = this;
        $(document).on("click", this.options["buttonClass"], function(e){
            e.preventDefault();
            self.currentPageId = $(this).data("page");
            console.log($(this), self.currentPageId);
            self.formFill();

        });

        this.saveBtn.on("click", function(e){
            e.preventDefault();

            self.savePage();

        })
    }

}
