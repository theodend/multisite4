/**
 * Created by Nicolas Canfrere on 28/11/2014.
 */
/// <reference path="dts/jquery.d.ts" />
var StaticPageModifier = (function () {
    function StaticPageModifier(pages, options) {
        this.pages = pages;
        this.options = {};
        this.currentPageId = null;
        this.currentPage = null;
        this.index = null;
        this.options = $.extend(true, {}, StaticPageModifier.DEFAULTS, options || {});
        this.container = $(this.options["containerId"]);
        this.messenger = this.container.find(".messenger");
        this.form = $(this.options["formId"]);
        this.saveBtn = $(this.options["saveBtnId"]);
        this.loader = this.form.find(".loader");
        this.loader.hide();
        this.initEvents();
    }
    StaticPageModifier.prototype.clearForm = function () {
        $(this.options["ipt_name"]).val("");
        $(this.options["ipt_slug"]).val("");
        $(this.options["ipt_route"]).val("");
        $(this.options["ipt_url"]).val("");
        $(this.options["ipt_site"]).val("");
        $(this.options["ipt_title"]).val("");
        $(this.options["ipt_description"]).val("");
        $(this.options["ipt_keywords"]).val("");
        $(this.options["ipt_parent"]).val("");
    };
    StaticPageModifier.prototype.formFill = function () {
        var prop;
        this.clearForm();
        this.currentPage = this.getPage(this.currentPageId);
        for (prop in this.currentPage) {
            if (this.currentPage.hasOwnProperty(prop) && this.currentPage[prop] != null) {
                $(this.options["ipt_" + prop]).val(this.currentPage[prop] + "");
            }
        }
        this.showForm();
    };
    StaticPageModifier.prototype.showForm = function () {
        this.container.show();
    };
    StaticPageModifier.prototype.getPage = function (id) {
        var result = null;
        var self = this;
        $.each(this.pages, function (i, el) {
            if (el["id"] === id) {
                result = el;
                self.index = i;
            }
        });
        return result;
    };
    StaticPageModifier.prototype.modifyTable = function () {
        var row, id = "#page_row_" + this.currentPageId;
        row = $(id);
        $("td.page_cell_title", row).text(this.currentPage.title);
        $("td.page_cell_name", row).text(this.currentPage.name);
        $("td.page_cell_url", row).text(this.currentPage.url);
    };
    StaticPageModifier.prototype.savePage = function () {
        var self = this, title = "Problème !", msg, message;
        var datas = {
            id: this.currentPageId,
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
            type: "PUT",
            data: datas
        }).done(function (response) {
            if (response["error"] == false) {
                self.pages[self.index] = response["datas"];
                self.currentPage = response["datas"];
                self.formFill();
                title = "Succès !";
                message = message.replace("[[type]]", self.options["successClass"]);
                self.modifyTable();
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
    StaticPageModifier.prototype.initEvents = function () {
        var self = this;
        $(document).on("click", this.options["buttonClass"], function (e) {
            e.preventDefault();
            self.currentPageId = $(this).data("page");
            self.formFill();
        });
        this.saveBtn.on("click", function (e) {
            e.preventDefault();
            self.savePage();
        });
    };
    StaticPageModifier.DEFAULTS = {
        formId: "#static-page-modifier-form",
        containerId: "#static-page-modifier",
        ipt_name: "#spm-name",
        ipt_slug: "#spm-slug",
        ipt_route: "#spm-route",
        ipt_url: "#spm-url",
        ipt_title: "#spm-title",
        ipt_description: "#spm-description",
        ipt_parent: "#spm-parent",
        ipt_site: "#spm-site",
        ipt_keywords: "#spm-keywords",
        buttonClass: ".display-page",
        saveBtnId: "#save-modif-btn",
        saveUrl: "",
        dangerClass: "alert-danger",
        successClass: "alert-success",
        alertHTML: "<div class=\'alert [[type]] alert-dismissible fade in\' role=\'alert\'><button class=\'close\' data-dismiss=\'alert\' type=\'button\'><span aria-hidden=\'true\'>&times;</span><span class=\'sr-only\'>close</span></button><h4>[[title]]</h4><p>[[msg]]</p></div>"
    };
    return StaticPageModifier;
})();
//# sourceMappingURL=static_page_modifier.js.map