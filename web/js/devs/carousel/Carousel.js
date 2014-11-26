/// <reference path="../dts/jquery.d.ts" />
var Caroussel = (function () {
    function Caroussel(element, options) {
        this.element = element;
        this.options = {};
        this.isResizing = null;
        this.interval = null;
        this.current = 0;
        this.isStarted = false;
        this.isStopped = false;
        this.imgs = [];
        this.options = $.extend(true, {}, Caroussel.DEFAULTS, options || {});
        this.isInitialized = false;
        this.element.addClass(this.getOpt("carouselClass"));
        this.slidesContainer = this.element.find(this.getClass("slideContainerClass"));
        this.slides = this.slidesContainer.find(this.getClass("slideClass"));
        this.numSlides = this.slides.length;
        if (this.numSlides < 1) {
            throw new Error("There is no slide to display");
        }
        this.init();
        //
    }
    Caroussel.prototype.init = function () {
        this.sliderHeight = this.element.height();
        this.sliderWidth = this.getSliderWidth();
        for (var i = 0; i < this.numSlides; i++) {
            this.imgs.push($(this.slides[i]).find("img").data("src"));
        }
        this.createLoader();
        this.initLoadImgs();
        this.getOpt("onInit")(this);
    };
    Caroussel.prototype.initLoadImgs = function () {
        var self = this, idx = 0, current = 0;
        var img = $(this.slides[current]).find("img:first");
        img.load(function (e) {
            self.loaderLayer.empty();
            self.imgs.shift();
            self.getOpt("onLoad")(this, idx);
            $(self.slides[current]).hide().fadeIn(150, function () {
                self.firstImg = img;
                self.imgWidth = img.width();
                self.position();
            });
            if (self.imgs.length > 0) {
                idx++;
                self.loadNext(idx);
            }
        }).attr("src", this.imgs[0]);
    };
    Caroussel.prototype.loadNext = function (idx) {
        var self = this;
        var img = $(this.slides[idx]).find("img:first");
        $(this.slides[idx]).hide();
        img.load(function (e) {
            self.imgs.shift();
            self.getOpt("onLoad")(this, idx);
            if (self.imgs.length > 0) {
                idx++;
                self.loadNext(idx);
            }
            else {
                self.start();
            }
        }).attr("src", this.imgs[0]);
    };
    Caroussel.prototype.start = function () {
        var self = this;
        this.isResizing = null;
        if (this.isInitialized === false) {
            this.initEvents();
            this.isInitialized = true;
        }
        if (this.interval !== null) {
            this.stop();
        }
        this.interval = window.setInterval(function () {
            self.next();
        }, this.getOpt("duration"));
        this.getOpt("onStart")(this);
    };
    Caroussel.prototype.stop = function (internal) {
        this.isStarted = false;
        if (internal === undefined || internal === false) {
            this.isStopped = true;
        }
        if (this.interval !== null) {
            window.clearInterval(this.interval);
            this.interval = null;
        }
        this.getOpt("onStop")(this);
    };
    Caroussel.prototype.next = function () {
        $(this.slides.get(this.current++)).fadeOut(this.getOpt("fadeTransionTime"));
        if (this.current === this.numSlides) {
            this.current = 0;
        }
        $(this.slides.get(this.current)).fadeIn(this.getOpt("fadeTransionTime"));
        this.getOpt("onNext")(this);
    };
    Caroussel.prototype.prev = function () {
        this.getOpt("onPrev")(this);
    };
    Caroussel.prototype.moveTo = function (index) {
        this.getOpt("onMoveTo")(this);
    };
    Caroussel.prototype.getSliderWidth = function () {
        return this.getOpt("fullWidth") === true ? $(window).width() : this.element.width();
    };
    Caroussel.prototype.position = function () {
        this.slidesContainer.css("left", -((this.imgWidth - this.getSliderWidth()) / 2) + "px");
    };
    Caroussel.prototype.createLoader = function () {
        var self = this;
        this.loaderLayer = $("<div />", { "id": "loader-layer" });
        var tpl = "<div class='spinner'>" + "<div class='spinner-container container1'>" + "<div class='circle1'></div>" + "<div class='circle2'></div>" + "<div class='circle3'></div>" + "<div class='circle4'></div>" + "</div>" + "<div class='spinner-container container2'>" + "<div class='circle1'></div>" + "<div class='circle2'></div>" + "<div class='circle3'></div>" + "<div class='circle4'></div>" + "</div>" + "<div class='spinner-container container3'>" + "<div class='circle1'></div>" + "<div class='circle2'></div>" + "<div class='circle3'></div>" + "<div class='circle4'></div>" + "</div>" + "</div>";
        this.loaderLayer.html(tpl);
        this.loaderLayer.css({
            "position": "absolute",
            "top": ((self.sliderHeight - this.loaderLayer.height()) / 2) + "px",
            "left": ((self.sliderWidth - this.loaderLayer.width()) / 2)
        });
        this.element.append(this.loaderLayer);
    };
    Caroussel.prototype.initEvents = function () {
        var self = this;
        $(window).on("resize", function () {
            if (self.options["auto"] === true) {
                self.stop(true);
            }
            if (self.isResizing !== null) {
                window.clearTimeout(self.isResizing);
                self.isResizing = null;
            }
            self.isResizing = window.setTimeout(function () {
                self.position();
                if (self.options["auto"] === true && self.isStopped === false) {
                    self.start();
                }
            }, 300);
        });
    };
    Caroussel.prototype.getClass = function (name) {
        return "." + this.getOpt(name);
    };
    Caroussel.prototype.getOpt = function (key) {
        if (!this.options.hasOwnProperty(key)) {
            throw new Error("Option named " + key + " is undefined.");
        }
        return this.options[key];
    };
    Caroussel.DEFAULTS = {
        duration: 2000,
        fadeTransionTime: 300,
        auto: true,
        carouselClass: "header-carousel",
        slideContainerClass: "hc-slides",
        slideClass: "hc-slide",
        fullWidth: true,
        onInit: function () {
        },
        onLoad: function () {
        },
        onStart: function () {
        },
        onStop: function () {
        },
        onNext: function () {
        },
        onPrev: function () {
        },
        onMoveTo: function () {
        }
    };
    return Caroussel;
})();
//# sourceMappingURL=Carousel.js.map