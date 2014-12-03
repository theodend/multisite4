/// <reference path="dts/jquery.d.ts" />
var RestaurantManager = (function () {
    function RestaurantManager($element, options) {
        this.$element = $element;
        this.options = {};
        this.options = $.extend(true, {}, RestaurantManager.DEFAULTS, options || {});
        this.datas = {
            name: "",
            description: "",
            num: null,
            image: ""
        };
        this.saveBtn = $(this.options["saveBtnId"], this.$element);
        this.initEvents();
    }
    RestaurantManager.prototype.addImage = function (image) {
        this.datas.image = image;
    };
    RestaurantManager.prototype.getDatas = function () {
        return this.datas;
    };
    RestaurantManager.prototype.testDatas = function () {
        if (this.datas.name == "" || this.datas.description == "" || this.datas.image == "" || this.datas.num == null) {
            return false;
        }
        return true;
    };
    RestaurantManager.prototype.initEvents = function () {
        var self = this;
        this.saveBtn.on("click", function (e) {
            e.preventDefault();
            if (self.testDatas() === false) {
                self.options["showMsg"]("Données incomplètes.");
                return false;
            }
        });
    };
    RestaurantManager.DEFAULTS = {
        saveUrl: "",
        saveBtnId: "",
        nameId: "",
        descriptionId: "",
        numId: "",
        imageId: "",
        showMsg: function () {
        }
    };
    return RestaurantManager;
})();
//# sourceMappingURL=restaurant_manager.js.map