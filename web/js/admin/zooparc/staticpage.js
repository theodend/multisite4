$(function(){

    var spm = new StaticPageModifier(pages, {saveUrl: saveModifUrl});
    var spa = new StaticPageAdd(pages, {saveUrl: addPageUrl, pagesListId: "#pages-list"});
    var spd = new StaticPageDelete(pages, {deleteUrl:deletePageUrl, pagesListId: "#pages-list"});

});
