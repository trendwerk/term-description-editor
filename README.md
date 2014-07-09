Term description editor
=======================

Transforms the term description textarea to a WordPress WYSIWYG editor.

## Usage

Add support for the editor to any taxonomy. For example:
	
	$args = array(
		'hierarchical' => true,
		'label'        => 'Taxonomy',
		'supports'     => array( 'editor' ),
	);
	register_taxonomy( $taxonomy, $post_type, $args );
