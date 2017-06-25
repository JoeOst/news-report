function Unloader(){

    var o = this;

    this.unload = function(evt)
    {
        var message = "Вы уверены, что хотите закрыть страницу?";
        if (typeof evt == "undefined") {
            evt = window.event;
        }
        if (evt) {
            evt.returnValue = message;
        }
        return message;
    }

    this.resetUnload = function()
    {
        $(window).off('beforeunload', o.unload);

        setTimeout(function(){
            $(window).on('beforeunload', o.unload);
        }, 1000);
    }

    this.init = function()
    {
        $(window).on('beforeunload', o.unload);

        $('a').on('click', o.resetUnload);
        $(document).on('submit', 'form', o.resetUnload);
        $(document).on('keydown', function(event){
            if((event.ctrlKey && event.keyCode == 116) || event.keyCode == 116){
                o.resetUnload();
            }
        });
    }
    this.init();
}

$(function(){
    if(typeof window.obUnloader != 'object')
    {
        window.obUnloader = new Unloader();
    }
})