<?php

/**
 * Template name: Payment success
*/

get_header();


?>

<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/bgcommunity.css?id=<?php echo rand(1000,9999); ?>" />
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/bg-single.css?id=<?php echo rand(1000,9999); ?>" />

<div id="primary" class="content-area">

    <main id="main" class="site-main">
    

    <?php


        if ($_GET['session_id']) {

            if ($_GET['session_id'] == "NPortfuq8_yr4q24r129SARwqr") {
                
                $signup_id = $_GET['signup_id'];
                $sub_id = $_GET['sub_id'];
                
                global $wpdb;
                $rslt = $wpdb->get_results('SELECT * FROM `wp_mepr_signup_bgw` WHERE id='.$signup_id)[0];



                $returned = Create_User_BGW( 
                                $rslt->company_name, 
                                '1', 
                                $rslt->email , 
                                'subscriber', 
                                $rslt->first_name, 
                                $rslt->last_name, 
                                $rslt->company_name , 
                                $sub_id, 
                                date('Y-m-d', strtotime(' + 1 years')),
                                "0",
                                "0",
                                "0" , 
                                "0"
                ); 

                
            }
            else{
                $ch = curl_init();

                curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/checkout/sessions/'.$_GET['session_id']);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

                curl_setopt($ch, CURLOPT_USERPWD, get_option('stripe_api_key') . ':' . '');

                $result = curl_exec($ch);

                if (curl_errno($ch)) {
                    echo 'Error:' . curl_error($ch);
                    die();
                }

                curl_close($ch);

                $status = json_decode($result)->status;


                $signup_id = json_decode($result)->metadata->signup_id;
                $sub_id = json_decode($result)->metadata->sub_id;
                $amount_subtotal = floatval(json_decode($result)->amount_subtotal)/100;
                $amount_total = floatval(json_decode($result)->amount_total)/100;
                $amount_tax = floatval(json_decode($result)->total_details->amount_tax)/100;
                $tax_rate = $amount_tax/$amount_subtotal*100;

                if ($status == 'complete') {
                    global $wpdb;
                    $rslt = $wpdb->get_results('SELECT * FROM `wp_mepr_signup_bgw` WHERE id='.$signup_id)[0];
                }else{
                    echo "<h2 style='text-align:center'>Transaction doesn't exists</h2>";                
                    die();
                }


                $returned = Create_User_BGW( 
                                $rslt->company_name, 
                                '1', 
                                $rslt->email , 
                                'subscriber', 
                                $rslt->first_name, 
                                $rslt->last_name, 
                                $rslt->company_name , 
                                $sub_id, 
                                date('Y-m-d', strtotime(' + 1 years')),
                                $amount_subtotal,
                                $amount_total,
                                $amount_tax , 
                                $tax_rate
                ); 

            }
          
            
            $wpdb->update( 'wp_mepr_signup_bgw', array( 'process_finished' => 1 ), array( 'id' => intval($signup_id) ), array(  '%d' ), array( '%d' ) );


            echo '<h1 style="text-align: center;color: #00d37d;text-transform: uppercase;">Congratulations !</h1>';
            echo "<h2 style='text-align:center'>".$returned."</h2>";


            /* 
            echo '<pre>';
            echo '</pre>';
            */
            

        }else{
            die();
        }
        
        


        function Create_User_BGW( $username, $password, $email , $role, $first_name, $last_name, $company_name , $membership_type , $end_date, $amount_subtotal, $amount_total,$amount_tax ,  $tax_rate) {

            if ( ! username_exists( $username ) and ! email_exists ( $email ) ) {
                $user_id = wp_create_user( $username, $password, $email );
                $user = new WP_User( $user_id );
                $user->set_role( $role );
                $returned = 'User Created Successfully!'; 
            }else{
                $returned = 'This user already exists !';
                return $returned;
                die();
            }
            
            if ($returned == 'User Created Successfully!') {

                wp_update_user( array( 'ID' => $user_id, 'first_name' => $first_name, 'last_name' => $last_name) );

                global $wpdb;

                $wpdb->update( 
                'wp_users', 
                array( 
                    'display_name' => $company_name
                ), 
                array( 'ID' => intval( $user_id ) ), 
                array( 
                    '%s'
                ), 
                array( '%d' ) 
                );

                update_user_meta($user_id, 'mepr_company_name', $company_name);
                
                $returned = "Welcome to BiogasCommunity! Your payment confirmation will be sent to you via email.<br>
                The information on your membership and your plan details will be sent to your company’s main contact as specified during subscription.<br>
                If you have any questions, send us an email at <a href='mailto:info@biogasworld.com'>info@biogasworld.com</a>
                ";
            }

            $sub = new MeprSubscription();
            $sub->user_id = $user_id;
            $sub->product_id = $membership_type;
            $sub->price = $amount_subtotal;
            $sub->tax_amount = $amount_tax;
                
            $sub->tax_rate = number_format( $tax_rate , 2, '.', '');
            $sub->total = $amount_total;
            $sub->period = 1;
            $sub->period_type = 'years';
            $sub->status = MeprSubscription::$active_str;
            $sub_id = $sub->store();
            
            $txn = new MeprTransaction();
            $txn->amount = $amount_subtotal;
            $txn->total = $amount_total;
            $txn->tax_amount = $amount_tax;
            $txn->tax_rate = number_format( $tax_rate , 2, '.', '');
            $txn->user_id = $user_id;
            $txn->product_id = $membership_type;
            $txn->status = MeprTransaction::$complete_str;
            $txn->txn_type = MeprTransaction::$payment_str;
            $txn->gateway = 'manual';
            $txn->expires_at =  date('Y-m-d 23:59:59', strtotime ($end_date) );
            $txn->subscription_id = $sub_id;
            $txn->store();


            
            $userlevel = array (
                320 => 90,/*Business standard*/
                321 => 100,/*Business premium*/
                318 => 80/*Business basic*/  
            );
        

            
            update_field("userslevel", $userlevel[$membership_type], "user_".$user_id);

            $wpdb->update( 'wp_usermeta', array( 'meta_value' => 'a:2:{s:10:"subscriber";b:1;s:19:"memberpress_account";b:1;}' ), array( 'user_id' => intval($user_id),'meta_key'=>'wp_capabilities' ), array( '%s' ), array( '%d','%s' ) );


            send_welcome_email($user_id);

            return $returned;

            

        }
        
                
           
    ?>
    

    
    </main><!-- #main -->

</div><!-- #primary -->

<style>
    .site-content{
        display: flex;
        align-items: center;
        justify-content: center;
    }
    #primary{
        background: #f1f1f1;
    }
    div#breadcrumbs{
        display: none;
    }
</style>

<?php //get_sidebar(); ?>


<?php get_footer(); ?>







