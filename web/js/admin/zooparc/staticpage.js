$(function(){

    var spm = new StaticPageModifier(pages, {saveUrl: saveModifUrl});

    function displayFormMsg(msg, target){

    }

    var addPageForm = $("form#add-page"),
        addPageFormMsg  = $("#add-page-form-msg"),
        addPageBtn = $("#add-page-btn");

    addPageBtn.on("click", function(e){
        e.preventDefault();


        $.post().done(function(response){
            if(response.error === false){

            } else {

            }
            displayFormMsg(response.msg, addPageFormMsg);
        }).fail(function(){

        });
    })
});
