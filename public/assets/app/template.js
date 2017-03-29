var EDITOR_ID = 'template-editor';

$(function(){
    $('button[data-submit]').on('click', onClickHandler);
    $('button[data-form-element]').on('click', insertTextAtFocusPoint);
    CKEDITOR.replace( EDITOR_ID, {
        customConfig: '../../app/ckeditor_config.js'
    } );
    
});



function insertTextAtFocusPoint(evt) {
    var btn = $(evt.target);
    CKEDITOR.instances[EDITOR_ID].insertText(General.formatFieldKey(btn.val()));
    evt.preventDefault();
    return false;
}

function onClickHandler(e) {
    var target = e.target;
    var form = $(target).attr('data-submit');
    var $form = $('#' + form );
    
    if(!$form) {
        console.error("Form["+ form +"] was not found!");
        return;
    }
    
    $form.trigger('submit');
}