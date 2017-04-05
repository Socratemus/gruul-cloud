 var General = {
     
     initialize : function() {
         $(document).on('click', 'button[data-submit]', function(evt){ 
             var target = $(evt.target);
             var form = target.attr('data-submit');
             if(!$('#'+form).length){
                General.sendErrorMessage("PAGE_SUBMIT_NOT_SET");
             }
             $('#'+form).submit();
         });
          $(document).on('click', 'button[data-toggle]', function(evt) {
             var target = $(evt.target).closest('button[data-toggle]'); 
             var to_toggle = target.attr('data-toggle');
             if(!$('#' + to_toggle).length){
                General.sendErrorMessage("TOGGLE_CONTAINER_NOT_FOUND");
             }
             $('#' + to_toggle).toggleClass('open');
          });
          
          $(document).on('click', 'button[preloader]', function(evt){
              var $target = $(evt.target);
              $target.prop('disabled', true);
              var $preloader = $($target.attr('preloader'));
              $preloader.show();
          });
     },
     
     revertPreloader : function(button){
          var $target = button;
          $target.prop('disabled', false);
          var $preloader = $($target.attr('preloader'));
          $preloader.hide();
     },
     
     test : function(e) {
       console.log(e);
     },
     
     sendErrorMessage: function(Error) {
      
      
        console.error(Error);
     },
     
     formatFieldKey : function(fieldKey) {
        return '[[' + fieldKey + ']]';
     },
     
     Utils : {
         slugify : function(value) {
             return value
                .toUpperCase()
                .replace(/ /g,'_')
                .replace(/[^\w-]+/g,'')
                ;
         }
     }
 };
 
 $(function(){
    General.initialize();
 });