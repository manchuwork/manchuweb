$(function () {
    function getText($Node) {
        $Node.children("style").remove();
        description = $Node.html();
        console.log("$Node.description remove style:" + description);
        description = description.replace(/(\n)/g, "");
        description = description.replace(/(\t)/g, "");
        description = description.replace(/(\r)/g, "");
        description = description.replace(/<\/?[^>]*>/g, "");/*description = description.replace(/\s*/
        return description.trim();
    }

    $("div[contentEditable]").each(function () {
        $(this).blur(function () {
            var text = getText($(this));
            $(this).html(text);
        });
    });
    $("#btnCommit").click(function () {
        $("#word_hidden").val(getText($("#word")));
        $("#form").submit();
    });
});