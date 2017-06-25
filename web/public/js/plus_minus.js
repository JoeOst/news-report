
$(document).ready(function() {
    $(".plus").click(function() {
        var link = $(this);
        var id = link.data('id');

        $.ajax({
            url: "http://blog/comment/plus",
            type: "POST",
            data: {
                id:id
            },
            success: function (data) {
                $("#count" + id).html(data);
            },
            error: function(){
                alert ("No PHP script: ");
            }

        });



    });

    $(".minus").click(function() {
        var link = $(this);
        var id = link.data('id');
        $.ajax({
            url: "http://blog/comment/minus",
            type: "POST",
            data: {
                id:id
            },
            success: function (data) {
                $("#count" + id).html(data);
            },
            error: function(){
                //alert ("No PHP script: ");
            }

        });



    });
});