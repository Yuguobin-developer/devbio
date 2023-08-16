<?php
/**
 * Template name: test ghiles
 *
 * @package BuddyBoss_Theme
 */

get_header();
global $wpdb;
$pswd = wp_generate_password(16,1,1);?>

<?php 
  $tags = $wpdb->get_results("SELECT name FROM `wp_bp_xprofile_fields` WHERE `parent_id` = 21 ORDER BY `wp_bp_xprofile_fields`.`name` ASC");
  /* echo '<pre>';
  var_dump(gmdate('Y-m-d 23:59:59', (time() + MeprUtils::years(1))));
  echo '</pre>'; */
?>

<div id="primary" class="content-area">

    <main id="main" class="site-main">            

        <h1><?php echo $post->post_title; ?> </h1>   


        <div class="form_wrapper">
            <div class="form_container">
                <div class="title_container">
                    <h2>Admin Register Members</h2>
                </div>


                <div class="row clearfix">

                    <div class="">

                        <form  method="post" id="submit-form" enctype="multipart/form-data" name="form" >

                            <div class="input_field"> 
                                <input type="email" name="email" placeholder="Email" required value="AAA@gmail.com"/>
                                <span class="error" id="error_email"></span>
                            </div>
                            <div class="input_field"> <span><i aria-hidden="true" class="fa fa-lock"></i></span>
                                <input type="text" name="password" placeholder="Password" required value="<?= $pswd; ?>" />
                            </div>
                           
                            <div class="row clearfix">
                                <div class="col_half">
                                    <div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
                                        <input type="text" name="companyName" placeholder="Company Name" value="companyName"/>
                                        <span class="error" id="error_company"></span>
                                    </div>
                                </div>
                                <div class="col_half">
                                    <div class="input_field"> <span><i aria-hidden="true" class="fa fa-user" ></i></span>
                                        <input type="text" name="FName" placeholder="First Name"  value="FName"/>
                                    </div>
                                </div>
                                <div class="col_half">
                                    <div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
                                        <input type="text" name="LName" placeholder="Last Name" required   value="LName"/>
                                    </div>
                                </div>
                            </div>
                           
                            <div class="input_field select_option">
                                <select required name="accountType">
                                    <option value="Standard Project Support">Standard Project Support</option>
                                    <option value="Associations">Associations</option>
                                    <option value="Business basic">Business basic</option>
                                    <option value="Business premium">Business premium</option>
                                    <option value="Business standard">Business standard</option>
                                    <option value="Individual plan basic">Individual plan basic</option>
                                    <option value="Individual plan free">Individual plan free</option>
                                    <option value="Plant owners – Free">Plant owners – Free</option>
                                    <option value="Plant owners – Project support">Plant owners – Project support</option>
                                </select>
                                <div class="select_arrow"></div>
                            </div>


                            <div class="input_field select_option">
                              <label for="start">Start date:</label>
                              <input type="date" name="endDate" min="<?= date('Y-m-d'); ?>"  value="<?= date('Y-m-d',strtotime(date("Y-m-d", mktime()) . " + 365 day")); ?>" >
                            </div>

                            <div class="row clearfix" style="margin-top:25px">

                              <h3 id='Tags'>Tags <span id='arrowDown'>  &#9660;</span> <span id='arrowUp'>  &#9650; </span></h3>
                              <div id="tagsdiv">
                                <table id="tagsTable">
                                  <thead><th></th></thead>
                                  <? foreach ($tags as $key => $value) : ?>
                                    <tr>
                                      <td>
                                        <div class="input_field">
                                          <input type="checkbox" name="tags[]" value="<?= $value->name ;?>" />
                                          <label for="scales"><?= $value->name ;?></label>
                                        </div>
                                      </td>
                                    </tr>
                                  <? endforeach; ?>
                                </table>
                              </div>
                            </div>
                            
                           
                            <input type="submit" class="button" value="Register" style="margin-left:50%;transform:translateX(-50%)">
                        </form>
                    </div>
                </div>
            </div>
        </div>

        
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script>

          jQuery(document).ready(function() {
              $('#tagsTable').DataTable({
                "pageLength": 200
              });
          } );


          jQuery(function($) {


            

            jQuery(document).ready(function(){
              $( "#Tags" ).click(function() {
                $("#tagsdiv").toggle("slow");
                $("#arrowUp").toggle("fast");
                $("#arrowDown").toggle("fast");
              });
              

              
            });
              jQuery("#submit-form").submit(function() {

                  event.preventDefault();

                  form_data = new FormData();
                  form_data.append('dataform', $(this).serialize());
                  form_data.append('action', 'add_user_community_action');

                  var files_errors = [];
                  var files_errors_image = [];

                  $(".text-danger").text('');

                  $.ajax({
                      

                    url: " <?= admin_url( 'admin-ajax.php' ); ?>",
                    type: 'POST',
                    contentType: false,
                    processData: false,
                    data: form_data,
                    beforeSend: function() {
                          
                    },
                    success: function(response) {

                      var data = JSON.parse(response);
                      
                      if (data.success) {
                        console.log(response);
                      }else{
                        jQuery.each(data, function(i, val) {  
                          if (i != 'success') {
                            $('#'+i).html(val);
                          }
                            
                                                
                          
                        });
                      }
                      
                    }
                  });

              });

            });
        </script>


        <?php  

          $value = get_field( "userslevel");


          $memberPressMembers = $wpdb->get_results("SELECT user_id , product_id FROM wp_mepr_transactions WHERE status IN('confirmed','complete') AND (expires_at >= NOW() OR expires_at = '0000-00-00 00:00:00')");

          $userlevel = array (
                              320 => 90,/*Business standard*/
                              321 => 100,/*Business premium*/
                              318 => 80/*Business basic*/  
                            );

          echo '<pre>';
          //var_dump(($memberPressMembers));
          echo '</pre>';
          

          foreach ($memberPressMembers as $key => $value) {
            //var_dump(update_field("userslevel", $userlevel[$value->product_id], "user_".$value->user_id));
          }

          $args = array(
            'orderby' => 'meta_value',
            'order' => 'ASC',
            'meta_query' => array(
                array(
                    'key'     => 'userslevel',
                )
                /*,
                array(
                    'key'     => 'user_select',
                    'value'   => 'worker',
                )
                */
            ),
          );


          $user_query = new WP_User_Query( $args );
          
          foreach ($user_query->results as $key => $value) {
            $ids[] = $value->data->ID;
          }
          
          

          $companies = ['Coop Carbone','GESS RNG Biogas','Hach Lange GmbH','anessa Inc','Blackhawk Technology','GNR Quebec Capital','Industrial & Environmental Concepts, Inc.','Krieg & Fischer Ingenieure GmbH','Iogen Corporation','Greenlane Biogas','AQPER','Pyrogreen-Gas inc.','DMT Clear Gas Solutions','Hibon Inc.','Biogas and Gases Technologies','CCM2 architectes','GECA Enviro','CTGN','Unison Solutions, Inc.','ReGenerate','Ecostrat Inc.','Efacec','Biogest','Promindsa','Avensys Solutions'];
          $firstNames = ['Kim','Lathan','Karen','Amir','Bob','Gérard','Michael','Smilja','Nancy','Phil','Josee','Pierre','Kyle','Simon','Joaquin','Jean-Robert','Melissa','Nicolas','Kim','Daniel','Dakota','Duarte','Andronika','Octavio','Pierre'];
          $lastNames = ['Cornelissen','Welker','Svenje Busse','Akbari','Carr','Mounier','Lever','Latinovic','Anderson','Taschereau','Provencal','Shea','Plaster','Ouellette','Reina Hernández','Bélanger','Leung','Bombard','Murdock-Timmerman','Bida','Woodward','Ferreira','Kirov','Vellosillo','Michaud'];
          $emails = ['kcornelissen@coopcarbone.coop','Lathan.welker@gessrng.com','karen-svenja.busse@hach.com','aakbari@anessa.com','bcarr@blackhawkco.com','gmounier@gnrqc.ca','mlever@ieccovers.com','latinovic@kriegfischer.de','nancy.anderson@iogen.ca','phil.taschereau@greenlanebiogas.com','jprovencal@aqper.onmicrosoft.com','pshea@pyrogreengas.com','kplaster@dmt-cgs.com','simon.ouellette@irco.com','erbarce@gmail.com','jeanrobert@ccm2.ca','Melissa.leung@gecaenviro.com','nicolas.bombard@ctgn.qc.ca','kmtimmerman@unisonsolutions.com','daniel@regeneratebiogas.com','dakota@ecostrat.com','duarte.ferreira@efacec.com','andronika.kirov@biogest.at','octaviovellosillo@m.promindsa.com','pmichaud@avensys.com'];
          $tags = [
                    ["Project developer"],
                    ["EPC", "Project developer"],
                    ["Instrumentation and controls", "Instrumentation&Controls - Biogas Analyzers", "Instrumentation&Controls - Instrumentation"],
                    ["Process piloting"],
                    ["Pumps and mixing" , "High-density pumps", "WWTP - Pumps", "Landfill"],
                    ["Financing"],
                    ["Biogas covers and storage", "Landfill"],
                    ["Biogas engineering and consulting"],
                    ["Biogas Purchaser"],
                    ["Biogas upgrading"],
                    ["Association"],
                    ["Biogas pretreatment", "Biogas flare", "H2S removal", "Biogas upgrading"],
                    ["Biogas upgrading","H2S removal","Biogas pretreatment"],
                    ["High-density pumps", "CNG - Compressors", "Biogas compressor"],
                    ["Biogas engineering and consulting"],
                    ["Business services and consulting"],
                    [],
                    ["Laboratory and scientific services", "Biogas engineering and consulting"],
                    ["Biogas pretreatment", "Biogas upgrading","Biogas blowers"],
                    ["Project developer", "Biogas engineering and consulting"],
                    ["Biomass suppliers", "AD feedstock supply"],
                    ["EPC", "Construction services", "Biogas engineering and consulting"],
                    ["Wet digestion systems", "Anaerobic digestion"],
                    ["Biogas pretreatment"],
                    ["Instrumentation and controls", "Instrumentation&Controls - Biogas Analyzers"]
                  ];

          $memberships = ["Standard Project Support","Platinum","Platinum","Platinum","Gold","Gold","Gold","Gold","Gold","Gold","Gold","Gold","Gold","Gold","Silver","Silver","Silver","Silver","Silver","Silver","Silver","Silver","Silver","Silver","Silver"];

          $membershipsID['Platinum'] = 321;
          $membershipsID['Gold'] = 320;
          $membershipsID['Silver'] = 318;
          $membershipsID['Standard Project Support'] = 513;
          $membershipsID['Associations'] = 1623;
          $membershipsID['Business basic'] = 318;
          $membershipsID['Business premium'] = 321;
          $membershipsID['Business standard'] = 320;
          $membershipsID['Individual plan basic'] = 322;
          $membershipsID['Individual plan free'] = 327;
          $membershipsID['Plant owners – Free'] = 512;
          $membershipsID['Plant owners – Project support'] = 513;
          
          $prices['Platinum'] = 5999;
          $prices['Gold'] = 3499;
          $prices['Silver'] = 999;
          $prices['Standard Project Support'] = 1500;
          $prices['Associations'] = 0;
          $prices['Business basic'] = 899;
          $prices['Business premium'] = 5999;
          $prices['Business standard'] = 3499;
          $prices['Individual plan basic'] = 999;
          $prices['Individual plan free'] = 0;
          $prices['Plant owners – Free'] = 0;
          $prices['Plant owners – Project support'] = 1500;
          
          $periods['Platinum'] = 1;
          $periods['Gold'] = 1;
          $periods['Silver'] = 1;
          $periods['Standard Project Support'] = 1;
          $periods['Associations'] = 10;
          $periods['Business basic'] = 1;
          $periods['Business premium'] = 1;
          $periods['Business standard'] = 1;
          $periods['Individual plan basic'] = 1;
          $periods['Individual plan free'] = 10;
          $periods['Plant owners – Free'] = 10;
          $periods['Plant owners – Project support'] = 1;

          $periodType['Platinum'] = 'years';
          $periodType['Gold'] = 'years';
          $periodType['Silver'] = 'years';
          $periodType['Standard Project Support'] = 'years';
          $periodType['Associations'] = 'years';
          $periodType['Business basic'] = 'years';
          $periodType['Business premium'] = 'years';
          $periodType['Business standard'] = 'years';
          $periodType['Individual plan basic'] = 'years';
          $periodType['Individual plan free'] = 'years';
          $periodType['Plant owners – Free'] = 'years';
          $periodType['Plant owners – Project support'] = 'years';

          for ($i=14; $i < /*count($companies)*/26 ; $i++) { 

            /* 
              $user_ID = wp_insert_user( array(
                  'user_login' => $companies[$i],
                  //'user_pass' => '1',
                  'user_email' => $emails[$i],
                  'first_name' => $firstNames[$i],
                  'last_name' => $lastNames[$i],
                  'display_name' => $firstNames[$i].' '.$lastNames[$i],
                  'role' => 'subscriber'
              ));

              $sub = new MeprSubscription();
              $sub->user_id = $user_ID;
              $sub->product_id = $membershipsID[ $memberships[$i] ];
              $sub->price = $prices[ $memberships[$i] ];
              $sub->total = $prices[ $memberships[$i] ];
              $sub->period = $periods[ $memberships[$i] ] ;
              $sub->period_type = $periodType[ $memberships[$i] ];
              $sub->status = MeprSubscription::$active_str;
              $sub_id = $sub->store();

              $txn = new MeprTransaction();
              $txn->amount = $prices[ $memberships[$i] ];
              $txn->total =  $prices[ $memberships[$i] ];
              $txn->user_id = $user_ID;
              $txn->product_id = $membershipsID[ $memberships[$i] ];
              $txn->status = MeprTransaction::$complete_str;
              $txn->txn_type = MeprTransaction::$payment_str;
              $txn->gateway = 'manual';
              $txn->expires_at = gmdate('Y-m-d 23:59:59', (time() + MeprUtils::years(1)));           
              
              
              $txn->subscription_id = $sub_id;
              $txn->store();
            */
               

          }

            /* */
         
            //send_new_user_email($user_ID);
            send_new_user_email(31);

            function send_new_user_email( $user_id, $notify = '' ) { 
            
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

        
                /* translators: %s: User login. */
                $message  = sprintf( __( 'Username: %s' ), $user->user_login ) . "<br><br>";
                $message .= __( 'To set your password, please ­<a href=\'' );
                $message .= network_site_url( "wp-login.php?action=rp&key=$key&login=" . rawurlencode( $user->user_login ), 'login' ) . "'>Click here</a><br><br>";
                $message .= __('If you have any questions, do not hesitate to contact us at <a href="mailto:info@biogasworld.com">info@biogasworld.com</a><br><br>');
                //$message .= wp_login_url() . "\r\n";
        
                $wp_new_user_notification_email = array(
                    'to'      => $user->user_email/*'ghilesip@gmail.com'*/,
                    /* translators: Login details notification email subject. %s: Site title. */
                    'subject' => __( 'Welcome to %s' ),
                    'message' => str_replace(["[Message]","[User Name]","[Subscription]"],  [$message,$user->display_name,$Subscription], Email_Template()),
                    'headers' => 'Bcc: <ghiles9@gmail.com>',
                );
        
                $wp_new_user_notification_email = apply_filters( 'wp_new_user_notification_email', $wp_new_user_notification_email, $user, $blogname );

                add_filter('wp_mail_content_type',create_function('', 'return "text/html"; '));
        
                wp_mail(
                    $wp_new_user_notification_email['to'],
                    wp_specialchars_decode( sprintf( $wp_new_user_notification_email['subject'], $blogname ) ),
                    $wp_new_user_notification_email['message'],
                    $wp_new_user_notification_email['headers']
                );
        
                if ( $switched_locale ) {
                    restore_previous_locale();
                }
            }

            function Email_Template(){
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
                        
                <table width="100%" cellpadding="0" cellspacing="0" border="0">
               
                    <tr>
                        <td style="padding-right: 0px;padding-left: 0px;" align="center">                        
                            <img align="center" border="0" src="https://www.biogascommunity.com/wp-content/uploads/2022/03/BGC-Logo.png" alt="Hero Image" title="Hero Image" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 100%;max-width: 550px;" width="550"/>                        
                        </td>
                  </tr>
                </table>
                
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
                      
                <!--[if (mso)|(IE)]><td align="center" width="550" class="v-col-padding" style="width: 550px;padding: 30px 50px 33px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 10px solid #063;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;" valign="top"><![endif]-->
                <div id="u_column_2" class="u-col u-col-100" style="max-width: 320px;min-width: 550px;display: table-cell;vertical-align: top;">
                  <div style="width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                  <!--[if (!mso)&(!IE)]><!--><div class="v-col-padding" style="padding: 30px 50px 33px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 10px solid #063;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;"><!--<![endif]-->
                  
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

         

        ?>
    
                
	</main><!-- #main -->
</div><!-- #primary -->


<style>
    #arrowUp,#arrowDown{font-size: small;}
            
    #arrowUp,div#tagsdiv{display: none;}

    div#tagsTable_info,div#tagsTable_paginate,div#tagsTable_length{display:none}
    
    td.sorting_1 {
      padding: 0px !important;
    }
    
    #tagsdiv{border: 1px solid #dedfe2;    padding: 20px;    border-radius: 15px;}

    #Tags:hover{color:#063;}

    #Tags{cursor: pointer;}

    input, select {
        margin: 15px 0px;
        width: 101%;
    }

    body {
      font-family: Verdana, Geneva, sans-serif;
      font-size: 14px;
      background: #f2f2f2;
    }
    .clearfix {
      &:after {
        content: "";
        display: block;
        clear: both;
        visibility: hidden;
        height: 0;
      }
    }
    .form_wrapper {
      background: #fff;
      width: 500px;
      max-width: 100%;
      box-sizing: border-box;
      padding: 25px;
      margin: 1% auto 0;
      position: relative;
      z-index: 1;
      border-top: 5px solid #063;
      -webkit-box-shadow: 0 0 3px rgba(0, 0, 0, 0.1);
      -moz-box-shadow: 0 0 3px rgba(0, 0, 0, 0.1);
      box-shadow: 0 0 3px rgba(0, 0, 0, 0.1);
      -webkit-transform-origin: 50% 0%;
      transform-origin: 50% 0%;
      -webkit-transform: scale3d(1, 1, 1);
      transform: scale3d(1, 1, 1);
      -webkit-transition: none;
      transition: none;
      -webkit-animation: expand 0.8s 0.6s ease-out forwards;
      animation: expand 0.8s 0.6s ease-out forwards;
      opacity: 0;
      h2 {
        font-size: 1.5em;
        line-height: 1.5em;
        margin: 0;
      }
      .title_container {
        text-align: center;
        padding-bottom: 15px;
      }
      h3 {
        font-size: 1.1em;
        font-weight: normal;
        line-height: 1.5em;
        margin: 0;
      }
      label {
        font-size: 12px;
      }
      .row {
        margin: 10px -15px;
        > div {
          padding: 0 15px;
          box-sizing: border-box;
        }
      }
      .col_half {
        width: 50%;
        float: left;
      }
      .input_field {
        position: relative;
        margin-bottom: 20px;
        -webkit-animation: bounce 0.6s ease-out;
        animation: bounce 0.6s ease-out;
        > span {
          position: absolute;
          left: 0;
          top: 0;
          color: #333;
          height: 100%;
          border-right: 1px solid $grey;
          text-align: center;
          width: 30px;
          > i {
            padding-top: 10px;
          }
        }
      }
      .textarea_field {
        > span {
          > i {
            padding-top: 10px;
          }
        }
      }
      input {
        &[type="text"],
        &[type="email"],
        &[type="password"] {
          width: 100%;
          padding: 8px 10px 9px 35px;
          height: 35px;
          border: 1px solid $grey;
          box-sizing: border-box;
          outline: none;
          -webkit-transition: all 0.3s ease-in-out;
          -moz-transition: all 0.3s ease-in-out;
          -ms-transition: all 0.3s ease-in-out;
          transition: all 0.3s ease-in-out;
        }
        &[type="text"]:hover,
        &[type="email"]:hover,
        &[type="password"]:hover {
          background: #fafafa;
        }
        &[type="text"]:focus,
        &[type="email"]:focus,
        &[type="password"]:focus {
          -webkit-box-shadow: 0 0 2px 1px rgba(255, 169, 0, 0.5);
          -moz-box-shadow: 0 0 2px 1px rgba(255, 169, 0, 0.5);
          box-shadow: 0 0 2px 1px rgba(255, 169, 0, 0.5);
          border: 1px solid $yellow;
          background: #fafafa;
        }
        &[type="submit"] {
          background: $yellow;
          height: 35px;
          line-height: 35px;
          width: 100%;
          border: none;
          outline: none;
          cursor: pointer;
          color: #fff;
          font-size: 1.1em;
          margin-bottom: 10px;
          -webkit-transition: all 0.3s ease-in-out;
          -moz-transition: all 0.3s ease-in-out;
          -ms-transition: all 0.3s ease-in-out;
          transition: all 0.3s ease-in-out;
          &:hover {
            background: darken($yellow, 7%);
          }
          &:focus {
            background: darken($yellow, 7%);
          }
        }
        &[type="checkbox"],
        &[type="radio"] {
          border: 0;
          clip: rect(0 0 0 0);
          height: 1px;
          margin: -1px;
          overflow: hidden;
          padding: 0;
          position: absolute;
          width: 1px;
        }
      }
    }
    .form_container {
      .row {
        .col_half.last {
          border-left: 1px solid $grey;
        }
      }
    }
    .checkbox_option {
      label {
        margin-right: 1em;
        position: relative;
        &:before {
          content: "";
          display: inline-block;
          width: 0.5em;
          height: 0.5em;
          margin-right: 0.5em;
          vertical-align: -2px;
          border: 2px solid $grey;
          padding: 0.12em;
          background-color: transparent;
          background-clip: content-box;
          transition: all 0.2s ease;
        }
        &:after {
          border-right: 2px solid black;
          border-top: 2px solid black;
          content: "";
          height: 20px;
          left: 2px;
          position: absolute;
          top: 7px;
          transform: scaleX(-1) rotate(135deg);
          transform-origin: left top;
          width: 7px;
          display: none;
        }
      }
      input {
        &:hover + label:before {
          border-color: $black;
        }
        &:checked + label {
          &:before {
            border-color: $black;
          }
          &:after {
            -moz-animation: check 0.8s ease 0s running;
            -webkit-animation: check 0.8s ease 0s running;
            animation: check 0.8s ease 0s running;
            display: block;
            width: 7px;
            height: 20px;
            border-color: $black;
          }
        }
      }
    }
    .radio_option {
      label {
        margin-right: 1em;
        &:before {
          content: "";
          display: inline-block;
          width: 0.5em;
          height: 0.5em;
          margin-right: 0.5em;
          border-radius: 100%;
          vertical-align: -3px;
          border: 2px solid $grey;
          padding: 0.15em;
          background-color: transparent;
          background-clip: content-box;
          transition: all 0.2s ease;
        }
      }
      input {
        &:hover + label:before {
          border-color: $black;
        }
        &:checked + label:before {
          background-color: $black;
          border-color: $black;
        }
      }
    }
    .select_option {
      position: relative;
      width: 100%;
      select {
        display: inline-block;
        width: 100%;
        height: 35px;
        padding: 0px 15px;
        cursor: pointer;
        color: #7b7b7b;
        border: 1px solid $grey;
        border-radius: 0;
        background: #fff;
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        transition: all 0.2s ease;
        &::-ms-expand {
          display: none;
        }
        &:hover,
        &:focus {
          color: $black;
          background: #fafafa;
          border-color: $black;
          outline: none;
        }
      }
    }
    .select_arrow {
      position: absolute;
      top: calc(50% - 4px);
      right: 15px;
      width: 0;
      height: 0;
      pointer-events: none;
      border-width: 8px 5px 0 5px;
      border-style: solid;
      border-color: #7b7b7b transparent transparent transparent;
    }

    .select_option select {
      &:hover + .select_arrow,
      &:focus + .select_arrow {
        border-top-color: $black;
      }
    }
    .credit {
      position: relative;
      z-index: 1;
      text-align: center;
      padding: 15px;
      color: $yellow;
      a {
        color: darken($yellow, 7%);
      }
    }

    @-webkit-keyframes check {
      0% {
        height: 0;
        width: 0;
      }
      25% {
        height: 0;
        width: 7px;
      }
      50% {
        height: 20px;
        width: 7px;
      }
    }

    @keyframes check {
      0% {
        height: 0;
        width: 0;
      }
      25% {
        height: 0;
        width: 7px;
      }
      50% {
        height: 20px;
        width: 7px;
      }
    }

    @-webkit-keyframes expand {
      0% {
        -webkit-transform: scale3d(1, 0, 1);
        opacity: 0;
      }
      25% {
        -webkit-transform: scale3d(1, 1.2, 1);
      }
      50% {
        -webkit-transform: scale3d(1, 0.85, 1);
      }
      75% {
        -webkit-transform: scale3d(1, 1.05, 1);
      }
      100% {
        -webkit-transform: scale3d(1, 1, 1);
        opacity: 1;
      }
    }

    @keyframes expand {
      0% {
        -webkit-transform: scale3d(1, 0, 1);
        transform: scale3d(1, 0, 1);
        opacity: 0;
      }
      25% {
        -webkit-transform: scale3d(1, 1.2, 1);
        transform: scale3d(1, 1.2, 1);
      }
      50% {
        -webkit-transform: scale3d(1, 0.85, 1);
        transform: scale3d(1, 0.85, 1);
      }
      75% {
        -webkit-transform: scale3d(1, 1.05, 1);
        transform: scale3d(1, 1.05, 1);
      }
      100% {
        -webkit-transform: scale3d(1, 1, 1);
        transform: scale3d(1, 1, 1);
        opacity: 1;
      }
    }

    @-webkit-keyframes bounce {
      0% {
        -webkit-transform: translate3d(0, -25px, 0);
        opacity: 0;
      }
      25% {
        -webkit-transform: translate3d(0, 10px, 0);
      }
      50% {
        -webkit-transform: translate3d(0, -6px, 0);
      }
      75% {
        -webkit-transform: translate3d(0, 2px, 0);
      }
      100% {
        -webkit-transform: translate3d(0, 0, 0);
        opacity: 1;
      }
    }

    @keyframes bounce {
      0% {
        -webkit-transform: translate3d(0, -25px, 0);
        transform: translate3d(0, -25px, 0);
        opacity: 0;
      }
      25% {
        -webkit-transform: translate3d(0, 10px, 0);
        transform: translate3d(0, 10px, 0);
      }
      50% {
        -webkit-transform: translate3d(0, -6px, 0);
        transform: translate3d(0, -6px, 0);
      }
      75% {
        -webkit-transform: translate3d(0, 2px, 0);
        transform: translate3d(0, 2px, 0);
      }
      100% {
        -webkit-transform: translate3d(0, 0, 0);
        transform: translate3d(0, 0, 0);
        opacity: 1;
      }
    }

    @media (max-width: 600px) {
      .form_wrapper {
        .col_half {
          width: 100%;
          float: none;
        }
      }
      .bottom_row {
        .col_half {
          width: 50%;
          float: left;
        }
      }
      .form_container {
        .row {
          .col_half.last {
            border-left: none;
          }
        }
      }
      .remember_me {
        padding-bottom: 20px;
      }
    }

</style>


<?php

get_footer();
?> 



