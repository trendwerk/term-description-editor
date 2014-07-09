jQuery(document).ready(function($) {
	if($('.tp-term-description-editor').length && $('body.edit-tags-php textarea#description').length) {
		$('textarea#description').closest('tr').remove();
	}
});