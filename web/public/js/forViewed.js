
function show() {
    var currentView = Math.floor((Math.random() * 5) + 1);

    var id = window.location.search;

    $.ajax({
        url: "http://blog/viewed/index",
        type: "POST",
        data: {
            view:currentView,
            id:id
        },
        dataType: "json",
        success: function (data) {
            $("#currentView").html(data.par1);
            $("#allView").html(data.par2);
        },
        error: function(){
            // alert ("No PHP script: ");
        }

    });
}

$(document).ready(function() {


    show();
    //setInterval('show()',3000);
});