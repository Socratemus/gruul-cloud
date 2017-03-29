var myPlugin = 'myplugin';

CKEDITOR.config.tabSpaces = 4;
CKEDITOR.config.extraPlugins = myPlugin;
CKEDITOR.config.toolbarGroups = [
        { name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
        { name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
        { name: 'links' },
        { name: 'insert' },
        { name: 'forms' },
        { name: 'tools' },
        { name: 'document',       groups: [ 'mode', 'document', 'doctools' ] },
        { name: 'others' },
        '/',
        { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
        { name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
        { name: 'alignment', groups : [ 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
        { name: 'styles' },
        { name: 'colors' },
        { name: 'about' },
        { name: myPlugin, groups : [ 'Newplugin' ]}
    ];
//CKEDITOR.config.width = '85%';
CKEDITOR.config.height = $('content').height() - 240;     // CSS unit (em).
CKEDITOR.config.line_height="1em;1.1em;1.2em;1.3em;1.4em;1.5em" ;
CKEDITOR.on('instanceReady', function (ev) {
    ev.editor.dataProcessor.writer.setRules('br',
     {
         indent: false,
         breakBeforeOpen: false,
         breakAfterOpen: false,
         breakBeforeClose: false,
         breakAfterClose: false
     });
});

CKEDITOR.plugins.add(myPlugin,
{
    init: function (editor) {
        var pluginName = myPlugin;
        editor.ui.addButton('Newplugin',
            {
                text: 'My New Plugin',
                command: 'OpenWindow',
                //icon: CKEDITOR.plugins.getPath('newplugin') + 'mybuttonicon.gif'
            });
        var cmd = editor.addCommand('OpenWindow', { exec: showMyDialog });
    }
});
function showMyDialog(e) {
    console.log(e);
    //CKEDITOR.instances.IDofEditor.insertText('some text here');
}