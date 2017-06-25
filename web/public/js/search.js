$(document).ready(function () {


    $("#search").autocomplete({

        source: 'http://blog/search/tag',
        select: function( event, ui ) {
            window.location = 'http://blog/site/tag?title=' + encodeURIComponent(ui.item.value);
        }
    });
});

