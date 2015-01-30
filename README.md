Term description editor
=======================

Transforms the term description textarea to a WordPress WYSIWYG editor.

## Installation
If you're using Composer to manage WordPress, add this plugin to your project's dependencies. Run:
```sh
composer require trendwerk/term-description-editor 1.0.0
```

Or manually add it to your `composer.json`:
```json
"require": {
	"trendwerk/term-description-editor": "1.0.0"
},
```

## Usage

Add support for the editor to any taxonomy. For example:
	
```php
$args = array(
	'hierarchical' => true,
	'label'        => 'Taxonomy',
	'supports'     => array( 'editor' ),
);
register_taxonomy( $taxonomy, $post_type, $args );
```
