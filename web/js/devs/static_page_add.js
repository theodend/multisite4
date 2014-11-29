/**
 * Created by Nicolas Canfrere on 29/11/2014.
 */
/// <reference path="dts/jquery.d.ts" />
var StaticPageAdd = (function () {
    function StaticPageAdd(pages, options) {
        this.pages = pages;
        this.options = {};
        this.options = $.extend(true, {}, StaticPageAdd.DEFAULTS, options || {});
        this.form = $(this.options["formId"]);
        this.container = $(this.options["containerId"]);
        this.messenger = $(".messenger", this.container);
        this.loader = $(this.options["loaderClass"], this.form);
        this.pageList = $(this.options["pagesListId"]);
        console.log(this.pageList);
        this.loader.hide();
        this.saveBtn = $(this.options["saveBtnId"], this.form);
        this.initEvent();
    }
    StaticPageAdd.prototype.modifyTable = function (datas) {
        if (this.pageList.length < 1) {
            return false;
        }
        var row = $("<tr />", { id: "page_row_" + datas["id"] });
        row.append($("<td />", { "class": "page_cell_title", "text": datas["title"] }));
        row.append($("<td />", { "class": "page_cell_name", "text": datas["name"] }));
        row.append($("<td />", { "class": "page_cell_url", "text": datas["url"] }));
        row.append($("<td />").append("<button class='btn btn-default display-page' id='dis_page_" + datas.id + "' data-page='" + datas.id + "'><i class='fa fa-plus'></i></button>"));
        row.append($("<td />").append("<button class='btn btn-default delete-page' id='del_page_" + datas.id + "' data-page='" + datas.id + "' ><i class='fa fa-trash-o'></i></button>"));
        this.pageList.append(row);
    };
    StaticPageAdd.prototype.save = function () {
        var self = this, title = "Problème !", msg, message;
        var datas = {
            name: $(this.options["ipt_name"]).val(),
            route: $(this.options["ipt_route"]).val(),
            title: $(this.options["ipt_title"]).val(),
            description: $(this.options["ipt_description"]).val(),
            parent: $(this.options["ipt_parent"]).val(),
            keywords: $(this.options["ipt_keywords"]).val()
        };
        this.messenger.empty();
        this.saveBtn.hide();
        this.loader.show();
        message = this.options["alertHTML"];
        $.ajax({
            url: this.options["saveUrl"],
            type: "POST",
            data: datas
        }).done(function (response) {
            if (response.error == false) {
                title = "Succès !";
                message = message.replace("[[type]]", self.options["successClass"]);
                self.pages.push(response.datas);
                self.modifyTable(response.datas);
            }
            else {
                message = message.replace("[[type]]", self.options["alertClass"]);
            }
            message = message.replace("[[title]]", title).replace("[[msg]]", response["msg"]);
            self.messenger.html(message);
            self.saveBtn.show();
            self.loader.hide();
        }).fail(function (xhr) {
            message = message.replace("[[type]]", self.options["alertClass"]).replace("[[title]]", title).replace("[[msg]]", xhr.statusCode + " " + xhr.statusText);
            self.messenger.html(message);
            self.saveBtn.show();
            self.loader.hide();
        });
    };
    StaticPageAdd.prototype.initEvent = function () {
        var self = this;
        this.saveBtn.on("click", function (e) {
            e.preventDefault();
            if (self.options["saveUrl"] == "") {
                return false;
            }
            console.log("click");
            self.save();
        });
    };
    StaticPageAdd.DEFAULTS = {
        formId: "#add-page-form",
        containerId: "#add-page",
        pagesListId: "",
        saveUrl: "",
        saveBtnId: "#add-page-btn",
        loaderClass: ".loader",
        ipt_name: "#spa-name",
        ipt_route: "#spa-route",
        ipt_title: "#spa-title",
        ipt_description: "#spa-description",
        ipt_parent: "#spa-parent",
        ipt_keywords: "#spa-keywords",
        dangerClass: "alert-danger",
        successClass: "alert-success",
        alertHTML: "<div class=\'alert [[type]] alert-dismissible fade in\' role=\'alert\'><button class=\'close\' data-dismiss=\'alert\' type=\'button\'><span aria-hidden=\'true\'>&times;</span><span class=\'sr-only\'>close</span></button><h4>[[title]]</h4><p>[[msg]]</p></div>"
    };
    return StaticPageAdd;
})();
//# sourceMappingURL=static_page_add.js.map