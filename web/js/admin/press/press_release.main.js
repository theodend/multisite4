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

        });



    });

    var onDone = function(response, uploader){
        swal({
            title: "Upload d'image",
            text: response.msg,
            type: "success"
        });
        imgDisplayer.empty();
        imageIpt.val(response.datas);
        var img = $("<img />");
        imgDisplayer.append(img.attr("src", response.datas));
    };

    var onError = function(msg){
        swal({
            title: "Upload d'image",
            text: msg,
            type: "error"
        });
    };

    var onFail = function(){
        swal({
            title: "Upload d'image",
            text: response.msg,
            type: "error"
        });
    };

    var onDropped = function(uploader){
        uploader.$element.find(".loader").show();
    };

    var always = function(uploader){
        uploader.$element.find(".loader").hide();
    };

    var dropzone = $("#dropzone");
    var imageIpt = $("#" + hiddenImageIptId);
    var imgDisplayer = $("#uploaded-image");

    dropzone.imgUpload({
        fileMaxSize: 3000000,
        uploadUrl: imgUploadUrl,
        onDone: onDone,
        onError: onError,
        onFail: onFail,
        onDropped: onDropped,
        always: always
    });
});
