/*
Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';

	config.toolbar = 'PHPNukeAdmin';
	config.toolbar_PHPNukeAdmin = config.toolbar_Full;

	config.toolbar = 'NukeUser';
	config.toolbar_NukeUser =
	[
		{ name: 'document', items : [ 'Source','-','Maximize', 'ShowBlocks','NewPage','Preview','Print','About' ] },
		{ name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
		{ name: 'editing', items : [ 'Find','Replace','-','SelectAll' ] },
		'/',
		{ name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] },
		{ name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl' ] },
		{ name: 'links', items : [ 'Link','Unlink','Anchor' ] },
		{ name: 'insert', items : [ 'Image','HorizontalRule','Smiley','SpecialChar','PageBreak' ] },
	];

	config.toolbar = 'PHPNuke';
	config.toolbar_PHPNuke =
	[
		['Source','Maximize','-','Bold', 'Italic','-','RemoveFormat','-','Undo','Redo','-','Paste','PasteText','PasteFromWord','-','SpecialChar']
	];
};

