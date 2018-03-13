(function() {
	tinymce.PluginManager.add('ultimatepopup_free_mce_button', function( editor, url ) {
		editor.addButton( 'ultimatepopup_free_mce_button', {
			text: 'Insert Popup',
			icon: false,
			type: 'menubutton',
			menu: [
				{
					text: 'Add a popup',
                    onclick: function() {
                        editor.windowManager.open( {
                            title: 'Insert Popup',
                            body: [
                                {
                                    type: 'textbox',
                                    name: 'textboxID',
                                    label: 'Type popup ID',
                                }
                            ],
                            onsubmit: function( e ) {
                                editor.insertContent( '[ultimate_popup id="' + e.data.textboxID + '"]');
                            }
                        });
                    }
				}
			]
		});
	});
})();