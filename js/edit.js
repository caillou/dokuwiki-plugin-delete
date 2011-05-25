addInitEvent(function (){
    var button = $('edbtn__delete');
    if (!button) {
        return;
    }
    addEvent(button, 'click', function(e){
        if (!confirm(LANG['del_confirm'])) {
            e.preventDefault();
        }
        textChanged = false;
    });
});
