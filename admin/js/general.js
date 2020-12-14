function language_change(langkey, session_key) {
    $(document).ready(function () {
        $.ajax({
            type: "POST",
            url: base_url + "index.php/language/LanguageChanger",
            data: {
                language: langkey,
                sessionkey: session_key
            },
            dataType: 'html',
            success: function (data, textStatus) {
                if (data == 1) {
                    location.reload();
                }
            }
        });
    });
}

function ismaxlength(obj) {
    var mlength = obj.getAttribute ? parseInt(obj.getAttribute("maxlength")) : ""
    if (obj.getAttribute && obj.value.length > mlength)
        obj.value = obj.value.substring(0, mlength)
}