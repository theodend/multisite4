/// <reference path="dts/jquery.d.ts" />
var GalleryManager = (function () {
    function GalleryManager(options) {
        this.options = {};
        this.options = $.extend(true, {}, GalleryManager.DEFAULTS, options || {});
    }
    GalleryManager.DEFAULTS = {
        updateUrl: ""
    };
    return GalleryManager;
})();
//# sourceMappingURL=gallery_manager.js.map