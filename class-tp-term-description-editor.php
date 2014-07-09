<?php 
/**
 * Plugin Name: Term description editor
 * Description: Transforms the term description textarea to a WordPress WYSIWYG editor.
 */

class TP_Term_Description_Editor {
	var $taxonomy = 'tips-category';
	
	function __construct() {
		add_action('init',array($this,'init'));
		add_action('admin_enqueue_scripts',array($this,'enqueue_scripts'));
		
		//Allow HTML in Term descriptions
		remove_filter('pre_term_description','wp_filter_kses');
		remove_filter('term_description','wp_kses_data');
	}
	
	/**
	 * Initialize
	 */
	function init() {
		$taxonomies = get_taxonomies();
		
		if($taxonomies) :
			foreach($taxonomies as $taxonomy) :
				$taxonomy = get_taxonomy($taxonomy);
				
				if(isset($taxonomy->supports) && is_array($taxonomy->supports)) :
					if(in_array('editor',$taxonomy->supports)) :
						add_action($taxonomy->name.'_edit_form_fields',array($this,'add'),10,2);
						add_action('manage_edit-'.$taxonomy->name.'_columns',array($this,'hide_description_column'));
					endif;
				endif;
			endforeach;
		endif;
	}
	
	/**
	 * @add the editor
	 */
	function add($term, $taxonomy) {
		?>
		<tr class="form-field tp-term-description-editor">
			<th scope="row" valign="top"><label for="description"><?php _ex('Description', 'Taxonomy Description'); ?></label></th>
			<td><?php wp_editor(html_entity_decode($term->description,null,'UTF-8'),'tp-description',array('textarea_name' => 'description', 'quicktags' => false)); ?></td>
		</tr>
		<?php
	}
	
	/**
	 * @hide description as a column in the overview, because it's ugly with formatted text
	 */
	function hide_description_column($columns) {
		unset($columns['description']);
		return $columns;
	}
	
	/**
	 * @enqueue scripts (admin)
	 */
	function enqueue_scripts() {
		wp_enqueue_script('tp-term-description-editor',get_stylesheet_directory_uri().'/assets/plugins/term-description-editor/js/TermDescriptionEditor.js',array('jquery'));
	}
} new TP_Term_Description_Editor;
