<?php

class GFFUF_Hooks {

	private $version;
	private $plugin_name;

	/**
	 * Initialize the class and set its properties.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->version = $version;
		$this->plugin_name = $plugin_name;

	}

	/**
	 * Register the JavaScript and Style for admin area.
	 */
	public function admin_scripts( $hook ) { 

		if ( strpos( $hook, 'gf_edit' ) !== false ) { 

			wp_enqueue_style( 'wp-color-picker' ); 
			wp_enqueue_script( 'wp-color-picker' ); 
			wp_enqueue_style( $this->plugin_name, plugin_dir_url( dirname(__FILE__) ) . 'asset/css/public.css', array(), $this->version, 'all' );

		}

	}

	/**
	 * Registering admin script when running on no-conflict mode
	 */
	public function noconflict_scripts( $scripts ){
	    
	    $scripts[] = "wp-color-picker";

	    return $scripts;
	}

	/**
	 * Registering admin style when running on no-conflict mode
	 */
	public function noconflict_styles( $styles ) {
	    
	    $styles[] = "wp-color-picker";
	    $styles[] = $this->plugin_name;
	    
	    return $styles;
	}

	/**
	 * Register the JavaScript and Style for Gravity Form.
	 */
	public function enqueue_scripts( $form, $is_ajax ) {

		$gfields = $form['fields'];
		$fileupload_styles = ''; 
		$style_arr = array('#555555');

		foreach ( $gfields as $key => $gfield ) {
			if( $gfield['type'] == 'fileupload' ) {
				if( isset( $gfield['jbTheme'] ) && !in_array( $gfield['jbTheme'], $style_arr ) ){
					$style_arr[] = $gfield['jbTheme'];
					$fileupload_styles .= $this->inline_styles( $gfield['jbTheme'] );
				}
			}
		}

		$plugin_dir_url = plugin_dir_url( dirname(__FILE__) );

		wp_enqueue_style( 'fontawesome', $plugin_dir_url . 'asset/lib/css/font-awesome.min.css', array(), '4.7.0', 'all' );
		wp_enqueue_style( $this->plugin_name, $plugin_dir_url . 'asset/css/public.css', array(), $this->version, 'all' );
		wp_enqueue_script( $this->plugin_name, $plugin_dir_url . 'asset/js/public.js', array('jquery'), $this->version, true );

		if( !empty( $fileupload_styles ) )
			wp_add_inline_style( $this->plugin_name, $fileupload_styles );

	}

	/**
	 * Set custom styles base on the fileupload button color.
	 */
	public function inline_styles( $hex ) { 

		$class = '.jbfile-styler-theme--'. ltrim( $hex, '#' );

		$style = "
			$class .ginput_preview:before,
			$class + div > .ginput_preview:before,
			$class .jbfile-styler .gform_drop_instructions:before{
			  color: $hex;
			}
			$class .jbfile-styler__button, 
			$class .jbfile-styler input.gform_button_select_files{
			  background-color: $hex;
			}
		";

		return trim( preg_replace('/\s\s+/', '', $style) );

	}

	/**
	 * Inject Javascript into the Gravity form editor page.
	 */
	public function editor_js() {

		$gffuf_data = array(
			'choose_file' => esc_html__( 'Choose file', 'gravityforms-fileupload' ),
			'no_file' => esc_html__( 'No file chosen', 'gravityforms-fileupload' ),
		);

		printf( '<script type="text/javascript">var gffuf_data=%s;</script>', json_encode( $gffuf_data ) );

		?>
	    <script type='text/javascript'>

	        //adding setting to fields of type "fileupload"
	        fieldSettings.fileupload += ', .jb_fileupload_enablestyler_setting';
	        fieldSettings.fileupload += ', .jb_fileupload_theme_setting';
	        fieldSettings.fileupload += ', .jb_fileupload_showicon_setting';
	        fieldSettings.fileupload += ', .jb_fileupload_icon_setting';
	        fieldSettings.fileupload += ', .jb_fileupload_buttontext_setting';
	        fieldSettings.fileupload += ', .jb_fileupload_buttonplacement_setting';
	        fieldSettings.fileupload += ', .jb_fileupload_placeholder_setting';
	       
	        jQuery(document).bind('gform_load_field_settings', function(event, field, form){

	            if (field.type == 'fileupload') {

	            	if(typeof field.jbTheme == 'undefined' || field.jbTheme == "")
	            		field.jbTheme = '#555555';

	            	if(typeof field.jbEnableStyler == 'undefined')
	            		field.jbEnableStyler = false;

	            	if(typeof field.jbShowIcon == 'undefined')
	            		field.jbShowIcon = false;

	            	if(typeof field.jbButtonText == 'undefined')
	            		field.jbButtonText = '';

	            	if(typeof field.jbButtonPlacement == 'undefined')
	            		field.jbButtonPlacement = 'left';

	            	if(typeof field.jbPlaceholder == 'undefined')
	            		field.jbPlaceholder = '';

	            	if(typeof field.jbUploadIcon == 'undefined')
	            		field.jbUploadIcon = '12';

	            	if( !jQuery('#jb_fileupload_theme').hasClass('color_picket_init') ){
	            		jQuery('#jb_fileupload_theme').wpColorPicker({
		            		change: function(event, ui){ 
		            			var color = ui.color.toString();
		            			SetFieldProperty('jbTheme', color);
		            			set_fileupload_color( jQuery(this), color );
		            		}
		            	});
		            	jQuery('#jb_fileupload_theme').addClass('color_picket_init'); 
	            	}
	            	setTimeout(function(){
	            		jQuery('#jb_fileupload_theme').val( field.jbTheme ).trigger('change');
	            	},500);

	            	jQuery('#jb_fileupload_enablestyler').prop('checked', field.jbEnableStyler);
	            	jQuery('#jb_fileupload_showicon').prop('checked', field.jbShowIcon);
	            	jQuery('#jb_fileupload_buttontext').val(field.jbButtonText);
	            	jQuery('#jb_fileupload_buttonplacement').val(field.jbButtonPlacement);
	            	jQuery('#jb_fileupload_placeholder').val(field.jbPlaceholder);
	            	jQuery('#jb_fileupload_icon').find('.jbfile-icon').removeClass('active');
	            	jQuery('#jb_fileupload_icon').find('.jbfile-icon-'+field.jbUploadIcon).addClass('active');

	            	if(field.multipleFiles){
	            		jQuery('#jb_fileupload_buttonplacement').closest('.field_setting').hide();
	            	}else{
	            		jQuery('#jb_fileupload_icon, #jb_fileupload_showicon').closest('.field_setting').hide();
	            	}
	            }

	        });

	        function set_fileupload_color(el, color) { 
	        	var con = el.closest('.gfield');

    			con.find('.jbfile-styler__button').css('background-color',color);
				con.find('.gform_drop_instructions').css('color',color);
				con.find('.gform_button_select_files').css('cssText', 'background-color:'+color+' !important;');
	        }

	        jQuery(document).ready(function($){

	        	$('.jbfile-styler__single').each(function(){
			    	var con = $(this).closest('.gfield').find('.jbfile-styler__field');
			    	con.append($(this));
			    });

	        	$(document).on('change', '.jb_fileupload_enablestyler', function(){
	        		SetFieldProperty('jbEnableStyler', $(this).prop('checked'));
	        		update_file_preview($(this));
	        	});
	        	$(document).on('change', '.jb_fileupload_showicon', function(){
	        		SetFieldProperty('jbShowIcon', $(this).prop('checked'));
	        		update_file_preview($(this));
	        	});
	        	$(document).on('blur', '.jb_fileupload_buttontext', function(){
	        		SetFieldProperty('jbButtonText', $(this).val());
	        		update_file_preview($(this));
	        	});
	        	$(document).on('change', '.jb_fileupload_buttonplacement', function(){
	        		SetFieldProperty('jbButtonPlacement', $(this).val());
	        		update_file_preview($(this));
	        	});
	        	$(document).on('blur', '.jb_fileupload_placeholder', function(){
	        		SetFieldProperty('jbPlaceholder', $(this).val());
	        		update_file_preview($(this));
	        	});
	        	$(document).on('change', '.jb_fileupload_icon', function(e){
	        		var index =  $(this).val();

	        		$(this).closest('.jbfile-icon__con').find('.jbfile-icon').removeClass('active');
	        		$('.jbfile-icon-'+index).addClass('active');
	        		SetFieldProperty('jbUploadIcon', index);
	        		update_file_preview($(this));
	        	});

	        	var icon_class	= 'jbfile-icon-1 jbfile-icon-2 jbfile-icon-3 jbfile-icon-4 jbfile-icon-5 jbfile-icon-6 jbfile-icon-7 jbfile-icon-8 jbfile-icon-9 jbfile-icon-10 jbfile-icon-11 jbfile-icon-12';
	        
	        	function update_file_preview(el){
	        		var con = el.closest('.gfield');

	        		var enablestyle 	= con.find('.jb_fileupload_enablestyler').prop('checked'),
	        			showicon    	= con.find('.jb_fileupload_showicon').prop('checked'),
	        			uploadicon  	= con.find('.jbfile-icon.active').parent().prev('input').val(),
	        			placeholder 	= con.find('.jb_fileupload_placeholder').val().trim(),
	        			buttontext  	= con.find('.jb_fileupload_buttontext').val().trim(),
	        			placement  		= con.find('.jb_fileupload_buttonplacement').val();

	        		if(enablestyle){

	        			set_styler_settings(con, true);

	        			if(placeholder != ""){
		        			con.find('.jbfile-styler__caption span').text(placeholder);
		        			con.find('.gform_drop_instructions').html('<span>'+placeholder+'</span>');
		        		}else{
		        			con.find('.jbfile-styler__caption span').text('No file chosen');
		        			con.find('.gform_drop_instructions').html('<span>Drop files here</span>');
		        		}

		        		if(buttontext != ""){
		        			con.find('.jbfile-styler__button span').text(buttontext);
		        			con.find('.gform_button_select_files').val(buttontext);
		        		}else{
		        			con.find('.jbfile-styler__button span').text('Choose File');
		        			con.find('.gform_button_select_files').val('Select Files');
		        		}

		        		con.find('.gform_drop_instructions').removeClass(icon_class);
		        		if(showicon){
		        			con.find('.gform_drop_instructions').addClass('jbfile-icon-'+uploadicon);
		        		}
		        		con.find('.jbfile-styler__single').removeClass('jbfile-styler__left jbfile-styler__right');
		        		con.find('.jbfile-styler__single').addClass('jbfile-styler__'+placement);
		        		        	
	        		}else{
	        			set_styler_settings(con, false);
	        		}
	        	}

	        	function set_styler_settings(gfield, enable){
	        		if(enable){
	        			gfield.find('.gform_fileupload_multifile').addClass('jbfile-styler');
	        			
						gfield.find('.jb_fileupload_theme_setting').show();
	        			gfield.find('.jb_fileupload_placeholder_setting').show();
	        			gfield.find('.jb_fileupload_buttontext_setting').show();

	        			if(gfield.find('.gform_fileupload_multifile').length){
	        				gfield.find('.jb_fileupload_icon_setting').show();
	        				gfield.find('.jb_fileupload_showicon_setting').show();
	        			}else{
	        				gfield.find('.jb_fileupload_buttonplacement_setting').show();

	        				gfield.find('.ginput_container_fileupload').addClass('jbfile-styler__field');

	        				if(gfield.find('.jbfile-styler__single').length == 0){
	        					var temp = '<div class="jbfile-styler__single jbfile-styler__left">'+
									'<div class="jbfile-styler__button">'+
										'<span>'+gffuf_data.choose_file+'</span>'+
									'</div>'+
									'<div class="jbfile-styler__caption">'+
										'<span>'+gffuf_data.no_file+'</span>'+
									'</div>'+		
								'</div>';
								gfield.find('.ginput_container_fileupload').append(temp);
	        				}
	
	        				gfield.find('.jbfile-styler__single').show();
	        			}
	        		}else{

	        			gfield.find('.jb_fileupload_theme_setting').hide();
	        			gfield.find('.jb_fileupload_icon_setting').hide();
	        			gfield.find('.jb_fileupload_showicon_setting').hide();
	        			gfield.find('.jb_fileupload_placeholder_setting').hide();
	        			gfield.find('.jb_fileupload_buttontext_setting').hide();
	        			gfield.find('.jb_fileupload_buttonplacement_setting').hide();
			
	        			gfield.find('.jbfile-icon').removeClass('active');
	        			gfield.find('.jbfile-icon-12').addClass('active');
	        			gfield.find('.jb_fileupload_theme').val('#555555').trigger('change');
	        			gfield.find('.jb_fileupload_showicon').prop('checked',false);
	        			gfield.find('.jb_fileupload_buttonplacement').val('left');
	        			gfield.find('.jb_fileupload_placeholder').val('');
	        			gfield.find('.jb_fileupload_buttontext').val('');

	        			if(gfield.find('.gform_fileupload_multifile').length){
	        				gfield.find('.gform_drop_instructions').text('Drop files here or').removeClass(icon_class).removeAttr('style');
	        				gfield.find('.gform_button_select_files').val('Select Files').removeAttr('style');;
	        				gfield.find('.gform_fileupload_multifile').removeClass('jbfile-styler');
	        			}else{
	        				gfield.find('.jbfile-styler__button span').text('Choose File');
	        				gfield.find('.jbfile-styler__caption span').text('No file chosen');
	        				gfield.find('.jbfile-styler__single').removeClass('jbfile-styler__left jbfile-styler__right').hide();
	        				gfield.find('.ginput_container_fileupload').removeClass('jbfile-styler__field');
	        			}			

	        			SetFieldProperty('jbShowIcon', false);
	        			SetFieldProperty('jbTheme', '#555555');
	        			SetFieldProperty('jbButtonText', '');
	        			SetFieldProperty('jbButtonPlacement', 'left');
	        			SetFieldProperty('jbPlaceholder', '');
	        			SetFieldProperty('jbUploadIcon', '12');
	        		}
	        	}

	        	function initialize_file_upload(){
	        		$('[class*=jbfile-styler-theme--]').each(function(){
	        			var ths = $(this),
	        			 	cls = ths.attr('class'),
	        				cls_ar = cls.split(' ');

	        			$.each(cls_ar, function(i,v){
	        				if( v.indexOf( 'jbfile-styler-theme--' ) != -1 ){
	        					var color = '#' + v.split('--')[1];
	        					ths.find('.jbfile-styler__button').css('background-color',color);
	        					ths.find('.gform_drop_instructions').css('color',color);
	        					ths.find('.gform_button_select_files').css('cssText', 'background-color:'+color+' !important;');
	        				}
	        			});
	        		});
	        	}
	        	initialize_file_upload();
	        });

	    </script>
	    <?php
	}

	/**
	 * Add additional options to the field appearance settings.
	 */
	public function field_appearance_settings( $position, $form_id ) {

	    if ( $position == 50 ) {
	        ?>
	        <li class="jb_fileupload_enablestyler_setting field_setting">
	            <label for="jb_fileupload_enablestyler">
	            	<input type="checkbox" id="jb_fileupload_enablestyler" class="jb_fileupload_enablestyler"/>
	                <?php esc_html_e( 'Enable Enhance User Interface', 'gravityforms-fileupload' ); ?>
	                <?php gform_tooltip( 'form_jb_fileupload_enablestyler' ) ?>
	            </label>
	        </li>
	        <li class="jb_fileupload_theme_setting field_setting">
	            <label for="jb_fileupload_theme" class="section_label">
	                <?php esc_html_e( 'Button & Icon Color', 'gravityforms-fileupload' ); ?>
	                <?php gform_tooltip( 'form_jb_fileupload_theme' ) ?>
	            </label>
	        	<input type="text" id="jb_fileupload_theme" class="jb_fileupload_theme" data-default-color="#555555"/>
	        </li>
	        <li class="jb_fileupload_showicon_setting field_setting">
	            <label for="jb_fileupload_showicon">
	            	<input type="checkbox" id="jb_fileupload_showicon" class="jb_fileupload_showicon"/>
	                <?php esc_html_e( 'Show Upload Icon', 'gravityforms-fileupload' ); ?>
	                <?php gform_tooltip( 'form_jb_fileupload_showicon' ) ?>
	            </label>
	        </li>
	        <li class="jb_fileupload_icon_setting field_setting">
            	<label for="jb_fileupload_icon" class="section_label">
	                <?php esc_html_e( 'Upload Icon', 'gravityforms-fileupload' ); ?>
	                <?php gform_tooltip( 'form_jb_fileupload_icon' ) ?>
	            </label>
            	<div class="jbfile-icon__con" id="jb_fileupload_icon">
            		<div>
					    <input id="jbfile-icon1" name="jb_fileupload_icon" type="radio" class="jb_fileupload_icon" value="1" />
					    <label for="jbfile-icon1"><i class="jbfile-icon jbfile-icon-1"></i></label>
					</div>
					<div>
					    <input id="jbfile-icon2" name="jb_fileupload_icon" type="radio" class="jb_fileupload_icon" value="2" />
					    <label for="jbfile-icon2"><i class="jbfile-icon jbfile-icon-2"></i></label>
					</div>
					<div>
					    <input id="jbfile-icon3" name="jb_fileupload_icon" type="radio" class="jb_fileupload_icon" value="3" />
					    <label for="jbfile-icon3"><i class="jbfile-icon jbfile-icon-3"></i></label>
					</div>
					<div>
					    <input id="jbfile-icon4" name="jb_fileupload_icon" type="radio" class="jb_fileupload_icon" value="4" />
					    <label for="jbfile-icon4"><i class="jbfile-icon jbfile-icon-4"></i></label>
					</div>
					<div>
					    <input id="jbfile-icon5" name="jb_fileupload_icon" type="radio" class="jb_fileupload_icon" value="5" />
					    <label for="jbfile-icon5"><i class="jbfile-icon jbfile-icon-5"></i></label>
					</div>
					<div>
					    <input id="jbfile-icon6" name="jb_fileupload_icon" type="radio" class="jb_fileupload_icon" value="6" />
					    <label for="jbfile-icon6"><i class="jbfile-icon jbfile-icon-6"></i></label>
					</div><br>
					<div>
					    <input id="jbfile-icon7" name="jb_fileupload_icon" type="radio" class="jb_fileupload_icon" value="7" />
					    <label for="jbfile-icon7"><i class="jbfile-icon jbfile-icon-7"></i></label>
					</div>
					<div>
					    <input id="jbfile-icon8" name="jb_fileupload_icon" type="radio" class="jb_fileupload_icon" value="8" />
					    <label for="jbfile-icon8"><i class="jbfile-icon jbfile-icon-8"></i></label>
					</div>
					<div>
					    <input id="jbfile-icon9" name="jb_fileupload_icon" type="radio" class="jb_fileupload_icon" value="9" />
					    <label for="jbfile-icon9"><i class="jbfile-icon jbfile-icon-9"></i></label>
					</div>
					<div>
					    <input id="jbfile-icon10" name="jb_fileupload_icon" type="radio" class="jb_fileupload_icon" value="10" />
					    <label for="jbfile-icon10"><i class="jbfile-icon jbfile-icon-10"></i></label>
					</div>
					<div>
					    <input id="jbfile-icon11" name="jb_fileupload_icon" type="radio" class="jb_fileupload_icon" value="11" />
					    <label for="jbfile-icon11"><i class="jbfile-icon jbfile-icon-11"></i></label>
					</div>
					<div>
					    <input id="jbfile-icon12" name="jb_fileupload_icon" type="radio" class="jb_fileupload_icon" value="12" />
					    <label for="jbfile-icon12"><i class="jbfile-icon jbfile-icon-12 active"></i></label>
					</div>
            	</div>
	        </li>
	        <li class="jb_fileupload_buttontext_setting field_setting">
            	<label for="jb_fileupload_buttontext" class="section_label">
	                <?php esc_html_e( 'Button Text', 'gravityforms-fileupload' ); ?>
	                <?php gform_tooltip( 'form_jb_fileupload_buttontext' ) ?>
	            </label>
            	<input type="text" id="jb_fileupload_buttontext" class="jb_fileupload_buttontext"/>
	        </li>
	        <li class="jb_fileupload_buttonplacement_setting field_setting">
	            <label for="jb_fileupload_buttonplacement" class="section_label">
	                <?php esc_html_e( 'Button Placement', 'gravityforms-fileupload' ); ?>
	                <?php gform_tooltip( 'form_jb_fileupload_buttonplacement' ) ?>
	            </label>
	        	<select class="jb_fileupload_buttonplacement" id="jb_fileupload_buttonplacement">
    				<option value="left" selected><?php esc_html_e( 'Left', 'gravityforms-fileupload' ); ?></option>
	    			<option value="right"><?php esc_html_e( 'Right', 'gravityforms-fileupload' ); ?></option>
				</select>
	        </li>
	        <li class="jb_fileupload_placeholder_setting field_setting">
            	<label for="jb_fileupload_placeholder" class="section_label">
	                <?php esc_html_e( 'Placeholder Text', 'gravityforms-fileupload' ); ?>
	                <?php gform_tooltip( 'form_jb_fileupload_placeholder' ) ?>
	            </label>
            	<input type="text" id="jb_fileupload_placeholder" class="jb_fileupload_placeholder"/>
	        </li>
	        <?php
	    }
	}

	/**
	 * Add tooltips to the options on field appearance settings.
	 */
	public function field_tooltips( $tooltips ) {

		$tooltips['form_jb_fileupload_enablestyler'] = sprintf(
		    '<h6>%s</h6>%s',
		    esc_html__( 'Enable Enhance UI', 'gravityforms-fileupload' ),
		    esc_html__( 'If check, this will make the interface of file upload field more user friendly.', 'gravityforms-fileupload' )
		);
		$tooltips['form_jb_fileupload_showicon'] = sprintf(
		    '<h6>%s</h6>%s',
		    esc_html__( 'Show Upload Icon', 'gravityforms-fileupload' ),
		    esc_html__( 'If check, this will show the upload icon you have selected below.', 'gravityforms-fileupload' )
		);
		$tooltips['form_jb_fileupload_theme'] = sprintf(
		    '<h6>%s</h6>%s',
		    esc_html__( 'Button & Icon Color', 'gravityforms-fileupload' ),
		    esc_html__( 'Choose the color that will be used for the file upload button and icons.', 'gravityforms-fileupload' )
		);
		$tooltips['form_jb_fileupload_icon'] = sprintf(
		    '<h6>%s</h6>%s',
		    esc_html__( 'Upload Icon', 'gravityforms-fileupload' ),
		    esc_html__( 'Select the upload icon you want to display inside field.', 'gravityforms-fileupload' )
		);
		$tooltips['form_jb_fileupload_buttontext'] = sprintf(
		    '<h6>%s</h6>%s',
		    esc_html__( 'Button Text', 'gravityforms-fileupload' ),
		    esc_html__( 'If you would like to override the default text for the file upload button, enter it here.', 'gravityforms-fileupload' )
		);
		$tooltips['form_jb_fileupload_buttonplacement'] = sprintf(
		    '<h6>%s</h6>%s',
		    esc_html__( 'Button Placement', 'gravityforms-fileupload' ),
		    esc_html__( 'Select the file upload button placement. Button can be placed in left or right.', 'gravityforms-fileupload' )
		);
	   	$tooltips['form_jb_fileupload_placeholder'] = sprintf(
		    '<h6>%s</h6>%s',
		    esc_html__( 'Placeholder Text', 'gravityforms-fileupload' ),
		    esc_html__( 'If you would like to override the default text for the file upload placeholder, enter it here.', 'gravityforms-fileupload' )
		);
	   	
	   	return $tooltips;

	}


	/**
	 * This will modify the way the field content is rendered.
	 */
	public function field_content( $content, $field, $value, $lead_id, $form_id ) {

		if ( $field->type == 'fileupload' ) {
		
			if($field->jbEnableStyler == 'true'){

				$theme = (!empty($field->jbTheme)) ? 'jbfile-styler-theme--'. ltrim( $field->jbTheme, '#' ) : '' ;

				$content = str_replace( "ginput_container_fileupload", "ginput_container_fileupload jbfile-styler__field ".$theme, $content ); 

				if($field->multipleFiles == 'true'){

					$content = str_replace( 'gform_fileupload_multifile', "gform_fileupload_multifile jbfile-styler", $content );
					
					if($field->jbShowIcon == 'true')
						$content = str_replace( 'gform_drop_instructions', "gform_drop_instructions jbfile-icon-".$field->jbUploadIcon, $content ); 
					
					if(!empty($field->jbButtonText))
						$content = str_replace( esc_html__( 'Select files', 'gravityforms-fileupload' ), $field->jbButtonText, $content );

					if(!empty($field->jbPlaceholder))
						$content = str_replace( esc_html__( 'Drop files here or', 'gravityforms-fileupload' ), "<span>$field->jbPlaceholder</span>", $content );
					else
						$content = str_replace( esc_html__( 'Drop files here or', 'gravityforms-fileupload' ), '<span>'.esc_html__( 'Drop files here', 'gravityforms-fileupload' ).'</span>', $content );

				}else{
	
					$placement = (!empty($field->jbButtonPlacement)) ? 'jbfile-styler__'.$field->jbButtonPlacement : '';

					$file_ui = '<div class="jbfile-styler__single '.$placement.'">
						<div class="jbfile-styler__button">
							<span>' . esc_html__( 'Choose file', 'gravityforms-fileupload' ) . '</span>
						</div>
						<div class="jbfile-styler__caption">
							<span>'. esc_html__( 'No file chosen', 'gravityforms-fileupload' ) .'</span>
						</div>		
					</div>';

					if(!empty($field->jbButtonText))
						$file_ui = str_replace( esc_html__( 'Choose file', 'gravityforms-fileupload' ), $field->jbButtonText, $file_ui );

					if(!empty($field->jbPlaceholder))
						$file_ui = str_replace( esc_html__( 'No file chosen', 'gravityforms-fileupload' ), $field->jbPlaceholder, $file_ui );

					$content .= $file_ui;
					
				}
			}	
		}
		return $content;
	}

}