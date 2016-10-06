<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 *
 */
function optionsframework_option_name() {
	// This gets the theme name from the stylesheet (lowercase and without spaces)
	$themename = 'recall-parent';
	$optionsframework_settings = get_option('optionsframework');
	$optionsframework_settings['id'] = $themename;
	update_option('optionsframework', $optionsframework_settings);
	// echo $themename;
}
/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 */
function optionsframework_options() {

	$options = array();
	$options[] = array(
		'name' => __('Header Options', 'options_check'),
		'type' => 'heading');
	$options[] = array(
		'name' => __('Desktop Logo Upload', 'options_check'),
		'desc' => __('Upload the site logo here.', 'options_check'),
		'id' => 'logo_uploader',
		'type' => 'upload');
	$options[] = array(
		'name' => __('Mobile Logo Upload', 'options_check'),
		'desc' => __('Upload the site logo here.', 'options_check'),
		'id' => 'mobile_logo_uploader',
		'type' => 'upload');
		$options[] = array(
			'name' => __('Facebook Link', 'options_check'),
			'desc' => __('Paste your Facebook URL here.', 'options_check'),
			'id' => 'facebook_link',
			'std' => 'https://www.facebook.com/',
			'type' => 'text');
		$options[] = array(
			'name' => __('LinkedIn Link', 'options_check'),
			'desc' => __('Paste your LinkedIn URL here.', 'options_check'),
			'id' => 'linkedin_link',
			'std' => 'https://www.linkedin.com/',
			'type' => 'text');

	return $options;
}
