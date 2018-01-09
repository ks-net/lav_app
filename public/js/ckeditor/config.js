/**
 * @license Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */


CKEDITOR.editorConfig = function( config ) {

        config.entities = false;
        config.allowedContent = true;
        config.height = 360;
        //config.width = '99%';
        //config.width = 1000;

	config.toolbarGroups = [
		{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
		{ name: 'forms', groups: [ 'forms' ] },
		{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
		{ name: 'links', groups: [ 'links' ] },
		{ name: 'insert', groups: [ 'insert' ] },
		{ name: 'document', groups: [ 'document', 'doctools', 'mode' ] },
		{ name: 'tools', groups: [ 'tools' ] },
		{ name: 'about', groups: [ 'about' ] },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'styles', groups: [ 'styles' ] },
		{ name: 'colors', groups: [ 'colors' ] },
		{ name: 'paragraph', groups: [ 'align', 'list', 'indent', 'blocks', 'bidi', 'paragraph' ] },
		'/',
		{ name: 'others', groups: [ 'others' ] }
	];

	config.removeButtons = 'Templates,NewPage,Preview,Table,Smiley,Iframe,Flash,Styles,Font,ShowBlocks,CreateDiv,Form,Checkbox,Radio,TextField,Textarea,Button,Select,ImageButton,HiddenField,BidiLtr,BidiRtl,Language,SelectAll';
};