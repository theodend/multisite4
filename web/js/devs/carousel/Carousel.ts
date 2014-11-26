/// <reference path="../dts/jquery.d.ts" />


class Caroussel{

    static DEFAULTS = {
        duration: 2000,
        fadeTransionTime: 300,
        auto: true,
        slideContainerClass: "slides",
        slideClass: "slides",
        fullWidth: true,
        onInit: function(){},
        onStart: function(){},
        onStop: function(){},
        onNext: function(){},
        onPrev: function(){},
        onMoveTo: function(){}
    };

    private options = {};

    private slidesContainer:JQuery;
    private slides:JQuery;
    private numSlides:number;
    private isResizing = null;
    private interval = null;
    private current = 0;
    private width:number;
    private firstImg:JQuery;
    private isStarted = false;
    private loaderLayer:JQuery;

    private sliderWidth:number;
    private sliderHeight:number;

    constructor(public element:JQuery, options?:any){

        this.options = $.extend(true, {}, Caroussel.DEFAULTS, options||{});

        this.slidesContainer = this.element.find(this.getClass("slideContainerClass"));
        this.slides = this.slidesContainer.find(this.getClass("slideClass"));
        this.numSlides = this.slides.length;
        if(this.numSlides < 1 ){
            throw new Error("There is no slide to display");
        }
        this.init();

        this.initEvents();
    }

    init():void{
        this.sliderHeight = this.element.height();
        this.sliderWidth = this.getOpt("fullWidth") === true ? $(window).width() : this.element.width();
        this.createLoader();
        this.getOpt("onInit")(this);
    }

    start():void {
        var self = this;
        if(this.interval !== null){
            this.stop();
        }
        this.interval = window.setInterval(function(){
            self.next();
        }, this.getOpt("duration"));
        this.getOpt("onStart")(this);
    }

    stop():void {
        this.isStarted = false;
        if(this.interval !== null){
            window.clearInterval(this.interval);
            this.interval = null;
        }

        this.getOpt("onStop")(this);
    }

    next():void {

        this.getOpt("onNext")(this);
    }

    prev():void {

        this.getOpt("onPrev")(this);
    }

    moveTo(index:number):void {
        this.getOpt("onMoveTo")(this);
    }

    position():void{

    }

    getVisible():void {

    }

    createLoader():void {
        var self = this;
        this.loaderLayer = $("<div />", {"id": "loader-layer"});
        var tpl = "<div class='spinner'>"
        + "<div class='spinner-container container1'>"
        + "<div class='circle1'></div>"
        + "<div class='circle2'></div>"
        + "<div class='circle3'></div>"
        + "<div class='circle4'></div>"
        + "</div>"
        + "<div class='spinner-container container2'>"
        + "<div class='circle1'></div>"
        + "<div class='circle2'></div>"
        + "<div class='circle3'></div>"
        + "<div class='circle4'></div>"
        + "</div>"
        + "<div class='spinner-container container3'>"
        + "<div class='circle1'></div>"
        + "<div class='circle2'></div>"
        + "<div class='circle3'></div>"
        + "<div class='circle4'></div>"
        + "</div>"
        + "</div>";
        this.loaderLayer.html(tpl);
        this.loaderLayer.css({
            "position": "absolute",
            "top": ((self.sliderHeight - loaderLayer.height())/2) + "px",
            "left": ((self.sliderWidth - loaderLayer.width())/2)
        });
        this.element.append(this.loaderLayer);
    }

    initEvents():void {
        var self = this;
        $(window).on("resize", function(){
            if(self.options["auto"] === true){
                self.stop();
            }
            window.clearTimeout(self.isResizing);
            self.isResizing = window.setTimeout(function(){
                if(self.options["auto"] === true){
                    self.start();
                }
            }, 200);
            self.getVisible();
            self.width = self.firstImg.width();
            self.position();

        });
    }

    getClass(name:string):string {
        return "." + this.getOpt(name);
    }

    getOpt(key:string):any {
        if(!this.options.hasOwnProperty(key)){
            throw new Error("Option named " + key + " is undefined.");
        }
        return this.options[key];
    }
}
