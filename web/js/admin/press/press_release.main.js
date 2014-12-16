$(function(){
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
        editor.getSession().setWrapLimitRange(90,90);
        editor.renderer.setPrintMarginColumn(90);
        editor.setOption('enableEmmet', true);

        editor.getSession().on('change', function(e){
            textarea.val(editor.getSession().getValue());
        });

        editor.on("change", function(){
            /*var el;
            if(textarea.attr("id") == "post_form_excerpt"){
                el = editor.getSession().getValue().length;
                counterExcerpt.text(el);
            }
            if(textarea.attr("id") == "post_form_body"){
                el = editor.getSession().getValue().length;
                counterBody.text(el);
            }*/
        });

    });
});
