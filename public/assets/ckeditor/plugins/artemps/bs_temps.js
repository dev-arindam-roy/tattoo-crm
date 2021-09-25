/**
 * @license Copyright (c) 2003-2019, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or https://ckeditor.com/legal/ckeditor-oss-license
 */

// Register a templates definition set named "default".
CKEDITOR.addTemplates( 'default', {
	// The name of sub folder which hold the shortcut preview images of the
	// templates.
	imagesPath: CKEDITOR.getUrl( CKEDITOR.plugins.getPath( 'artemps' ) + '/images/' ),

	// The templates definitions.
	templates: [ 
		{
			title: 'Full Width 1 Row',
			image: 'template-7.gif',
			description: 'Full width container with 1 Row',
			html: 	'<div class="btgrid">' + 
						'<div class="row row-1">' +
							'<div class="col-md-12">' +
								'<div class="content"><p>Your Content</p></div>' +
							'</div>' +
						'</div>' + 
					'</div>'
		},
		{
			title: 'Full Width 3 Row',
			image: 'template-1.gif',
			description: 'Full width container with 3 Row',
			html: 	'<div class="btgrid"><div class="row row-1">' +
						'<div class="col-md-12">' +
							'<div class="content"><p>Your Content</p></div>' +
						'</div>' +
					'</div>' +
					'<div class="row row-2">' +
						'<div class="col-md-12">' +
							'<div class="content"><p>Your Content</p></div>' +
						'</div>' +
					'</div>' +
					'<div class="row row-3">' +
						'<div class="col-md-12">' +
							'<div class="content"><p>Your Content</p></div>' +
						'</div>' +
					'</div></div>'
		},	
		{
			title: 'Container with Right Panel',
			image: 'template-2.gif',
			description: 'Container with right sidebar',
			html: 	'<div class="btgrid"><div class="row row-1">' +
						'<div class="col-md-12">' +
							'<div class="content"><p>Header</p></div>' +
						'</div>' +
					'</div>' +
					'<div class="row row-2">' +
						'<div class="col-md-8">' +
							'<div class="content"><p>Your Content</p></div>' +
						'</div>' +
						'<div class="col-md-4">' +
							'<div class="content"><p>Right Sidebar</p></div>' +
						'</div>' +
					'</div>' +
					'<div class="row row-3">' +
						'<div class="col-md-12">' +
							'<div class="content"><p>Footer</p></div>' +
						'</div>' +
					'</div></div>'
		},
		{
			title: 'Container with Left Panel',
			image: 'template-4.gif',
			description: 'Container with left sidebar',
			html: 	'<div class="btgrid"><div class="row row-1">' +
						'<div class="col-md-12">' +
							'<div class="content"><p>Header</p></div>' +
						'</div>' +
					'</div>' +
					'<div class="row row-2">' +
						'<div class="col-md-4">' +
							'<div class="content"><p>Left Sidebar</p></div>' +
						'</div>' +
						'<div class="col-md-8">' +
							'<div class="content"><p>Your Content</p></div>' +
						'</div>' +
					'</div>' +
					'<div class="row row-3">' +
						'<div class="col-md-12">' +
							'<div class="content"><p>Footer</p></div>' +
						'</div>' +
					'</div></div>'
		},
		{
			title: 'Container with 2 Box',
			image: 'template-5.gif',
			description: 'Container with 2 equal box',
			html: 	'<div class="btgrid"><div class="row row-1">' +
						'<div class="col-md-12">' +
							'<div class="content"><p>Header</p></div>' +
						'</div>' +
					'</div>' +
					'<div class="row row-2">' +
						'<div class="col-md-6">' +
							'<div class="content"><p>Your Content</p></div>' +
						'</div>' +
						'<div class="col-md-6">' +
							'<div class="content"><p>Your Content</p></div>' +
						'</div>' +
					'</div>' +
					'<div class="row row-3">' +
						'<div class="col-md-12">' +
							'<div class="content"><p>Footer</p></div>' +
						'</div>' +
					'</div></div>'
		},
		{
			title: 'Container with 3 Box',
			image: 'template-3.gif',
			description: 'Container with 3 equal box',
			html: 	'<div class="btgrid"><div class="row row-1">' +
						'<div class="col-md-12">' +
							'<div class="content"><p>Header</p></div>' +
						'</div>' +
					'</div>' +
					'<div class="row row-2">' +
						'<div class="col-md-4">' +
							'<div class="content"><p>Your Content</p></div>' +
						'</div>' +
						'<div class="col-md-4">' +
							'<div class="content"><p>Your Content</p></div>' +
						'</div>' +
						'<div class="col-md-4">' +
							'<div class="content"><p>Your Content</p></div>' +
						'</div>' +
					'</div>' +
					'<div class="row row-3">' +
						'<div class="col-md-12">' +
							'<div class="content"><p>Footer</p></div>' +
						'</div>' +
					'</div></div>'
		},
		{
			title: 'Container with 4 Box',
			image: 'template-6.gif',
			description: 'Container with 4 equal box',
			html: 	'<div class="btgrid"><div class="row row-1">' +
						'<div class="col-md-12">' +
							'<div class="content"><p>Header</p></div>' +
						'</div>' +
					'</div>' +
					'<div class="row row-2">' +
						'<div class="col-md-3">' +
							'<div class="content"><p>Your Content</p></div>' +
						'</div>' +
						'<div class="col-md-3">' +
							'<div class="content"><p>Your Content</p></div>' +
						'</div>' +
						'<div class="col-md-3">' +
							'<div class="content"><p>Your Content</p></div>' +
						'</div>' +
						'<div class="col-md-3">' +
							'<div class="content"><p>Your Content</p></div>' +
						'</div>' +
					'</div>' +
					'<div class="row row-3">' +
						'<div class="col-md-12">' +
							'<div class="content"><p>Footer</p></div>' +
						'</div>' +
					'</div></div>'
		},	
	]
} );
