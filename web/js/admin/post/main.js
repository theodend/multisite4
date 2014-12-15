$(function(){
    var counterTitle = $("#counter-title>.counter-num");
    var counterExcerpt = $("#counter-excerpt>.counter-num");
    var counterBody = $("#counter-body>.counter-num");
    var postTitleIpt = $("#post_form_title");
    var postExcerptIpt = $("#post_form_excerpt");
    var postBodyIpt = $("#post_form_body");
    var postForm = $("form[name='post_form']");
    var saveDraftBtn = $("#post_form_saveDraft");
    var savePublishBtn = $("#post_form_savePublish");

    var showMsg = function(msg, success){
        if(arguments.length <1){
            messenger.empty();
            return false;
        }
        var type, title;
        var html =  "<div class=\'alert [[type]] alert-dismissible fade in\' role=\'alert\'><button class=\'close\' data-dismiss=\'alert\' type=\'button\'><span aria-hidden=\'true\'>&times;</span><span class=\'sr-only\'>close</span></button><h4>[[title]]</h4><p>[[msg]]</p></div>";
        if(success === true){
            type = "alert-success";
            title = "Succès !";
        } else {
            type = "alert-danger";
            title = "Echec !";
        }
        html = html.replace("[[type]]", type).replace("[[title]]", title).replace("[[msg]]", msg);
        messenger.append($(html));
    };

    counterTitle.text(postTitleIpt.val().length);
    counterExcerpt.text(postExcerptIpt.val().length);
    counterBody.text(postBodyIpt.val().length);

    postTitleIpt.on("keyup", function(e){
        e.preventDefault();

        counterTitle.text($(this).val().length);
    });

    $("textarea[data-editor]").each(function(){
        var textarea = $(this);
        var mode = textarea.data('editor') || 'html';
        var size = textarea.data('editorsize') || 'medium';
        var height = (size == "small") ? 100 : (size == "medium") ? 400 : (size == "large") ? 600 : 800;
        var options = {
            position: 'absolute',
            width: "100%",
            height: height,
            'class': textarea.attr('class')
        };
        var editorDiv = $("<div/>", options);
        editorDiv.insertBefore(textarea);
        textarea.css('display','none');
        var editor = ace.edit(editorDiv[0]);
        editor.getSession().setValue(textarea.val());
        editor.setTheme('ace/theme/merbivore');
        editor.getSession().setMode('ace/mode/'+mode);
        editor.getSession().setUseWrapMode(true);
        editor.getSession().setWrapLimitRange(120,120);
        editor.renderer.setPrintMarginColumn(120);
        editor.setOption('enableEmmet', true);
        if(editor.getSession().getValue().length>0){
            if($(this).attr("id")== "new_post_form_excerpt"){
                validObj.excerpt = true;
                enableEdition();
            }
            if($(this).attr("id")== "new_post_form_body"){
                validObj.body = true;
                enableEdition();
            }
        }
        editor.getSession().on('change', function(e){
            textarea.val(editor.getSession().getValue());
        });

        editor.on("change", function(){
            var el;
            if(textarea.attr("id") == "post_form_excerpt"){
                el = editor.getSession().getValue().length;
                counterExcerpt.text(el);
            }
            if(textarea.attr("id") == "post_form_body"){
                el = editor.getSession().getValue().length;
                counterBody.text(el);
            }
        });

    });

    postForm.on("submit", function(e){
        e.preventDefault();
        return false;
    });
    saveDraftBtn.on("click", function(e){
        e.preventDefault();
        if(saveDraftUrl == undefined || saveDraftUrl == ""){
            return false;
        }
        $.ajax({
            url: saveDraftUrl,
            type: "POST",
            data: postForm.serialize()
        })
            .done(function(response){
                if(response.error == false){

                } else {

                }
            })
            .fail(function(xhr){

            });
        return false;
    });
    savePublishBtn.on("click", function(e){
        e.preventDefault();
        if(savePublishUrl == undefined || savePublishUrl == ""){
            return false;
        }
        $.ajax({
            url: savePublishUrl,
            type: "POST",
            data: postForm.serialize()
        })
            .done(function(response){
                if(response.error == false){

                } else {

                }
            })
            .fail(function(xhr){

            });
        return false;
    });


});
