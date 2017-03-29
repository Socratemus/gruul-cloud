var myforms = new Forms();

$(function() { //when jquery is loaded
    var params = {
        key_field_id : '#field_name',
        slug_field_id : '#field_slug'
    };
    myforms.init(params); //initate the form object..
});

function Forms() {
    
    var that = this;
    
    this.form_container = '#DocumentFieldsForm';
    
    this.fieldname = null;
    
    this.fieldslug = null;
    
    this.params = {
        
    };
    
    this.init = init;

    function init(params) {
        that.params = params;
        
        if(!params.key_field_id || !params.slug_field_id ) {
            console.error('Forms setup not done corectly.');
            return;
        }
        
        this.fieldname = $(params.key_field_id);
        
        this.fieldslug = $(params.slug_field_id);
        
        this.index     = 0;
        
        //bind on key up event..
        this.fieldname.keyup(function(evt){that.onKeyUpTemplateField(evt); });
        
        $(this.form_container).on('click', '.form-btn.btn-danger', that.onDeleteField)
    }
}

Forms.prototype.onKeyUpTemplateField = function(evt) {
    var current = $(this.params.key_field_id), target = $(this.params.slug_field_id);
    
    var formatted = General.Utils.slugify(current.val());
    
    target.val(formatted);
}

Forms.prototype.onFieldAdd           = function (evt) {
    //Valide current fields...
    if(!this.fieldname.val()) {
        General.sendErrorMessage("Nu ai completat campul pentru [Denumire camp]");
        return;
    }
    
    var fieldName = this.fieldname.val();
    var fieldSlug = this.fieldslug.val();
    
    var clone = $('#form-tpl').clone();
    clone.find('label[data-placeholder="field_name"]').html(fieldName);
    clone.find('input[data-placeholder="field_slug"]').val(fieldSlug).prop('disabled', false);
    clone.find('input[data-placeholder="field_name"]').val(fieldName).prop('disabled', false);;
    
    clone.find('button').attr('data-index', this.index );
    clone.closest('.col-6.hide').attr('id','elem-' + this.index).attr('class','col-6 form-group');
    
    $(this.form_container).append(clone);

    this.fieldname.val('');
    this.fieldslug.val('');
}

Forms.prototype.onDeleteField        = function(evt) {
    var elem = $(evt.target).closest('.col-6');
    elem.remove();
    return false;
}