var folders = new Folders();

$(function(){
    
    folders.init();
});

function Folders(params) {
    this.params = params || {};
}

Folders.prototype.init = function() {
    
    $(document).on('click', '.generate-document', function(evt){
        var $target = $(evt.target);
        var folderId = $target.data('folder');
        var templateId = $target.data('template');
        $.ajax({
          type: 'POST',
          url:  API_URL + "folders/generate-document",
          data: { folder_id: folderId, template_id: templateId },
          dataType: 'json',
          success: function(response){
              //console.log(response);
              General.revertPreloader($target);
          },
          error :  function(error, params, status){
              console.log(error, params, status)
          },
          finnaly :  function(response){
              console.log(response)
          },
        });
        
        
        // $.ajax({
        //   method: "POST",
        //   url: API_URL + "/folders/generate-document",
        //   data: { folder_id: "1", template_id: "1" }
        // })
        // .done(function( msg ) {
        //     alert( "Data Saved: " + msg );
        // });
        
        
        // setTimeout(function(){
        //     General.revertPreloader($target);
        // },3000);
        //console.log("!!Start generating documents!!!");
    });
    
}