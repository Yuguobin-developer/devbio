<?php

/**
 * buddyboss-theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package BuddyBoss_Theme
 */
$init_file = get_template_directory() . '/inc/init.php';

if ( ! file_exists( $init_file ) ) {
	$err_msg = __( 'Could not load the starter file!', 'buddyboss-theme' );
	wp_die( esc_html( $err_msg ) );
}

require_once $init_file;

/**
 * Theme Global Function Caller Helper.
 *
 * @return \BuddyBossTheme\BaseTheme
 */
function buddyboss_theme() {
	return \BuddyBossTheme\BaseTheme::instance();
}

buddyboss_theme(); // Instantiate.


/************* Theme Activation **************/

require_once locate_template( '/inc/theme-activation.php' );

/**
 * Register the required plugins for this theme.
 */

add_action( 'bbta_register', 'buddyboss_theme_register_required_plugins' );

if ( ! function_exists( 'buddyboss_theme_register_required_plugins' ) ) {
	function buddyboss_theme_register_required_plugins() {

		/**
		 * Array of plugin arrays. Required keys are name and slug.
		 * If the source is NOT from the .org repo, then source is also required.
		 */
		$plugins = array();

		/**
		 * Array of configuration settings. Amend each line as needed.
		 * If you want the default strings to be available under your own theme domain,
		 * leave the strings uncommented.
		 * Some of the strings are added into a sprintf, so see the comments at the
		 * end of each line for what each argument will be.
		 */
		$config = array(
			'domain'       => 'buddyboss-theme',
			// Text domain - likely want to be the same as your theme.
			'default_path' => '',
			// Default absolute path to pre-packaged plugins
			'parent_slug'  => 'themes.php',
			// Default parent URL slug
			'menu'         => 'install-required-plugins',
			// Menu slug
			'has_notices'  => true,
			// Show admin notices or not
			'is_automatic' => false,
			// Automatically activate plugins after installation or not
			'message'      => '',
			// Message to output right before the plugins table
			'strings'      => array(
				'page_title'                      => __( 'Install Required Plugins', 'buddyboss-theme' ),
				'menu_title'                      => __( 'Install Plugins', 'buddyboss-theme' ),
				'installing'                      => __( 'Installing Plugin: %s', 'buddyboss-theme' ),
				// %1$s = plugin name
				'oops'                            => __( 'Something went wrong with the plugin API.', 'buddyboss-theme' ),
				'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'buddyboss-theme' ),
				// %1$s = plugin name(s)
				'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'buddyboss-theme' ),
				// %1$s = plugin name(s)
				'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'buddyboss-theme' ),
				// %1$s = plugin name(s)
				'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'buddyboss-theme' ),
				// %1$s = plugin name(s)
				'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'buddyboss-theme' ),
				// %1$s = plugin name(s)
				'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'buddyboss-theme' ),
				// %1$s = plugin name(s)
				'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'buddyboss-theme' ),
				// %1$s = plugin name(s)
				'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'buddyboss-theme' ),
				// %1$s = plugin name(s)
				'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'buddyboss-theme' ),
				'activate_link'                   => _n_noop( 'Activate installed plugin', 'Activate installed plugins', 'buddyboss-theme' ),
				'return'                          => __( 'Return to Required Plugins Installer', 'buddyboss-theme' ),
				'plugin_activated'                => __( 'Plugin activated successfully.', 'buddyboss-theme' ),
				'complete'                        => __( 'All plugins installed and activated successfully. %s', 'buddyboss-theme' ),
				// %1$s = dashboard link
				'nag_type'                        => __( 'updated', 'buddyboss-theme' ),
				// Determines admin notice type - can only be 'updated' or 'error'
			),
		);

		bbta( $plugins, $config );

	}
}

if ( ! function_exists( 'wp_body_open' ) ) {

	/**
	 * Shim for wp_body_open, ensuring backward compatibility with versions of WordPress older than 5.2.
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}

/**
 * Load deprecated functions.
 */
require_once trailingslashit( get_template_directory() ) . 'inc/core/deprecated/deprecated-filters.php';
require_once trailingslashit( get_template_directory() ) . 'inc/core/deprecated/deprecated-hooks.php';
require_once trailingslashit( get_template_directory() ) . 'inc/core/deprecated/deprecated-functions.php';


function upload_new_library_file(){

	parse_str($_POST['dataform'], $POST);	
	
	$report_title = '';
    $author_name  = '';
    $year         = '';
    $country      = '';
    $tags 	      = '';
    $file_url     = '';
	$Uploading    = '';
	$file = $_FILES['dataform'];

	$report_title_error = '';
	$author_name_error = '';
	$year_error = '';
	$country_error = '';
	$tags_error = '';
	$file_url_error = '';
	$Uploading_error = '';
	$file_error = '';


	if (empty($POST['report_title'])){
		$report_title_error = "Report Title is required";
	}else{
		$report_title = $POST['report_title'];
	}

	if (empty($POST['author_name'])){
		$author_name_error = "Author Name is required";
	}else{
		$author_name = $POST['author_name'];
	}

	if (empty($POST['year'])){
		$year_error = "Year is required";
	}else{
		$year = $POST['year'];
	}

	if (empty($POST['country'])){
		$country_error = "Country is required";
	}else{
		$country = $POST['country'];
	}

	if (empty($POST['tags'])){
		$tags_error = "Tags are required";
	}else{
		$tags = $POST['tags'];
	}

	if (empty($POST['Uploading'])){
		$Uploading_error = "Uploading is required";
	}else{
		$Uploading = $POST['Uploading'];
	}

	if ( $Uploading_error == '' && $Uploading == 'NO' && !$file ) {
		$file_error = 'You have to upload a file';
	}

	if ( $Uploading_error == '' && $Uploading == 'YES' && empty($POST['file_url']) ) {
		$file_url_error = "File url is required";
	}else{
		$file_url = $POST['file_url'];
	}

	if (
		$report_title_error === '' &&
		$author_name_error === '' &&
		$year_error === '' &&
		$country_error === '' &&
		$tags_error === '' &&
		$file_url_error === '' &&
		$Uploading_error === '' &&
		$file_error === ''
		) {		

		$date_args = array(
			'post_type'   	 => 'library',                
			'posts_per_page' => -1,                
			'post_status' 	 => 'publish'               
		);
	
		$query = new WP_Query( $date_args );                 
		$query = $query->posts;
	
		foreach ($query as $key => $value) {
			$old_files[$value->ID]['title'] = $value->post_title;
			$old_files[$value->ID]['year'] = get_field("year", $value->ID);                
			$old_files[$value->ID]['author_name'] = get_field("author_name", $value->ID);     
		}
			
		foreach ($old_files as $key => $old_file) {
			if ( preg_replace("/\s+/", "", $report_title) == preg_replace("/\s+/", "", $old_file['title']) && preg_replace("/\s+/", "", $year) == preg_replace("/\s+/", "", $old_file['year']) && preg_replace("/\s+/", "", $author_name) == preg_replace("/\s+/", "", $old_file['author_name']) ) {
				$duplicate_check = 1;                        
				break;
			}else{
				$duplicate_check = 0;                        
			}               
		}

		if ($duplicate_check == 0) {	
	
			$post_data = array(
				'post_title'    => $report_title,                
				'post_type'     => 'library',                
				'post_status'   => 'publish'                
			);
			
			$post_id = wp_insert_post( $post_data ); 
			
			$datas = array(
							'field_611bc5862b677' => $author_name ,
							'field_611bc59f2b678' => $year        ,
							'field_61546bc20501e' => $country     ,
							'field_61546d210501f' => serialize($tags)        ,
							'field_61546ee12fb71' => $report_title					
						); 

			foreach ($datas as $key => $data) {
		
				$field_key = $key;
				$value = $data;
				update_field( $field_key, $value, $post_id );
		
			}			
			if ($Uploading == 'NO') {		
				if ($file) {		
					$fileName = $file['name'];
					$fileTmpName = $file['tmp_name'];
					$fileSize = $file['size'];
					$fileError = $file['error'];
					$fileType = $file['type'];
			
					$fileExt = explode('.', $fileName);
					$fileActualExt = strtolower(end($fileExt));
			
					$allowed = array('pdf','doc','docx','png','jpg','jpeg');
		
					$sucess = 1;
			
					if ( in_array($fileActualExt, $allowed) ) {
						if ($fileError === 0) {
							if ($fileSize < 3000000) {
								$fileNameNew = uniqid('',true).".".$fileActualExt;
								$fileDestination = wp_upload_dir()['path'].'/'.$fileNameNew;                            
								move_uploaded_file($fileTmpName,$fileDestination);     
								
								$field_key = 'field_617714ee52eaa';
								$value = wp_upload_dir()['url'].'/'.$fileNameNew;
								update_field( $field_key, $value, $post_id );
								
								
	
								$response = array(
												'success'  => true,
												'message'  => 'file successfully uploaded'
											);								
							}else{								
								$response = array(
									'success'  => false,
									'message'  => "The file is too big (maximum of 3Mb)"
								);
							}
						}else{							
							$response = array(
								'success'  => false,
								'message'  => "There was an error uploading your file"
							);
						}
					}else{
						$response = array(
							'success'  => false,
							'message'  => "You cannot upload files of this type<br>Accepted format: 'pdf','doc','docx','png','jpg','jpeg' "
						);
						
					}  
				}// if file
				
			}// If Uploading NO
			else{
				$field_key = 'field_617714ee52eaa';
				$value = $file_url;
				update_field( $field_key, $value, $post_id );
	
				$response = array(
					'success'  => true,
					'message'  => 'file successfully added'
				);	
			}			
		}// If duplicate == 0
	
		else{	
			$response = array(
				'success'  => false,
				'message'  => "This file already exists"
			);
		}
	}

	else{
		$response = array(	
							'success' => false,
							'inputs_errors' => true,
							'ids' => [
										'report_title_error' => $report_title_error,
										'author_name_error' => $author_name_error,
										'year_error' => $year_error,
										'country_error' => $country_error,
										'tags_error' => $tags_error,
										'file_url_error' => $file_url_error,
										'Uploading_error' => $Uploading_error,
										'file_error' => $file_error
									]
						);
	}
	echo json_encode($response);
}

add_action('wp_ajax_upload_new_library_file', 'upload_new_library_file' );
add_action('wp_ajax_nopriv_upload_new_library_file', 'upload_new_library_file' );

add_action( 'init', function(){

	add_role( 'employee', 'Employee' );

	$empl = get_role('employee');
	$empl->add_cap('read');
	$empl->add_cap('write');
	$empl->add_cap('edit_posts');
	$empl->add_cap('upload_files');

} );
