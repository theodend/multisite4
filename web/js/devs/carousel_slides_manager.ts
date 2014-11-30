/**
 * Created by Nicolas Canfrere on 30/11/2014.
 */
/// <reference path="dts/jquery.d.ts" />
interface ISlide{
    id:number;
    isActive:boolean;
    position:number;
    rootDir:string;
    slider:number;
    title:string;
    webRoot:string;
}

class CarouselSlidesManager{
    static DEFAULTS = {
        deleteMessage: "Attention! cette action est irréversible. Vous confirmez la suppression ?",
        deleteSlideUrl: "",
        rowPrefix: "slide_",
        showMsg: function(){},
        rowTmpl: "<div class=\'slide\' id=\'slide_[[id]]\'><table><tr><td class=\'slide-handle\'></td><td class=\'slide-position\'>[[position]]</td><td class=\'slide-img\'><img src=\'[[webRoot]]\' /></td><td class=\"slide-activation\"><label for=\"active_slide_[[id]]\"><input type=\"checkbox\" id=\"active_slide_[[id]]\"/> activer</label></td><td class=\"slide-title\"><input type=\"text\" value=\'[[title]]\'/></td><td class=\"slide-delete\"><button type=\'button\' class=\'btn btn-default slide-delete-btn\' data-slide=\'[[id]]\'><i class=\"fa fa-trash-o\"></i><div class=\"loader\"></div></button></td></tr></table></div>"
    };

    private options = {};

    constructor(public $element:JQuery, public slides?:ISlide[], options?:any){
        this.options = $.extend(true, {}, CarouselSlidesManager.DEFAULTS, options||{});

        this.init();
        this.initEvents();
    }

    init():void{

    }

    addSlide(slide:ISlide):void{
        var row;
        this.slides.push(slide);
        row = this.createRow(slide);
        this.$element.append(row);
    }

    getSlideById(id:number):ISlide{
        var result = null;
        $.each(this.slides, function(i,e){
            if(e.id == id){
                result = e;
            }
        });
        return result;
    }

    getSlideIndex(id:number):number{
        var result = null;
        $.each(this.slides, function(i,e){
            if(e.id == id){
                result = i;
            }
        });
        return result;
    }

    removeSlide(btn:JQuery, id:number):void{
        var slide, idx,loader, self = this;
        slide = this.getSlideById(id);
        idx = this.getSlideById(id);
        loader = btn.next(".loader");
        btn.hide();
        loader.show();
        if(slide != null && idx != null){
            $.ajax(
                {
                    type: "DELETE",
                    url: this.options["deleteSlideUrl"],
                    data: {id: id}
                }
            )
                .done(function(response){
                    if(response.error == false){
                        var rowId = self.options["rowPrefix"] + id;
                        $("#" + rowId).remove();
                        self.slides.splice(idx, 1);
                        self.options["showMsg"](response.msg, true);
                    } else {
                        btn.show();
                        loader.hide();
                        self.options["showMsg"](response.msg, false);
                    }
                })
                .fail(function(xhr){
                    btn.show();
                    loader.hide();
                    self.options["showMsg"](xhr.statusCode+" "+xhr.statusText, false);
                });
        }
    }

    confirm(msg?:string):boolean{
        return window.confirm(msg);
    }

    initEvents():void{
        var self = this;
        $(document).on("click", "button.slide-delete-btn", function(e){
            e.preventDefault();
            if(self.confirm(self.options["deleteMessage"])){
                self.removeSlide($(this), $(this).data("slide"));
            }
            return false;
        });
    }

    createRow(slide:ISlide):JQuery{
        var html = this.options["rowTmpl"];

        html = html.replace("[[webRoot]]", slide.webRoot).replace("[[position]]",slide.position+"").replace(/\[\[id\]\]/g, slide.id);
        if(slide.title != null){
            html = html.replace("[[title]]", slide.title);
        } else {
            html = html.replace("[[title]]", "");
        }

        return $(html);
    }
}