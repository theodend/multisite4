/// <reference path="../dts/jquery.d.ts" />
var FaqManager = (function () {
    function FaqManager(faqs, options) {
        this.faqs = faqs;
        this.options = {};
        this.options = $.extend(true, {}, FaqManager.DEFAULTS, options || {});
        this.init();
        this.initCreateEvents();
        this.initUpdateEvents();
        this.initDeleteEvents();
    }
    FaqManager.prototype.init = function () {
        this.createForm = $("form[name='" + this.getCreate("createFormName") + "']");
        this.createLoader = this.createForm.find(".loader");
        this.createFormBtn = $(this.getCreate("updateFormBtnClass"));
        this.editBtns = $(this.getUpdate("editBtnClass"));
        this.updateForm = $("form[name='" + this.getUpdate("updateFormName") + "']");
        this.updateLoader = this.updateForm.find(".loader");
        this.updateFormBtn = this.updateForm.find(this.getUpdate("updateFormBtnClass"));
        this.deleteBtns = $(this.getDelete("deleteBtnClass"));
    };
    FaqManager.prototype.initCreateEvents = function () {
        var self = this;
        this.createForm.on("submit", function () {
            self.createFormBtn.hide();
            self.createLoader.show();
            $.ajax({
                url: self.getCreate("createUrl"),
                type: "POST",
                data: $(this).serialize()
            }).done(function (response) {
                if (response.error === false) {
                    self.getCreate("onDone")(response.msg, response.datas);
                    self.faqs.push(response.datas);
                }
                else {
                    self.getCreate("onFail")(response.msg, response.datas);
                }
                self.createFormBtn.show();
                self.createLoader.hide();
            }).fail(function (xhr) {
                self.getCreate("onServerFail")(xhr.statusCode + " " + xhr.statusText);
                self.createFormBtn.show();
                self.createLoader.hide();
            });
            return false;
        });
    };
    FaqManager.prototype.initUpdateEvents = function () {
        var self = this;
        $(document).on("click", this.getUpdate("editBtnClass"), function (e) {
            e.preventDefault();
            var id = $(this).data("id");
            var faq = self.getById(parseInt(id));
            if (faq == null) {
                return;
            }
            self.dispatchDatasInUpdateForm(faq);
        });
        this.updateForm.on("submit", function () {
            if ($(this).data("id") == "") {
                return false;
            }
            var url = self.getUpdate("updateUrl") + "&id=" + $(this).data("id");
            self.updateFormBtn.hide();
            self.updateLoader.show();
            $.ajax({
                type: "POST",
                url: url,
                data: $(this).serialize()
            }).done(function (response) {
                if (response.error === false) {
                    self.getUpdate("onDone")(response.msg, response.datas);
                }
                else {
                    self.getUpdate("onFail")(response.msg, response.datas);
                }
                console.log(response);
                self.updateFormBtn.show();
                self.updateLoader.hide();
            }).fail(function (xhr) {
                self.getUpdate("onServerFail")(xhr.statusCode + " " + xhr.statusText);
                self.updateFormBtn.show();
                self.updateLoader.hide();
            });
            return false;
        });
    };
    FaqManager.prototype.initDeleteEvents = function () {
        var self = this;
        $(document).on("click", this.getDelete("deleteBtnClass"), function (e) {
            e.preventDefault();
            var id = $(this).data("id");
            var faqIdx = self.getIndex(parseInt(id));
            if (faqIdx == null) {
                return;
            }
            var btn = $(this);
            var url = self.getDelete("deleteUrl") + "&id=" + id;
            var datas = { id: id };
            var loader = $(this).next(".loader");
            btn.hide();
            loader.show();
            $.ajax({
                url: url,
                type: "DELETE",
                data: datas
            }).done(function (response) {
                if (response.error === false) {
                    response.datas["id"] = id;
                    self.getDelete("onDone")(response.msg, response.datas);
                    self.faqs.splice(faqIdx, 1);
                }
                else {
                    self.getDelete("onFail")(response.msg, response.datas);
                }
                btn.show();
                loader.hide();
            }).fail(function (xhr) {
                btn.show();
                loader.hide();
                self.getDelete("onServerFail")(xhr.statusCode + " " + xhr.statusText);
            });
        });
    };
    FaqManager.prototype.dispatchDatasInUpdateForm = function (faq) {
        this.updateForm.data("id", faq["id"]);
        this.updateForm.find("#update_faq_form_question").val(faq["question"]);
        this.updateForm.find("#update_faq_form_response").val(faq["response"]);
        this.updateForm.find("#update_faq_form_site").val(faq["site"]["id"]);
    };
    FaqManager.prototype.getCreate = function (index) {
        if (this.options["creation"].hasOwnProperty(index)) {
            return this.options["creation"][index];
        }
        return "";
    };
    FaqManager.prototype.getUpdate = function (index) {
        if (this.options["update"].hasOwnProperty(index)) {
            return this.options["update"][index];
        }
        return "";
    };
    FaqManager.prototype.getDelete = function (index) {
        if (this.options["delete"].hasOwnProperty(index)) {
            return this.options["delete"][index];
        }
        return "";
    };
    FaqManager.prototype.getById = function (id) {
        var result = null;
        $.each(this.faqs, function (i, e) {
            if (e["id"] == id) {
                result = e;
            }
        });
        return result;
    };
    FaqManager.prototype.getIndex = function (id) {
        var result = null;
        $.each(this.faqs, function (i, e) {
            if (e["id"] == id) {
                result = i;
            }
        });
        return 1;
    };
    FaqManager.DEFAULTS = {
        creation: {
            createFormName: "",
            createUrl: "",
            updateFormBtnClass: "",
            onDone: function () {
            },
            onFail: function () {
            },
            onServerFail: function () {
            }
        },
        update: {
            updateFormName: "",
            updateUrl: "",
            editBtnClass: "",
            updateFormBtnClass: "",
            onDone: function () {
            },
            onFail: function () {
            },
            onServerFail: function () {
            }
        },
        "delete": {
            deleteBtnClass: "",
            deleteUrl: "",
            onDone: function () {
            },
            onFail: function () {
            },
            onServerFail: function () {
            }
        }
    };
    return FaqManager;
})();
//# sourceMappingURL=faq_manager.js.map