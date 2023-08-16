<?php

/**
 * Template name: Payment Page
*/

get_header();

global $wpdb;

$sub_id = $_GET['sub_id'];
$signup_id = $_GET['signup_id'];
$user_email = $_GET['user_email'];

$prices = array(
                    321 => get_option('price_business-premium'), // premium business
                    320 => get_option('price_business-standard'), // standard business
                    322 => get_option('price_individual-plan-basic'), // standard business
                    318 => get_option('price_business-basic'),  // basic business
                    513 => get_option('price_plant-owners-project-support'),  // basic plant owner

                    1623 => get_option('price_association'),  // basic associations
                    512 => get_option('price_plant-owners-free'),  // plant-owners-free
                    327 => get_option('price_individual-plan-free'),  // individual-plan-free
                    9281 => get_option('price_business-standard-ex'),  // individual-plan-free
                );

?>

   

<div id="primary" class="content-area">

    <main id="main" class="site-main">

        <?php

        //var_dump($prices); exit();
            if($_GET['sub_id']){


                $YOUR_DOMAIN = 'https://www.biogascommunity.com';

                if ($prices[ $sub_id ] == "NP") {
                    
                    header("HTTP/1.1 303 See Other");
                    header("Location: " . $YOUR_DOMAIN . '/payment-success/?session_id=NPortfuq8_yr4q24r129SARwqr&signup_id='.$signup_id."&sub_id=".$sub_id);
                    
                }else{

                    require 'vendor/autoload.php';
                    // This is your test secret API key.
                    \Stripe\Stripe::setApiKey(get_option('stripe_api_key'));
    
                    header('Content-Type: application/json');
                    
                    $data = [
                        'line_items' => [[
                            'price' => $prices[$sub_id],
                            'quantity' => 1,
                        ]],
                        'mode' => 'subscription',
                        'success_url' => $YOUR_DOMAIN . '/payment-success/?session_id={CHECKOUT_SESSION_ID}',
                        'cancel_url' => $YOUR_DOMAIN,
                        'automatic_tax' => [
                            'enabled' => true,
                        ],
//                         'payment_intent_data' => [
//                             'receipt_email' => $user_email
//                         ] ,
                        "metadata" => 
                            [
                                "signup_id" => $signup_id,
                                "sub_id" => $sub_id
                            ]
                        ];
                    try {
                        $checkout_session = \Stripe\Checkout\Session::create($data);
        
                        header("HTTP/1.1 303 See Other");
                        header("Location: " . $checkout_session->url);
                    }   
                    catch(\Stripe\Exception\ApiErrorException $e)
                    {
                        var_dump($e);exit;
                    } 
    
                    
                }
            }
             
        ?>

    </main><!-- #main -->

</div><!-- #primary -->



<?php //get_sidebar(); ?>


<?php get_footer(); ?>