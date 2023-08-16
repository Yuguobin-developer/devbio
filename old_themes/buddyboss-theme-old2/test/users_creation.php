<?php

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

        //$message .= wp_login_url() . "\r\n";

        $wp_new_user_notification_email = array(
            'to'      => 'ghilesip@gmail.com'/*$user->user_email*/,
            /* translators: Login details notification email subject. %s: Site title. */
            'subject' => __( 'Welcome to %s' ),
            'message' => str_replace(["[Message]","[User Name]","[Subscription]"],  [$message,$user->display_name,$Subscription], Email_Template()),
            'headers' => '',
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
              
        <!--[if (mso)|(IE)]><td align="center" width="550" class="v-col-padding" style="width: 550px;padding: 30px 50px 33px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 10px solid #65b87e;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;" valign="top"><![endif]-->
        <div id="u_column_2" class="u-col u-col-100" style="max-width: 320px;min-width: 550px;display: table-cell;vertical-align: top;">
          <div style="width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
          <!--[if (!mso)&(!IE)]><!--><div class="v-col-padding" style="padding: 30px 50px 33px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 10px solid #65b87e;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;"><!--<![endif]-->
          
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
                    <p style="font-size: 14px; line-height: 170%;"><span style=" font-size: 16px; line-height: 27.2px;">As an exclusive member of Biogasworld, an <span style="font-weight:bold;color:#006633">[Subscription] account</span> has been created for you on our new platform <a style="font-weight:bold;color:#006633;text-decoration: none;" href="'.network_site_url().'">BiogasCommunity</a>.<br><br> </p>
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