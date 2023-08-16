<?php
/**
 * Template name: Import Events
 *
 * @package BuddyBoss_Theme
 */

get_header();
global $wpdb;

$has_access = false;
if( current_user_can('editor') || current_user_can('administrator') ){$has_access = true;} 
$current_date = strtotime(date("Y-m-d"));
?>
	<?php 
	$share_box = buddyboss_theme_get_option( 'blog_share_box' ); 
	if ( !empty( $share_box ) && is_singular('post') ) :
		get_template_part( 'template-parts/share' ); 
	endif;
	?>

<style>#primary.content-area::before{content:"";width:100vw;height:120px;position:absolute;top:105px;left:0;background:#000d9d;background:linear-gradient(132deg,#000d9d 0,#00c67d 100%)}#main.site-main h1{color:#fff;font-weight:700}.bids_list .row{display:grid;grid-template-columns:30px 30% 1fr 1fr 1fr;grid-gap:20px;padding:15px 0}.bids_list .row:nth-child(odd){background:#e0e1eb}.bids_list .row p{margin:0;padding:0;font-size:13px;line-height:1em}.bids_list .row p a{font-size:16px;color:#000daa}.bids_list .row.head,.library_list .row_head{background:#5fcf85;border-top-right-radius:20px;border-top-left-radius:20px}.bids_list .row.head p{color:#fff;font-weight:600;display:block}.bids_list .row.head.footer{border-top-right-radius:0;border-top-left-radius:0;border-bottom-right-radius:20px;border-bottom-left-radius:20px}@media(max-width:940px){.bids_list .row{grid-template-columns:30px 30% 1fr 1fr}.bids_list .row>div:nth-child(3){display:none}}@media(max-width:740px){.bids_list .row{grid-template-columns:30px 1fr 100px}.bids_list .row.row_content>div.aligncenter:nth-child(4){grid-column:2/3;grid-row:2/3;text-align:left}.bids_list .row.row_content>div.aligncenter:nth-child(3){text-align:left}.bids_list .row>div.aligncenter:nth-child(4) p{display:block}}.search_bar{display:block;width:100%;padding:50px 0 0 0}.search_bar .form{display:grid;width:100%;grid-template-columns:2fr 1fr 1fr 100px;grid-gap:20px}.search_bar .formfield label{font-size:13px}.search_bar .formfield input[type=text]{display:block;width:100%}.search_bar .form .button{transform:translateY(27px)}.bids_list .row p a,.bids_list p{font-size:14px}</style>

    <div id="primary" class="content-area">

		<main id="main" class="site-main">            
        <h1><?php echo $post->post_title; ?> </h1>   

        <?php

            //var_dump(get_field_objects(505));
  
             // see the result


           
       
            $row = 1;
            $i = 0;

            if (($handle = fopen("https://docs.google.com/spreadsheets/d/e/2PACX-1vQnrri-J73zVxkdYyKwA6b_Ntx7671L82_Vh9fIOUuixV8uHbqFcP4p-pVBTR3wW_Tz-QVCoQdbQXNy/pub?output=csv", "r")) !== FALSE) {
                
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

                    $num = count($data);

                    $row++;

                    for ($c=0; $c <= $num; $c++) {                        
                        
                        if ($c==0){ $linevalues[$i]["Title"]    = $data[$c];  }                    
                        
                        
                        if ($c==1){ $linevalues[$i]["Website"]    = $data[$c];  }                    
                        if ($c==2){ $linevalues[$i]["Start_Date"]    = $data[$c];  }                    
                        if ($c==3){ $linevalues[$i]["End_Date"]    = $data[$c];  }                    
                        if ($c==4){ $linevalues[$i]["Ends_Time"]    = $data[$c];  }                    
                        if ($c==5){ $linevalues[$i]["Start_Time"]    = $data[$c];  }                    
                        if ($c==6){ $linevalues[$i]["Multiday"]    = $data[$c];  }                    
                        if ($c==7){ $linevalues[$i]["Language"]    = $data[$c];  }                    
                        if ($c==8){ $linevalues[$i]["Address"]    = $data[$c];  }                    
                        if ($c==9){ $linevalues[$i]["Description"]    = $data[$c];  }                                                                   
                        if ($c==12){ $linevalues[$i]["Event_Picture"]    = $data[$c];  }    
                        if ($c==13){ $linevalues[$i]["Banner_Picture"]    = $data[$c];}                    
                        
                                       
                        if ($c==14){ $linevalues[$i]["Short_Description"]    = $data[$c];}    
                        if ($c==11){ $linevalues[$i]["Biogas_Event"]    = $data[$c];  }                    
                        if ($c==15){ $linevalues[$i]["Instagram_Link"]    = $data[$c];}                    
                        if ($c==16){ $linevalues[$i]["Facebook_Link"]    = $data[$c];}                    
                        if ($c==17){ $linevalues[$i]["Twitter_Link"]    = $data[$c];}                    
                        if ($c==18){ $linevalues[$i]["Linkedin_Link"]    = $data[$c];}                    
                        if ($c==19){ $linevalues[$i]["Youtube_Link"]    = $data[$c];}  
                        if ($c==10){ $linevalues[$i]["File_Path"]    = $data[$c];  }
                        if ($c==29){ $linevalues[$i]["Title_For_Downloadable"]    = $data[$c]; }
                        if ($c==21){ $linevalues[$i]["BiogasWorld_Media_Partnership"]    = $data[$c];}  
                        if ($c==23){ $linevalues[$i]["Report_Link"]    = $data[$c];}
                        if ($c==24){ $linevalues[$i]["Is_Report"]    = $data[$c];}  
                        if ($c==27){ $linevalues[$i]["Supplement_Desc"]    = $data[$c]; }
                                       
                        
                        if ($c==20){ $linevalues[$i]["Email_Contact"]    = $data[$c];}                                          
                        if ($c==22){ $linevalues[$i]["Displayed_Short_Description"]    = $data[$c];}                                          
                        if ($c==25){ $linevalues[$i]["Reduction_Msg"]    = $data[$c];} 
                        if ($c==26){ $linevalues[$i]["Reduction_Msg_Your_Discount"]    = $data[$c];}                        
                        if ($c==28){ $linevalues[$i]["PromoCode"]    = $data[$c]; }                    
                                  
                    }
                    $i++;
                }
                fclose($handle);
            }

            function prettyPrint($a, $t='pre') {echo "<$t>".print_r($a,1)."</$t>";}
            
            //prettyPrint($linevalues);



            function Upload_image($imageURL){
                include( 'wp-load.php' );
                include_once( ABSPATH . '/wp-admin/includes/image.php' );

                $imageurl = $imageURL;
                $imagetype = end(explode('/', getimagesize($imageurl)['mime']));
                $uniq_name = date('dmY').''.(int) microtime(true); 
                $filename = $uniq_name.'.'.$imagetype;

                $uploaddir = wp_upload_dir();
                $uploadfile = $uploaddir['path'] . '/' . $filename;
                $contents= file_get_contents($imageurl);
                $savefile = fopen($uploadfile, 'w');
                fwrite($savefile, $contents);
                fclose($savefile);

                $wp_filetype = wp_check_filetype(basename($filename), null );
                $attachment = array(
                    'post_mime_type' => $wp_filetype['type'],
                    'post_title' => $filename,
                    'post_content' => '',
                    'post_status' => 'inherit'
                );

                $attach_id = wp_insert_attachment( $attachment, $uploadfile );
                $imagenew = get_post( $attach_id );
                $fullsizepath = get_attached_file( $imagenew->ID );
                $attach_data = wp_generate_attachment_metadata( $attach_id, $fullsizepath );
                wp_update_attachment_metadata( $attach_id, $attach_data ); 

                return $attach_id;
            }

            
                /*7 9 13*/
            

                $j=70;

                echo $j.'<br>';
                echo str_replace(' ','%20',$linevalues[$j]['Banner_Picture']).'<br>';

               
             

                $banniere = Upload_image( str_replace(' ','%20',$linevalues[$j]['Banner_Picture']) );

                $post_data = array(
                    'post_title'    => $linevalues[$j]['Title'],
                    'post_type'     => 'event',
                    'post_status'   => 'publish'
                );
                $post_id = wp_insert_post( $post_data );
                    
                $field_key = "field_60e325c9e9ce3";                
                update_field( $field_key, $banniere, $post_id );

                ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

                if($linevalues[$j]["Multiday"] == 'YES'){
                    $ddate = "From ".date('M, d Y',strtotime($linevalues[$j]['Start_Date']))." to ".date('M, d Y',strtotime($linevalues[$j]['End_Date']));
                    $event_time = "";
                }else{
                    $ddate = date('M, d Y',strtotime($linevalues[$j]['Start_Date']));
                    $event_time = "From :".$linevalues[$j]["Start_Time"]." to ".$linevalues[$j]["Ends_Time"];
                }

                ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

                $field_key = "field_60bd73fa3f24f";
                $value = $ddate;
                update_field( $field_key, $value, $post_id );

                ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

                $field_key = "field_60bd74373f250";
                $value = $event_time;
                update_field( $field_key, $value, $post_id );

                ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

                $field_key = "field_60bd744d3f251";
                $value = $linevalues[$j]['Address'];
                update_field( $field_key, $value, $post_id );
                
                ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

                $field_key = "field_60bd74893f252";
                $value = $linevalues[$j]['Website'];
                update_field( $field_key, $value, $post_id );

                ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

                $field_key = "field_60e31b240995e";
                $value = $linevalues[$j]['Reduction_Msg_Your_Discount'];
                update_field( $field_key, $value, $post_id );

                ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

                $field_key = "field_60e31b1a0995d";
                $value = $linevalues[$j]['PromoCode'];
                update_field( $field_key, $value, $post_id );

                $my_post = array(
                      'ID'           => $post_id,
                      'post_content' => $linevalues[$j]['Description'],
                 );
                 
                // Update the post into the database
                  wp_update_post( $my_post );

          
                Generate_Featured_Image( $linevalues[$j]['Event_Picture'], $post_id  );

            

            /*
       
            for ($j=1; $j < count($linevalues) ; $j++) { 
                $post_data = array(
                    'post_title'    => $linevalues[$j]['title'],
                    'post_type'     => 'funding',
                    'post_status'   => 'publish'
                );
                $post_id = wp_insert_post( $post_data );


                $field_key = "field_6079c707ea692";
                $value = date('D M dS Y',strtotime($linevalues[$j]['endDate']));
    
                update_field( $field_key, $value, $post_id );
    
                $field_key = "field_607b3a28b6816";
                $value = $linevalues[$j]['category'];
                
                update_field( $field_key, $value, $post_id );
    
                $field_key = "field_6079c735ea693";
                $value = $linevalues[$j]['description'];
    
                update_field( $field_key, $value, $post_id );
    
                $field_key = "field_6079c744ea694";
                $value = $linevalues[$j]['organization'];
    
                update_field( $field_key, $value, $post_id );
    
                $field_key = "field_6079c74bea695";
                $value = $linevalues[$j]['country'];
    
                update_field( $field_key, $value, $post_id );
    
                $field_key = "field_6079c765ea696";
                $value = $linevalues[$j]['Fname']." ".$linevalues[$j]['Lname'];
    
                update_field( $field_key, $value, $post_id );
    
                $field_key = "field_6079c776ea697";
                $value = $linevalues[$j]['email'];
    
                update_field( $field_key, $value, $post_id );
    
                $field_key = "field_6079d4928082b";
                $value = $linevalues[$j]['url'];
    
                update_field( $field_key, $value, $post_id );
                
                $field_key = "field_60e8645e20529";
                $value = $linevalues[$j]['category'];
    
                update_field( $field_key, $value, $post_id );
            }

            */

            function Generate_Featured_Image( $image_url, $post_id  ){
                $upload_dir = wp_upload_dir();
                $image_data = file_get_contents($image_url);
                $filename = basename($image_url);
                if(wp_mkdir_p($upload_dir['path']))
                  $file = $upload_dir['path'] . '/' . $filename;
                else
                  $file = $upload_dir['basedir'] . '/' . $filename;
                file_put_contents($file, $image_data);
            
                $wp_filetype = wp_check_filetype($filename, null );
                $attachment = array(
                    'post_mime_type' => $wp_filetype['type'],
                    'post_title' => sanitize_file_name($filename),
                    'post_content' => '',
                    'post_status' => 'inherit'
                );
                $attach_id = wp_insert_attachment( $attachment, $file, $post_id );
                require_once(ABSPATH . 'wp-admin/includes/image.php');
                $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
                $res1= wp_update_attachment_metadata( $attach_id, $attach_data );
                $res2= set_post_thumbnail( $post_id, $attach_id );
            }

            function generateRandomString($length = 10) {
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                $randomString = '';
                for ($i = 0; $i < $length; $i++) {
                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                }
                return $randomString;
            }
       


        ?>

        








    </div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php //get_sidebar(); ?>

<?php
get_footer();
?>
<style>

.deck{
    display: block; padding: 20px 0;
}

.grid_2{
    display: grid;
    grid-template-columns: 1fr 1fr;
    grid-gap: 20px;
}

.single .entry-title {
    margin-top: -30px;
    
}
</style>
