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
     },
     
     test : function(e) {
       console.log(e);
     },
     
     sendErrorMessage: function(Error) {
      
      
        console.error(Error);
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