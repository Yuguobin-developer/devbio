<?php

/**
 * Template name: Signup
*/

get_header();

global $wpdb;

$result = $wpdb->get_results("SELECT ID,post_title FROM `wp_posts` WHERE `post_type` LIKE 'memberpressproduct'");
/* 
echo "<pre>";
var_dump(get_list_of_all_memberships());
echo "</pre>";
 */
?>








<div id="primary" class="content-area">

    <main id="main" class="site-main">

        <article  class="bp_register type-bp_register memberpressproduct type-memberpressproduct status-publish hentry default-fi">
            <div class="entry-content-wrap">
                <header class="entry-header">
                    <h1 class="entry-title"><?= $subs[ $sub_id ]['title'];  ?></h1>
                </header>
                <!-- .entry-header -->
                <div class="entry-content">
                    <div class="mp_wrapper">


                      
                    <?php
                            if($_GET['sub_id']){
                                $sub_id = $_GET['sub_id'];

                                if ( !in_array($sub_id , get_list_of_all_memberships()["ID"])) {
                                    echo "<h2>This product does not exists ! </h2>";
                                    die();
                                } 

                            }else{
                                //$sub_id = 320;
                                echo "<h2>No product selected !</h2>";
                                die();
                            
                            }
                            
                            foreach ($result as $key => $value) {
                                $subs[ $value->ID ]['title'] = $value->post_title;
                                $subs[ $value->ID ]['price'] = $wpdb->get_results(" SELECT * FROM `wp_postmeta` WHERE `post_id` = $sub_id AND `meta_key` LIKE '_mepr_product_price' ")[0]->meta_value;
                            }
                            
                        ?>


                        <form action="" method="post" id="submit-form" enctype="multipart/form-data" name="form" >

                        
                            <div class="mp-form-row mepr_bold mepr_price">
                                <label>Terms:</label>
                                <div class="mepr_price_cell">
                                    <?php setlocale(LC_MONETARY,"en_US"); ?>
                                    <input type="hidden" name="mepr_stripe_txn_amount" value="<?= floatval($subs[ $sub_id ]['price'] ); ?>"><?=  money_format("%i", floatval($subs[ $sub_id ]['price'] ))  ; ?>
                                </div>
                            </div>
                            <div class="bb-mp-checkout-details">

                                <div class="mp-form-row mepr_first_name">
                                    <div class="mp-form-label">
                                        <label>First name (main company contact):*</label>                                        
                                    </div>
                                    <input type="text" name="first_name" id="first_name" class="mepr-form-input" value="" required>
                                </div>

                                <div class="mp-form-row mepr_last_name">
                                    <div class="mp-form-label">
                                        <label>Last name (main company contact):*</label>                                        
                                    </div>
                                    <input type="text" name="last_name" id="last_name" class="mepr-form-input" value="" required>
                                </div>


                                <div class="mp-form-row mepr_username">
                                    <div class="mp-form-label">
                                        <label>Company name:*</label>                                        
                                    </div>
                                    
                                    <input type="text" name="user_login" id="user_login" class="mepr-form-input" value="" required="">
                                    <div class="mp-form-label">
                                        <label id="user_login_error" class='errors' style="color:red"></label>                                        
                                    </div>
                                </div>


                                <div class="mp-form-row mepr_email">
                                    <div class="mp-form-label">
                                        <label>Email of the main company contact:*</label>                                        
                                    </div>
                                    <input type="email" name="user_email" id="user_email" class="mepr-form-input" value="" required="">
                                    <div class="mp-form-label">
                                        <label id="user_email_error" class='errors' style="color:red"></label>                                        
                                    </div>
                                </div>


                                <div class="mp-form-row mepr_email_msg">
                                    <div class="mp-form-label">
                                        <label style="font-size: x-small;line-height: initial;">If you get the message that your email already exists, please contact us at info@biogasworld.com</label>                                        
                                    </div>
                                    
                                </div>
                                


                                <div class="mp-form-row mepr_type" >
                                    
                                    <div class="mp-form-label">
                                        <label>Subscription Type:*</label>                                        
                                    </div>

                                    <select name="sub_id" id="" required>                             
                                        <option value="<?= $sub_id ; ?>" ><?= $subs[ $sub_id ]['title']; ?></option>
                                    </select>
                                    
                                </div>
                              
                                <div class="mp-form-submit">
                                    <input type="submit" class="mepr-submit" value="Sign Up">
                                    <img src="https://www.biogascommunity.com/wp-admin/images/loading.gif" style="display: none;" class="mepr-loading-gif">                                 
                                </div>
                            </div>

                            
                        </form>

                        <div style="text-align:center">
                            <a id="backbtn" href="<?= get_permalink(443);?>"><i class="fa fa-arrow-circle-left" style="font-size: 25px;vertical-align: middle; margin-right: 10px;"></i> Go back to the list of plans</a>
                        </div>
                        

                    </div>
                </div>
                <!-- .entry-content -->
            </div>
        </article>
               
            


    </main><!-- #main -->

</div><!-- #primary -->

<script>
    jQuery("#submit-form").submit(function() {


        event.preventDefault();

        form_data = new FormData();
        form_data.append('dataform', $(this).serialize());
        form_data.append('action', 'mepr_new_signup');

        $.ajax({


            url: " <?= admin_url( 'admin-ajax.php' ); ?>",
            type: 'POST',
            contentType: false,
            processData: false,
            data: form_data,
            beforeSend: function() {
                $('.errors').html('');
            },
            success: function(response) {
                var data = JSON.parse(response)
                console.log(data);

                if(data.success){
                    var url = "<?= get_permalink(5833); ?>/?sub_id="+data.sub_id+"&signup_id="+data.signup_id+"&user_email="+data.donnes[0].user_email;                    
                    $(location).attr('href',url);
                }else{
                    $('#user_login_error').html(data.user_login_error);
                    $('#user_email_error').html(data.user_email_error);
                }
                
               
            }

        });
       
    });

</script>

<?php //get_sidebar(); ?>


<?php get_footer(); ?>




<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">



<style>
    #backbtn {
        background: #00d37d;
        border: none;
        padding: 15px 20px;
        border-radius: 25px;
        color: #fff;
    }
    #backbtn:hover {
        background: #000daa;
        cursor: pointer;
    }
    .mepr_type{
        display: none;
    }
    .entry-content-wrap {
        width:400px;
    }
    .errors{
        color:red;
    }
    .bp_register{
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .mp-form-submit{
        text-align: center;
        margin: 35px 0px;
    }

    .entry-content-wrap {
        padding: 0px;
    }
    
</style>