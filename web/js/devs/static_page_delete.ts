/**
 * Created by Nicolas Canfrere on 29/11/2014.
 */
/// <reference path="dts/jquery.d.ts" />

class StaticPageDelete{

    static DEFAULTS = {
        deleteBtnClass: ".delete-page",
        containerId: "#pages",
        pagesListId: "",
        confirmMsg: "Attention cette action est définitive. Poursuivre ?",
        deleteUrl: "",
        dangerClass: "alert-danger",
        successClass: "alert-success",
        alertHTML: "<div class=\'alert [[type]] alert-dismissible fade in\' role=\'alert\'><button class=\'close\' data-dismiss=\'alert\' type=\'button\'><span aria-hidden=\'true\'>&times;</span><span class=\'sr-only\'>close</span></button><h4>[[title]]</h4><p>[[msg]]</p></div>"
    };

    private options = {};
    private container:JQuery;
    private messenger:JQuery;
    private loader:JQuery;
    private pageList:JQuery;

    constructor(public pages:any[], options?:any){
        this.options = $.extend(true, {}, StaticPageDelete.DEFAULTS, options||{});
        this.container = $(this.options["containerId"]);
        this.loader = $(".loader", this.container);
        this.loader.hide();
        this.messenger = $(".messenger", this.container);
        this.pageList = $(this.options["pagesListId"]);
        this.initEvents();
    }

    getPage(id):any[]{
        var result = null;

        $.each(this.pages, function(i,el){
            if(el["id"] === id){
                result = [i, el];

            }
        });
        return result;
    }

    removeDatas(datas:any):void{
        var el = this.getPage(datas["id"]);
        if(el !== null){
            this.pages.splice(el[0], 1);
        }
    }

    modifyTable(datas:any):boolean{
        if(this.pageList.length<1){
            return false;
        }
        var row = this.pageList.find("tr#page_row_"+datas["id"]);
        if(row.length<1){
            return false;
        }
        row.remove();
        return true;
    }

    removePage(page:any[]):void{
        var self = this, title="Problème !", msg, message;
        this.messenger.empty();
        this.loader.show();
        message = this.options["alertHTML"];
        $.ajax(
            {
                url: this.options["deleteUrl"],
                type: "DELETE",
                data: page[1]
            }
        )
        .done(function(response){
                if(response.error == false){
                    title = "Succès !";
                    message = message.replace("[[type]]", self.options["successClass"]);
                    self.modifyTable(response["datas"]);
                    self.removeDatas(response["datas"]);
                } else {
                    message = message.replace("[[type]]", self.options["alertClass"]);
                }
                message = message.replace("[[title]]", title).replace("[[msg]]", response["msg"]);
                self.messenger.html(message);
                self.loader.hide();
            })
        .fail(function(xhr){
                message = message.replace("[[type]]", self.options["alertClass"]).replace("[[title]]", title).replace("[[msg]]", xhr.statusCode + " " + xhr.statusText);
                self.messenger.html(message);
                self.loader.hide();
            });
    }

    initEvents():void{
        var self = this;
        $(document).on("click", this.options["deleteBtnClass"], function(e){
            e.preventDefault();
            if(window.confirm(self.options["confirmMsg"])){
                var id = $(this).data("page");

                self.removePage(self.getPage(id));
            }

        });
    }
}
