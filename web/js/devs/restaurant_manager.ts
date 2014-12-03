/**
 * Created by Nicolas Canfrère on 03/12/2014.
 */
 /*
           ____________________
  __      /     ______         \
 {  \ ___/___ /       }         \
  {  /       / #      }          |
   {/ ô ô  ;       __}           |
   /          \__}    /  \       /\
<=(_    __<==/  |    /\___\     |  \
   (_ _(    |   |   |  |   |   /    #
    (_ (_   |   |   |  |   |   |
      (__<  |mm_|mm_|  |mm_|mm_|
*/
/// <reference path="dts/jquery.d.ts" />
interface IRestaurantDatas{
    name:string;
    description:string;
    num:number;
    image:string;
}

class RestaurantManager{
    static DEFAULTS = {
        saveUrl: "",
        saveBtnId: "",
        nameId: "",
        descriptionId: "",
        numId: "",
        imageId: "",
        showMsg: function(){}
    };

    private options = {};
    private datas:IRestaurantDatas;
    private saveBtn:JQuery;

    constructor(public $element, options?:any){
        this.options = $.extend(true, {}, RestaurantManager.DEFAULTS, options||{});
        this.datas = {
            name:"",
            description:"",
            num:null,
            image:""
        };

        this.saveBtn = $(this.options["saveBtnId"], this.$element);

        this.initEvents();
    }

    addImage(image:string):void{
        this.datas.image = image;
    }

    getDatas():IRestaurantDatas{
        return this.datas;
    }

    testDatas():boolean{

        if(
            this.datas.name == "" ||
            this.datas.description == "" ||
            this.datas.image == "" ||
            this.datas.num == null
        ){
            return false;
        }


        return true;
    }

    initEvents():void{
        var self = this;
        this.saveBtn.on("click", function(e){
            e.preventDefault();

            if(self.testDatas() === false){
                self.options["showMsg"]("Données incomplètes.");
                return false;
            }


        });
    }
}
