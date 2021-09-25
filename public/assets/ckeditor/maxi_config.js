/**
 * @license Copyright (c) 2003-2019, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.addCss('.cke_editable { margin: 15px; }');

var ckeBasePath = CKEDITOR.basePath;

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	// baseHref = '';

	config.extraPlugins = 'wordcount, youtube, codemirror, btgrid';
	config.allowedContent = true;
	config.extraAllowedContent = 'div(*)';
	config.autoParagraph = false;
	config.ignoreEmptyParagraph = false;
	config.FillEmptyBlocks = false;
	CKEDITOR.dtd.$removeEmpty.i = 0;
    config.FormatOutput = false;
	config.width = '100%'; 
	config.height = 260;
	config.resize_enabled = false;
	config.wordcount = {
		showWordCount: true,
    	showCharCount : true
  	};
  	
  	config.filebrowserUploadMethod = 'form';
  	config.filebrowserBrowseUrl = ckeBasePath + 'kcfinder/browse.php?opener=ckeditor&amp;type=files';
  	config.filebrowserUploadUrl = ckeBasePath + 'kcfinder/upload.php?opener=ckeditor&amp;type=files';
  	config.filebrowserImageBrowseUrl = ckeBasePath + 'kcfinder/browse.php?opener=ckeditor&amp;type=images';
  	config.filebrowserImageUploadUrl = ckeBasePath + 'kcfinder/upload.php?opener=ckeditor&amp;type=images';

  	config.toolbarGroups = [
	    { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
	    { name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
	    { name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
	    { name: 'forms', groups: [ 'forms' ] },
	    { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
	    { name: 'links', groups: [ 'links' ] },
	    { name: 'insert', groups: [ 'insert' ] },
	    '/',
	    { name: 'styles', groups: [ 'styles' ] },
	    { name: 'colors', groups: [ 'colors' ] },
	    { name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
	    { name: 'tools', groups: [ 'tools' ] },
	    { name: 'others', groups: [ 'others' ] },
	    { name: 'about', groups: [ 'about' ] }
	];
	//config.enterMode = CKEDITOR.ENTER_BR;
	//config.pasteFromWordPromptCleanup = true;
	//config.pasteFromWordRemoveFontStyles = true;
	//config.forcePasteAsPlainText = true;
	//config.removeFormatAttributes = true;
	config.templates_files = [
    	ckeBasePath + 'plugins/artemps/bs_temps.js'
  	];
  	config.contentsCss = [
    	//ckeBasePath + 'bootstrap.min.css',
    	//ckeBasePath + 'ari_style.css'
  	];
	config.removeButtons = 'Save,NewPage,Print,SelectAll,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Subscript,Superscript,Language,Anchor,Flash,Iframe,About,Find,Replace,Scayt,Blockquote,Outdent,Indent,BidiLtr,BidiRtl,Smiley,SpecialChar,PageBreak,CopyFormatting,RemoveFormat,ShowBlocks';
};
