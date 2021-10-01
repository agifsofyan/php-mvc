/**
 * @license Copyright (c) 2003-2021, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here.
	// For complete reference see:
	// https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_config.html
	config.language = 'id';
    // config.uiColor = '#cfd8dc';
    config.toolbarCanCollapse = true;

	// The toolbar groups arrangement, optimized for two toolbar rows.
	config.toolbarGroups = [
		{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
		{ name: 'links', groups: [ 'links' ] },
		{ name: 'insert', groups: [ 'insert' ] },
		{ name: 'forms', groups: [ 'forms' ] },
		{ name: 'tools', groups: [ 'tools' ] },
		{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'others', groups: [ 'others' ] },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
		{ name: 'styles', groups: [ 'styles' ] },
		{ name: 'colors', groups: [ 'colors' ] },
		{ name: 'about' }
	];

	// Remove some buttons provided by the standard plugins, which are
	// not needed in the Standard(s) toolbar.
	config.removeButtons = 'Subscript,Superscript';

	// Set the most common block elements.
	config.format_tags = 'p;h1;h2;h3;pre';

	// Simplify the dialog windows.
	config.removeDialogTabs = 'image:advanced;link:advanced';
	config.extraPlugins = [
		'justify', 
		'pastefromlibreoffice', 
		'font', 
		'pastetools', 
		'easyimage',
		// 'embed',
		// 'imageresponsive'
		'imageresizerowandcolumn',
		// 'uploadfile',
	];

	config.font_names = 'Arial/Arial, Helvetica, sans-serif;' +
		'Comic Sans MS/Comic Sans MS, cursive;' +
		'Courier New/Courier New, Courier, monospace;' +
		'Georgia/Georgia, serif;' +
		'Lucida Sans Unicode/Lucida Sans Unicode, Lucida Grande, sans-serif;' +
		'Tahoma/Tahoma, Geneva, sans-serif;' +
		'Times New Roman/Times New Roman, Times, serif;' +
		'Trebuchet MS/Trebuchet MS, Helvetica, sans-serif;' +
		'Verdana/Verdana, Geneva, sans-serif;' +
		'Aclonica/Aclonica, sans-serif;' +
		'Quicksand/Quicksand, sans-serif;';

	// config.extraPlugins = 'lineheight, language';
	config.fontSize_sizes = "8px/8px;8pt/8pt;9px/9px;9pt/9pt;10px/10px;10pt/10pt;11px/11px;	11pt/11pt;12px/12px;12pt/12pt;14px/14px;14pt/14pt;16px/16px;16pt/16pt;18px/18px;18pt/18pt;20px/20px;20pt/20pt;22px/22px/22pt/22pt;24px/24px;24pt/24pt;26px/26px;26pt/26pt;28px/28px;28pt/28pt;36px/36px;36pt/36pt;48px/48px;48pt/48pt;72px/72px;72pt/72pt;";

	config.line_height="1;1.5;2;2.5;3;3.5;4";

	// config.fontSize_defaultLabel = '18px';
	config.font_defaultLabel = 'Quicksand';

	// Config for color button
	config.colorButton_colors = 'FFFFFF,F5F5F5,FAFAFA,DBDBDB,B5B5B5,7A7A7A,4A4A4A,363636,242424,121212,0A0A0A,00D1B2,23D160,209CEE,3273DC,FFDD57,FF3860,c84c6b,b1002c,80112d,851726,9c1b2c,df2740,d51375,ed1683,f25ba8,f0449b,f68ac1,ff00c1,add2c9,00a5c8,85bfc6,00c8af,9bffff,35a2af,23788a,9abd19,9bcdff,eaf9f9,00b8ff,ff0000,ffff00,df2740,cc6845,bc7754,a87057,432c22';

	// Remove span
	config.allowedContent = true;
	config.extraAllowedContent = 'p(*)[*]{*};div(*)[*]{*};li(*)[*]{*};ul(*)[*]{*};span(*)';
	// CKEDITOR.dtd.$removeEmpty.i = 0;
	// CKEDITOR.dtd.$removeEmpty.span = 0;
	// CKEDITOR.dtd.$inline['a'];

	//config['entermode'] = CKEDITOR.ENTER_P; // default for new paragraph = 1
	//config['entermode'] = CKEDITOR.ENTER_BR;//or config.entermode=2
	//config['entermode'] = CKEDITOR.ENTER_DIV;//or config.entermode=3

	config.autoParagraph = false;
	config.ignoreEmptyParagraph = false;
	config.tabSpaces = 0;

	// for bold
	config.coreStyles_bold = { element: 'b', overrides: 'strong' };
	config.coreStyles_bold = {
		element: 'span',
		styles: { 'font-weight': 'bold' }
	};
};
