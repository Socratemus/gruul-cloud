$(function(){
    
    $('button[data-submit]').on('click', onClickHandler);
    
    CKEDITOR.replace( 'template-editor' );
});

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