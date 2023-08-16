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


function add_user_community_action(){

	parse_str($_POST['dataform'], $POST);

	$email = $POST['email'];
	$password = $POST['password'];
	$companyName = $POST['companyName'];
	$FName = $POST['FName'];
	$LName = $POST['LName'];
	$accountType = $POST['accountType'];
	$endDate = $POST['endDate'];
	$tags = $POST['tags'];

	$user_data = get_user_by( 'email', $email );


	$userlevel = array (
		320 => 90,/*Business standard*/
		321 => 100,/*Business premium*/
		318 => 80/*Business basic*/  
	  );
	
	  
	
	if ( empty( $user_data ) ) {	
	
		$membershipsID['Standard Project Support'] = 513;
		$membershipsID['Associations'] = 1623;
		$membershipsID['Business basic'] = 318;
		$membershipsID['Business premium'] = 321;
		$membershipsID['Business standard'] = 320;
		$membershipsID['Individual plan basic'] = 322;
		$membershipsID['Individual plan free'] = 327;
		$membershipsID['Plant owners – Free'] = 512;
		$membershipsID['Plant owners – Project support'] = 513;
			
		$prices['Standard Project Support'] = 1500;
		$prices['Associations'] = 0;
		$prices['Business basic'] = 899;
		$prices['Business premium'] = 5999;
		$prices['Business standard'] = 3499;
		$prices['Individual plan basic'] = 999;
		$prices['Individual plan free'] = 0;
		$prices['Plant owners – Free'] = 0;
		$prices['Plant owners – Project support'] = 1500;
			
		$periods['Standard Project Support'] = 1;
		$periods['Associations'] = 10;
		$periods['Business basic'] = 1;
		$periods['Business premium'] = 1;
		$periods['Business standard'] = 1;
		$periods['Individual plan basic'] = 1;
		$periods['Individual plan free'] = 10;
		$periods['Plant owners – Free'] = 10;
		$periods['Plant owners – Project support'] = 1;

		$periodType['Standard Project Support'] = 'years';
		$periodType['Associations'] = 'years';
		$periodType['Business basic'] = 'years';
		$periodType['Business premium'] = 'years';
		$periodType['Business standard'] = 'years';
		$periodType['Individual plan basic'] = 'years';
		$periodType['Individual plan free'] = 'years';
		$periodType['Plant owners – Free'] = 'years';
		$periodType['Plant owners – Project support'] = 'years';


		$user_ID = wp_insert_user( array(
			'user_login' => $companyName,
			'user_pass' => $password,
			'user_email' => $email,
			'first_name' => $FName,
			'last_name' => $LName,
			'display_name' => $FName[$i].' '.$LName[$i],
			'role' => 'subscriber'
		));


		$sub = new MeprSubscription();
		$sub->user_id = $user_ID;
		$sub->product_id = $membershipsID[ $accountType ];
		$sub->price = $prices[ $accountType ];
		$sub->total = $prices[ $accountType ];
		$sub->period = $periods[ $accountType ] ;
		$sub->period_type = 'years';
		$sub->status = MeprSubscription::$active_str;
		$sub_id = $sub->store();

		$txn = new MeprTransaction();
		$txn->amount = $prices[ $accountType ];
		$txn->total =  $prices[ $accountType ];
		$txn->user_id = $user_ID;
		$txn->product_id = $membershipsID[ $accountType ];
		$txn->status = MeprTransaction::$complete_str;
		$txn->txn_type = MeprTransaction::$payment_str;
		$txn->gateway = 'manual';
		$txn->expires_at = $endDate.' 23:59:59'; /*gmdate('Y-m-d 23:59:59', (time() + MeprUtils::years(1)));     */
				
		$txn->subscription_id = $sub_id;
		$txn_id = $txn->store();

		global $wpdb;
		$wpdb->insert( 'wp_bp_xprofile_data', 
						array( 
							'id' => NULL, 
							'field_id' => 21, 
							'user_id' => $user_ID , 
							'value' => serialize( $tags ), 
							'last_updated' => date("Y-m-d h:i:s")  
						), 
						array( '%s','%d', '%d','%s','%s' ) );

		
		update_field("userslevel", $userlevel[$membershipsID[ $accountType ]], "user_".$user_ID);

		$wpdb->update( 'wp_usermeta', array( 'meta_value' => 'a:2:{s:10:"subscriber";b:1;s:19:"memberpress_account";b:1;}' ), array( 'user_id' => intval($user_ID),'meta_key'=>'wp_capabilities' ), array( '%s' ), array( '%d','%s' ) );

		$data = array(
			'success'  => true,
			'userID'   => strval($user_ID),
			'sub_id'   => strval($sub_id),
			'txn_id'   => strval($txn_id)
		);

	
	
	}else{
		$data = array(
			'success'  => false,
			'error_email' => 'This email already exists'
		);
	}

	echo json_encode($data);

	die();
}

add_action('wp_ajax_add_user_community_action', 'add_user_community_action' );
add_action('wp_ajax_nopriv_add_user_community_action', 'add_user_community_action' );








function send_wlcm_email(){

	

 	
	$notify = '';
	$user_id = $_POST['user_id'];

	// Accepts only 'user', 'admin' , 'both' or default '' as $notify.
	if ( ! in_array( $notify, array( 'user', 'admin', 'both', '' ), true ) ) {
		return;
	}

	$user = get_userdata( $user_id );

	$member = new MeprUser(); 
	$member->ID = $user_id; 
	$Subscription = $member->get_active_subscription_titles(); 

	// The blogname option is escaped with esc_html() on the way into the database in sanitize_option().
	// We want to reverse this for the plain text arena of emails.
	$blogname = wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES );

	$key = get_password_reset_key( $user );
	if ( is_wp_error( $key ) ) {
		return;
	}

	$switched_locale = switch_to_locale( get_user_locale( $user ) );


	$message  = sprintf( __( 'Username: %s' ), $user->user_login ) . "<br><br>";
	$message .= __( 'To set your password, please ­<a href=\'' );
	$message .= network_site_url( "wp-login.php?action=rp&key=$key&login=" . rawurlencode( $user->user_login ), 'login' ) . "'>Click here</a><br><br>";
	$message .= __('Please note that this link will expire in <b>24 hours<b>. For assistance or any question, please contact us at <a href="mailto:info@biogasworld.com">info@biogasworld.com</a><br><br>');
	
	//$message .= wp_login_url() . "\r\n";

	$wp_new_user_notification_email = array(
		'to'      => $user->user_email,
		'subject' => __( 'Welcome to %s' ),
		'message' => str_replace(["[Message]","[User Name]","[Subscription]"],  [$message,$user->display_name,$Subscription], Wlcm_Email_Template()),
		'headers' => ['Bcc: <ghiles9@gmail.com>','Bcc: <natalia.biogasworld@gmail.com>'],
	);

	$wp_new_user_notification_email = apply_filters( 'wp_new_user_notification_email', $wp_new_user_notification_email, $user, $blogname );

	add_filter('wp_mail_content_type',create_function('', 'return "text/html"; '));

	if (wp_mail(
		$wp_new_user_notification_email['to'],
		wp_specialchars_decode( sprintf( $wp_new_user_notification_email['subject'], $blogname ) ),
		$wp_new_user_notification_email['message'],
		$wp_new_user_notification_email['headers']
	)) {

		update_field('welcome_email_sent','yes','user_'.$user_id);
		update_field('welcome_email_sent_date',date("Y-m-d H:i:s"),'user_'.$user_id);
		
		$data = array(
			'success'  => true
		);
		
	}else{
		$data = array(
			'success'  => false,
			'error_email' => 'Email was not sent'
		);
	}

	echo json_encode($data);

	if ( $switched_locale ) {
		restore_previous_locale();
	}

	die();
}


add_action('wp_ajax_send_wlcm_email', 'send_wlcm_email' );
add_action('wp_ajax_nopriv_send_wlcm_email', 'send_wlcm_email' );



function Wlcm_Email_Template(){
	return '<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
	<head>
	<!--[if gte mso 9]>
	<xml>
	  <o:OfficeDocumentSettings>
		<o:AllowPNG/>
		<o:PixelsPerInch>96</o:PixelsPerInch>
	  </o:OfficeDocumentSettings>
	</xml>
	<![endif]-->
	  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	  <meta name="x-apple-disable-message-reformatting">
	  <!--[if !mso]><!--><meta http-equiv="X-UA-Compatible" content="IE=edge"><!--<![endif]-->
	  <title></title>
	  
	<style type="text/css">
		  @media only screen and (min-width: 570px) {
	  .u-row {
		width: 550px !important;
	  }
	  .u-row .u-col {
		vertical-align: top;
	  }
	
	  .u-row .u-col-100 {
		width: 550px !important;
	  }
	
		}
		
		@media (max-width: 570px) {
		.u-row-container {
			max-width: 100% !important;
			padding-left: 0px !important;
			padding-right: 0px !important;
		}
		.u-row .u-col {
			min-width: 320px !important;
			max-width: 100% !important;
			display: block !important;
		}
		.u-row {
			width: calc(100% - 40px) !important;
		}
		.u-col {
			width: 100% !important;
		}
		.u-col > div {
			margin: 0 auto;
		}
		}
		body {
		margin: 0;
		padding: 0;
		}
		
		table,
		tr,
		td {
		vertical-align: top;
		border-collapse: collapse;
		}
		
		p {
		margin: 0;
		}
		
		.ie-container table,
		.mso-container table {
		table-layout: fixed;
		}
		
		* {
		line-height: inherit;
		}
		
		a[x-apple-data-detectors=\'true\'] {
		color: inherit !important;
		text-decoration: none !important;
		}
		
		table, td { color: #000000; } @media (max-width: 480px) { #u_column_2 .v-col-padding { padding: 30px 22px 33px !important; } }
	</style>
	  
	  
	
	</head>
	
	<body class="clean-body u_body" style="margin: 0;padding: 0;-webkit-text-size-adjust: 100%;background-color: #006633;color: #000000">
	  <!--[if IE]><div class="ie-container"><![endif]-->
	  <!--[if mso]><div class="mso-container"><![endif]-->
	  <table style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;min-width: 320px;Margin: 0 auto;background-color: #006633;width:100%" cellpadding="0" cellspacing="0">
	  <tbody>
	  <tr style="vertical-align: top">
		<td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
		<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td align="center" style="background-color: #006633;"><![endif]-->
		
	
	<div class="u-row-container" style="padding: 0px;background-color: transparent">
	  <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 550px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
		<div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
		  <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:550px;"><tr style="background-color: transparent;"><![endif]-->
		  
	<!--[if (mso)|(IE)]><td align="center" width="550" class="v-col-padding" style="width: 550px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
	<div class="u-col u-col-100" style="max-width: 320px;min-width: 550px;display: table-cell;vertical-align: top;">
	  <div style="width: 100% !important;">
	  <!--[if (!mso)&(!IE)]><!--><div class="v-col-padding" style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;"><!--<![endif]-->
	  
	<table style="" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
	  <tbody>
		<tr>
		  <td style="overflow-wrap:break-word;word-break:break-word;padding:0px;" align="left">
	<!--	
	<table width="100%" cellpadding="0" cellspacing="0" border="0">
		
		<tr>
			<td style="padding-right: 0px;padding-left: 0px;" align="center">                        
				<img align="center" border="0" src="https://www.biogascommunity.com/wp-content/uploads/2022/03/BGC-Logo.png" alt="Hero Image" title="Hero Image" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 100%;max-width: 550px;" width="550"/>                        
			</td>
	  </tr>
	</table>
	-->
		  </td>
		</tr>
	  </tbody>
	</table>
	
	  <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
	  </div>
	</div>
	<!--[if (mso)|(IE)]></td><![endif]-->
		  <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
		</div>
	  </div>
	</div>
	
	
	
	<div class="u-row-container" style="padding: 0px;background-color: transparent">
	  <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 550px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ffffff;">
		<div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
		  <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:550px;"><tr style="background-color: #ffffff;"><![endif]-->
		  
	<!--[if (mso)|(IE)]><td align="center" width="550" class="v-col-padding" style="width: 550px;padding: 30px 50px 33px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 10px solid #063;border-top: 10px solid #063;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;" valign="top"><![endif]-->
	<div id="u_column_2" class="u-col u-col-100" style="max-width: 320px;min-width: 550px;display: table-cell;vertical-align: top;">
	  <div style="width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
	  <!--[if (!mso)&(!IE)]><!--><div class="v-col-padding" style="padding: 30px 50px 33px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 10px solid #063;border-top: 10px solid #063;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;"><!--<![endif]-->
	  
	<table style="" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
	  <tbody>
		<tr>
		  <td style="overflow-wrap:break-word;word-break:break-word;padding:10px;" align="left">
			
			<h2 style="margin: 0px; line-height: 140%; text-align: left; word-wrap: break-word; font-weight: normal;  font-size: 22px;">
				Hello <span style="font-weight:bold;color:#006633">[User Name]</span> and welcome to our Community !
			</h2>
	
		  </td>
		</tr>
	  </tbody>
	</table>
	
	<table style="" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
	  <tbody>
		<tr>
		  <td style="overflow-wrap:break-word;word-break:break-word;padding:10px;" align="left">

			<div style="line-height: 170%; text-align: justify; word-wrap: break-word;">
				<p style="font-size: 14px; line-height: 170%;"><span style=" font-size: 16px; line-height: 27.2px;">Your <span style="font-weight:bold;color:#006633">[Subscription] account</span> has been created and we are inviting you to complete your registration.<br><br> </p>
			</div>
	
			
			<div style="line-height: 170%; text-align: justify; word-wrap: break-word;">
				<p style="font-size: 14px; line-height: 170%;"><span style=" font-size: 16px; line-height: 27.2px;">[Message]</p>
			</div>
	
		  </td>
		</tr>
	  </tbody>
	</table>
	
	  <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
	  </div>
	</div>
	<!--[if (mso)|(IE)]></td><![endif]-->
		  <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
		</div>
	  </div>
	</div>
	
	
		<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
		</td>
	  </tr>
	  </tbody>
	  </table>
	  <!--[if mso]></div><![endif]-->
	  <!--[if IE]></div><![endif]-->
	</body>
	
	</html>
	';
}


// Function to change email address
function wpb_sender_email( $original_email_address ) {
    return 'natalia@biogasworld.com';
}
 
// Function to change sender name
function wpb_sender_name( $original_email_from ) {
    return 'BiogasCommunity';
}
 
// Hooking up our functions to WordPress filters 
add_filter( 'wp_mail_from', 'wpb_sender_email' );
add_filter( 'wp_mail_from_name', 'wpb_sender_name' );



function wpse_lost_password_redirect($user) {
	update_field('password_reset_date',date('Y-m-d H:i:s'),'user_'.$user->ID);
	update_field('is_password_reset','yes','user_'.$user->ID);
	/* wp_redirect( home_url().'/wp-login.php' ); 
    exit; */
}
add_action('after_password_reset', 'wpse_lost_password_redirect');





function corporate_accounts_management(){
	
	$company_name = $_POST['company_name'];
	$is_displayed = $_POST['is_displayed'];
	$user_id = $_POST['user_id'];

	global $wpdb;;

	$user_role = get_userdata( $user_id)->roles;
	$user_role[] = 'memberpress_account' ;

	/*$wpdb->update( 'wp_usermeta', array( 'meta_value' => serialize($user_roles) ), array( 'user_id' => intval($user_id),'meta_key'=>'wp_capabilities' ), array( '%s' ), array( '%d','%s' ) ); */

	if ( $is_displayed == 'false' ) {
		$wp_user_object = new WP_User($user_id);
		$wp_user_object->remove_role('memberpress_account');
	}

	if ($is_displayed == 'true') {
		$wp_user_object = new WP_User($user_id);
		$wp_user_object->add_role('memberpress_account');
	}

	if ($wpdb->get_results(  "SELECT value FROM wp_bp_xprofile_data WHERE field_id = 20 AND user_id = ".$user_id  )[0]->value) {
		
		$wpdb->update
					( 'wp_bp_xprofile_data', 					
						array( 
							'value' => $company_name
						), 
						array( 
							'user_id' => intval($user_id),
							'field_id' => 20
						), 						
						array( '%s' ), 						
						array( '%d','%d' ) 
					);

	}else{
		$wpdb->insert( 'wp_bp_xprofile_data', 
					array( 
						'id' => NULL, 
						'field_id' => 20,
						'user_id' => intval($user_id),
						'value' => $company_name,
						'last_updated' => date("Y-m-d H:i:s")
					),
					array( 
						'%s', 
						'%d', 
						'%d', 
						'%s', 						
						'%s' 
					) 
				);
	}
	

	die();
}



add_action('wp_ajax_corporate_accounts_management', 'corporate_accounts_management' );
add_action('wp_ajax_nopriv_corporate_accounts_management', 'corporate_accounts_management' );




function mepr_new_signup(){

	global $wpdb;

	parse_str($_POST['dataform'], $POST);
	
	$first_name = $POST['first_name'];
	$last_name = $POST['last_name'];
	$company_name = $POST['user_login'];
	$email = $POST['user_email'];
	$subscription_id = $POST['sub_id'];

	$user_login_error = '';
	$user_email_error = '';
 
	if(email_exists( $email ) ){
		$user_email_error = 'This email already exists';
	}

	if(username_exists( $company_name )){
		$user_login_error = 'This user already exists';
	}


	if ( $user_login_error == '' && $user_email_error == '') {
		

		$wpdb->insert( 'wp_mepr_signup_bgw', 
						array( 
							'first_name' => $first_name,
							'last_name' => $last_name,
							'company_name' => $company_name,
							'email' => $email,
							'subscription_id' => $subscription_id
						), 
						array( 
							'%s', 
							'%s', 
							'%s', 
							'%s', 
							'%d' 
						) 
						);

		$data = array(
			'success'  => true,
			'signup_id' => strval($wpdb->insert_id),
			'sub_id' => strval($subscription_id),
			'donnes' => [

				$POST
			]
	  	);

	}else{

		$data = array(
			'success'  => false,
			'user_login_error' => $user_login_error,
			'user_email_error' => $user_email_error
	  	);

	}
	

	echo json_encode($data);

	die();

}
add_action('wp_ajax_mepr_new_signup', 'mepr_new_signup' );
add_action('wp_ajax_nopriv_mepr_new_signup', 'mepr_new_signup' );




// Manage Hubspot API-Key from Settings->Hubspot API on wp dashboard
class HubspotApi
{	
	const GROUP = 'HubspotAPI'; // page d'option

	public static function register(){
		add_action('admin_menu', [self::class, 'addMenu']);
		add_action( 'admin_init', [self::class, 'registerSettings'] );
	}

	public static function registerSettings() {
		register_setting( self::GROUP, 'hubspot_api_key');
		add_settings_section( 'hubspot_api_section', 'Settings', function(){
			echo 'This page allows you to manage the API key used to communicate with Hubspot ';
		}, self::GROUP);
		add_settings_field( 'hubspot_api_key_options', 'The API Key', function(){
			?>
			<input type="password" name="hubspot_api_key" style="width: 100%" value="<?= get_option('hubspot_api_key'); ?>">
			<?php
		}, self::GROUP, 'hubspot_api_section' );
	}

	public static function addMenu() {
		add_options_page( "Hubspot API key Management", "Hubspot API", "manage_options", "hubspot_api",  [self::class, 'render'] );
	}

	public static function render() {
		?>
		<h1>Hubspot API Key Management</h1>
		<form action="options.php" method="post" >			
			<?php 
				settings_fields( self::GROUP );
				do_settings_sections( self::GROUP );
				submit_button(); 
			?>			
		</form>
		<?php
	}
	
}

HubspotApi::register();



// Manage Biogasworld API-Key from Settings->Hubspot API on wp dashboard
class StripeOptions
{	
	const GROUP = 'StripeOptions'; // page d'option

	public static function register(){
		add_action('admin_menu', [self::class, 'addMenu']);
		add_action( 'admin_init', [self::class, 'registerSettings'] );
	}

	public static function registerSettings() {
		register_setting( self::GROUP, 'stripe_api_key');

		$list_of_memberships = get_list_of_all_memberships();

		
		foreach ($list_of_memberships["post_name"] as $key => $value) {
			register_setting( self::GROUP, 'price_'.$value);
		}
		/* 
		register_setting( self::GROUP, 'price_premium_business');
		register_setting( self::GROUP, 'price_standard_business');
		register_setting( self::GROUP, 'price_basic_business');
 		*/
		add_settings_section( 'stripe_settings_section', 'Settings', function(){
			echo 'This page allows you to manage the emails for diffrent Biogasworld forms ';
		}, self::GROUP);
		
		add_settings_field( 'stripe_settings_options', '', function(){
			?>



				<p>Used STRIPE API KEY</p>
				<input type="text" name="stripe_api_key" style="width: 100%" value="<?= get_option('stripe_api_key'); ?>">

				<? foreach (get_list_of_all_memberships()["post_name"] as $key => $value): ?>
					<p>Stripe price code for <?= $value; ?></p>
					<input type="text" name="price_<?= $value; ?>" style="width: 100%" value="<?= get_option('price_'.$value); ?>">				
				<? endforeach; ?>


				
			<?php
		}, self::GROUP, 'stripe_settings_section' );


	}

	public static function addMenu() {
		add_options_page( "Stripe Settings", "Stripe Settings", "manage_options", "setting_stripe",  [self::class, 'render'] );
	}

	public static function render() {
		?>
		<h1>Stripe Settings</h1>
		<form action="options.php" method="post" >			
			<?php 			
				settings_fields( self::GROUP );
				do_settings_sections( self::GROUP );
				submit_button(); 
			?>			
		</form>
		<?php
	}
	
}

StripeOptions::register();










function ADD_TO_HUBSPOT_FORM($Data, $Form_id,$url='',$pageName='',$header_url=null,$Contact_Owner){

	//36404617 - Natalia
	//36478030 - Maxime
	//36559351 - Nikolas
	//36584519 - Ghiles
	//36584606 - Audrey

	$hubspotutk      = $_COOKIE['hubspotutk']; //grab the cookie from the visitors browser.
	$ip_addr         = $_SERVER['REMOTE_ADDR']; //IP address too.
	$hs_context      = array(
													    'hutk' => $hubspotutk,
													    'ipAddress' => $ip_addr,
													    'pageUrl' => $url,
													    'pageName' => $pageName
														);
	$hs_context_json = json_encode($hs_context);

	$i=0;
	$str_post='';

	foreach ($Data as $key => $d) {							
		if ($i > 0) {
			$str_post .= '&'.$key.'='.urlencode($d);
		}else{
			$str_post .= ''.$key.'='.urlencode($d);
		}
		$i++;
	}

		//Need to populate these variable with values from the form.
		$str_post = $str_post. "&hubspot_owner_id=" . urlencode($Contact_Owner); //Leave this one be
		$str_post = $str_post. "&hs_context=" . urlencode($hs_context_json); //Leave this one be

		//replace the values in this URL with your portal ID and your form GUID
		$endpoint = 'https://forms.hubspot.com/uploads/form/v2/5799596/'.$Form_id;
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $str_post);
		curl_setopt($ch, CURLOPT_URL, $endpoint);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
							    'Content-Type: application/x-www-form-urlencoded'
								));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response    = curl_exec($ch); //Log the response from HubSpot as needed.
		$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE); //Log the response status code
		curl_close($ch);

		if ($header_url) {
			header('Location: '.$header_url); 
		}	
}	
/*
add_filter( 'password_reset_expiration', function( $expiration ) {
    return MONTH_IN_SECONDS;
});
*/



function send_welcome_email($user_id){

	

 	
	$notify = '';

	// Accepts only 'user', 'admin' , 'both' or default '' as $notify.
	if ( ! in_array( $notify, array( 'user', 'admin', 'both', '' ), true ) ) {
		return;
	}

	$user = get_userdata( $user_id );

	$member = new MeprUser(); 
	$member->ID = $user_id; 
	$Subscription = $member->get_active_subscription_titles(); 

	// The blogname option is escaped with esc_html() on the way into the database in sanitize_option().
	// We want to reverse this for the plain text arena of emails.
	$blogname = wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES );

	$key = get_password_reset_key( $user );
	if ( is_wp_error( $key ) ) {
		return;
	}

	$switched_locale = switch_to_locale( get_user_locale( $user ) );


	$message  = sprintf( __( 'Username: %s' ), $user->user_login ) . "<br><br>";
	$message .= __( 'To set your password, please ­<a href=\'' );
	$message .= network_site_url( "wp-login.php?action=rp&key=$key&login=" . rawurlencode( $user->user_login ), 'login' ) . "'>Click here</a><br><br>";
	$message .= __('Please note that this link will expire in <b>24 hours<b>. For assistance or any question, please contact us at <a href="mailto:info@biogasworld.com">info@biogasworld.com</a><br><br>');
	
	//$message .= wp_login_url() . "\r\n";

	$wp_new_user_notification_email = array(
		'to'      => $user->user_email,
		'subject' => __( 'Welcome to %s' ),
		'message' => str_replace(["[Message]","[User Name]","[Subscription]"],  [$message,$user->display_name,$Subscription], Wlcm_Email_Template()),
		'headers' => ['Bcc: <ghiles9@gmail.com>','Bcc: <natalia.biogasworld@gmail.com>'],
	);

	$wp_new_user_notification_email = apply_filters( 'wp_new_user_notification_email', $wp_new_user_notification_email, $user, $blogname );

	add_filter('wp_mail_content_type',create_function('', 'return "text/html"; '));

	if (wp_mail(
		$wp_new_user_notification_email['to'],
		wp_specialchars_decode( sprintf( $wp_new_user_notification_email['subject'], $blogname ) ),
		$wp_new_user_notification_email['message'],
		$wp_new_user_notification_email['headers']
	)) {

		update_field('welcome_email_sent','yes','user_'.$user_id);
		update_field('welcome_email_sent_date',date("Y-m-d H:i:s"),'user_'.$user_id);
		
		$data = array(
			'success'  => true
		);
		
	}else{
		$data = array(
			'success'  => false,
			'error_email' => 'Email was not sent'
		);
	}

	/*echo json_encode($data);*/

	if ( $switched_locale ) {
		restore_previous_locale();
	}


}


function get_list_of_all_memberships(){
	global $wpdb;
	$result = $wpdb->get_results("SELECT ID,post_title,post_name FROM `wp_posts` WHERE `post_type` LIKE 'memberpressproduct'");

	foreach ($result as $key => $value) {
		$ID[] = intval($value->ID);
		$post_title[] = $value->post_title;
		$post_name[] = $value->post_name;
	}


	return 	["ID" => $ID,	"post_title" => $post_title,	"post_name" => $post_name];
}





// Add a new column to the post edit screen
function custom_post_columns($columns) {
    $columns['custom_field'] = 'Closing date';
    return $columns;
}
add_filter('manage_bid_posts_columns', 'custom_post_columns');

// Output the value of the ACF field for each post in the custom column
function custom_post_column_content($column_name, $post_id) {
    if ($column_name == 'custom_field') {
        $custom_field_value = get_field('closing_date', $post_id);
        echo $custom_field_value;
    }
}
add_action('manage_bid_posts_custom_column', 'custom_post_column_content', 10, 2);



// Make custom column sortable
function custom_post_sortable_columns($columns) {
    $columns['custom_field'] = 'closing_date';
    return $columns;
}
add_filter('manage_edit-bid_sortable_columns', 'custom_post_sortable_columns');

// Modify the query to order by the custom field value when the column is clicked
function custom_post_orderby($query) {

    if (!is_admin() || !$query->is_main_query() || $query->get('orderby') != 'closing_date') {

        return;
    }
    $query->set('meta_key', 'closing_date');
    $query->set('orderby', 'meta_value');
    $query->set('meta_type', 'DATE');
}
add_action('pre_get_posts', 'custom_post_orderby');














// Add a new column to the post edit screen
function custom_post_columns1($columns) {
    $columns['custom_field'] = 'End Date';
    return $columns;
}
add_filter('manage_event_posts_columns', 'custom_post_columns1');

// Output the value of the ACF field for each post in the custom column
function custom_post_column_content1($column_name, $post_id) {
    if ($column_name == 'custom_field') {
        $custom_field_value = get_field('end_date', $post_id);
        echo $custom_field_value;
    }
}
add_action('manage_event_posts_custom_column', 'custom_post_column_content1', 10, 2);



// Make custom column sortable
function custom_post_sortable_columns1($columns) {
    $columns['custom_field'] = 'end_date';
    return $columns;
}
add_filter('manage_edit-event_sortable_columns', 'custom_post_sortable_columns1');

// Modify the query to order by the custom field value when the column is clicked
function custom_post_orderby1($query) {

    if (!is_admin() || !$query->is_main_query() || $query->get('orderby') != 'end_date') {

        return;
    }
    $query->set('meta_key', 'end_date');
    $query->set('orderby', 'meta_value');
    $query->set('meta_type', 'DATE');
}
add_action('pre_get_posts', 'custom_post_orderby1');



// Add a new column to the post edit screen
function custom_post_columns2($columns) {
    $columns['custom_field'] = 'Closing date';
    return $columns;
}
add_filter('manage_funding_posts_columns', 'custom_post_columns2');

// Output the value of the ACF field for each post in the custom column
function custom_post_column_content2($column_name, $post_id) {
    if ($column_name == 'custom_field') {
        $custom_field_value = get_field('closing_date', $post_id);
        echo $custom_field_value;
    }
}
add_action('manage_funding_posts_custom_column', 'custom_post_column_content2', 10, 2);



// Make custom column sortable
function custom_post_sortable_columns2($columns) {
    $columns['custom_field'] = 'closing_date';
    return $columns;
}
add_filter('manage_edit-funding_sortable_columns', 'custom_post_sortable_columns2');

// Modify the query to order by the custom field value when the column is clicked
function custom_post_orderby2($query) {

    if (!is_admin() || !$query->is_main_query() || $query->get('orderby') != 'closing_date') {

        return;
    }
    $query->set('meta_key', 'closing_date');
    $query->set('orderby', 'meta_value');
    $query->set('meta_type', 'DATE');
}
add_action('pre_get_posts', 'custom_post_orderby2');


// Add a new column to the post edit screen
function custom_post_columns3($columns) {
    $columns['custom_field'] = 'Closing date';
    return $columns;
}
add_filter('manage_bid-private_posts_columns', 'custom_post_columns3');

// Output the value of the ACF field for each post in the custom column
function custom_post_column_content3($column_name, $post_id) {
    if ($column_name == 'custom_field') {
        $custom_field_value = get_field('closing_date', $post_id);
        echo $custom_field_value;
    }
}
add_action('manage_bid-private_posts_custom_column', 'custom_post_column_content3', 10, 2);



// Make custom column sortable
function custom_post_sortable_columns3($columns) {
    $columns['custom_field'] = 'closing_date';
    return $columns;
}
add_filter('manage_edit-bid-private_sortable_columns', 'custom_post_sortable_columns3');

// Modify the query to order by the custom field value when the column is clicked
function custom_post_orderby3($query) {

    if (!is_admin() || !$query->is_main_query() || $query->get('orderby') != 'closing_date') {

        return;
    }
    $query->set('meta_key', 'closing_date');
    $query->set('orderby', 'meta_value');
    $query->set('meta_type', 'DATE');
}
add_action('pre_get_posts', 'custom_post_orderby3');


// Add a new column to the post edit screen
function custom_post_columns4($columns) {
    $columns['custom_field'] = 'Deadline To Apply';
    return $columns;
}
add_filter('manage_career_jobs_posts_columns', 'custom_post_columns4');

// Output the value of the ACF field for each post in the custom column
function custom_post_column_content4($column_name, $post_id) {
    if ($column_name == 'custom_field') {
        $custom_field_value = get_field('deadline_to_apply', $post_id);
        echo $custom_field_value;
    }
}
add_action('manage_career_jobs_posts_custom_column', 'custom_post_column_content4', 10, 2);
// Make custom column sortable
function custom_post_sortable_columns4($columns) {
    $columns['custom_field'] = 'deadline_to_apply';
    return $columns;
}
add_filter('manage_edit-career_jobs_sortable_columns', 'custom_post_sortable_columns4');

// Modify the query to order by the custom field value when the column is clicked
function custom_post_orderby4($query) {

    if (!is_admin() || !$query->is_main_query() || $query->get('orderby') != 'deadline_to_apply') {

        return;
    }
    $query->set('meta_key', 'deadline_to_apply');
    $query->set('orderby', 'meta_value');
    $query->set('meta_type', 'DATE');
}
add_action('pre_get_posts', 'custom_post_orderby4');
function add_forgot_password_link() {
    return '<a href="' . wp_lostpassword_url() . '">Forgot password?</a>';
}

add_filter( 'login_form_bottom', 'add_forgot_password_link' );
