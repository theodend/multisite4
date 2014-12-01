/// <reference path="dts/jquery.d.ts" />

class GalleryManager{
    static DEFAULTS = {
        updateUrl: ""
    };
    private options = {};

    constructor(options?:any){

        this.options = $.extend(true, {}, GalleryManager.DEFAULTS, options||{});
    }
}
