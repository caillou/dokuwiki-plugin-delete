addInitEvent(function (){
    addEvent($('edbtn__delete'), 'click', function(e){
        if (!confirm(LANG['del_confirm'])) {
            e.preventDefault();
        }
        textChanged = false; 
    });
});