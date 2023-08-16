<?php
/**
 * Template name: send welcome email
 *
 * @package BuddyBoss_Theme
 */

get_header();
global $wpdb;
$pswd = wp_generate_password(16,1,1);?>

<?php 
  
?>


<style>
    div#emailsTab_length {
        display: none;
    }
    .paginate_button {
        padding: 10px;
    }
    div#emailsTab_paginate{
        text-align: center;
    }
    .green{color:green}
    .red{color:red}
</style>

<link href="https://fonts.googleapis.com/css?family=Kaushan+Script|Source+Sans+Pro" rel="stylesheet">
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.colVis.min.js"></script>

<link href="https://fonts.googleapis.com/css?family=Kaushan+Script|Source+Sans+Pro" rel="stylesheet">
<link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-grid-only@1.0.0/bootstrap.css">

<div id="primary" class="content-area">

    <main id="main" class="site-main">            

        <h1><?php echo $post->post_title; ?> </h1>   



        


        <?php
          
          $memberPressMembers = $wpdb->get_results("SELECT user_id FROM wp_mepr_transactions WHERE status IN('confirmed','complete') AND (expires_at >= NOW() OR expires_at = '0000-00-00 00:00:00')");

          
          echo '<pre>';
          //var_dump(  get_users()) ;
          echo '</pre>'; 

         
        
          
        ?>
        <h3>Filters</h3>
        <div class="grille">
            <div>
                <label>Subscription plan</label></br>
                <span id="accountType"  placeholder="accountType"></span>
            </div>
            
            
            <div>
                <label for="sendFilter">Email sent ?</label></br>
                <select  id="sendFilter" class='filtering'>
                    <option value=""></option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>            
                </select>
            </div>

            <div>
                <label for="resetFilter">Password reset ?</label></br>
                <select  id="resetFilter" class='filtering'>
                    <option value=""></option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>   
                </select>
            </div>
        </div>
        

        


          <table id="emailsTab">
            <thead>
              <th>Company name</th>              
              <th>Email</th>              
              <th>Registred on</th>      
              <th>Reseted ?</th>        
              <th>Reset date ?</th>        
              <th>Email sent?</th>              
              <th>Email Date</th>
              <th>Account Type</th>
              <th>Action Btn</th>
            </thead>

            <tbody >
                <?php foreach ($memberPressMembers as $value) : //var_dump( get_userdata( $value->user_id));?>
                <?php
                    $is_password_reset = ucwords(get_field( 'is_password_reset','user_'.strval($value->user_id)));
                    $password_reset_date = ucwords(get_field( 'password_reset_date','user_'.strval($value->user_id)));
                    $welcome_email_sent = ucwords(get_field( 'welcome_email_sent','user_'.strval($value->user_id)));
                    $welcome_email_sent_date = ucwords(get_field( 'welcome_email_sent_date','user_'.strval($value->user_id)));      
                    
                    $member = new MeprUser(); // initiate the class
                    $member->ID = $value->user_id; // if using this in admin area, you'll need this to make user id the member id
                    $account_type = $member->get_active_subscription_titles("<br/>");
                    
                    if ($is_password_reset != 'Yes') {
                        /*update_field('is_password_reset','no','user_'.$value->user_id);*/
                    }
                   
                ?>

                <?php if (get_userdata( $value->user_id)->roles ) :?>
                

                    <?php  if ( in_array( 'memberpress_account', get_userdata( $value->user_id)->roles )  && !in_array( 'test', get_userdata( $value->user_id)->roles )  && !in_array( 'employee', get_userdata( $value->user_id)->roles ) ): ?>
                                        
                        <tr>
                            <td><?= get_userdata( $value->user_id)->data->user_login; ?></td>
                            <td><?= get_userdata( $value->user_id)->data->user_email; ?></td>
                            <td><?= get_userdata( $value->user_id)->data->user_registered; ?></td>

                            <td class="<?if($is_password_reset=="no"){echo 'red';}else{echo 'green';}?>" ><?= $is_password_reset; ?></td>
                            <td ><?= $password_reset_date  ?></td>

                            <td class='YesNo_<?= $value->user_id; ?>'><?=$welcome_email_sent ; ?></td>
                            <td class='EmailDate_<?= $value->user_id; ?>'><?= $welcome_email_sent_date; ?></td>

                            <td><?= $account_type; ?></td>
                            
                            <td><button id='<?= "send_email_".$value->user_id; ?>' class='send_email' data-userID="<?= $value->user_id; ?>">Send</button></td>
                        </tr>
                    <?php endif; ?>

                <?php endif; ?>
              <?php endforeach; ?>

              
              
            </tbody>
          </table>

            <?php
                /* echo '<pre>';
                var_dump($account_type);
                echo '</pre>'; */
            ?>


        <script>

          jQuery(document).ready(function() {

            jQuery(".send_email").click(function(){

              var id = jQuery(this).attr("data-userID");

              jQuery.ajax({
                url: " <?= admin_url( 'admin-ajax.php' ); ?>",
                type: "POST",
                data: {
                  'action': 'send_wlcm_email',
                  'user_id': id
                }
              }).done(function(response) {
                var data = JSON.parse(response);
                
                if (data.success) {
                  jQuery('.YesNo_'+id).html('<span style="color:green">Yes</span>');
                  jQuery('.EmailDate_'+id).html('<?= date("Y-m-d H:i:s");?>');
                }
              });

            });



            var oTable =   $('#emailsTab').DataTable({
                "pageLength": 200,   
                "order": [[ 2, "desc" ]],             
                'rowCallback': function(row, data, index){                
                  if(data[5] == 'No'){
                      $(row).find('td:eq(5)').css('color', 'red');
                  }
                  if(data[5] == 'Yes'){
                      $(row).find('td:eq(5)').css('color', 'green');
                  }
                },
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    'colvis'
                ],
                initComplete: function() {
                            var i = 0;
                            var Ids = [/*"#Year",  "#Type",*/ "#accountType","#Country"];
                            this.api().columns().every(function() {
                                var column = this;
                                if (i > 6) { /*  Colonne à laquelle commence la capture */
                                    var select = jQuery('<select><option value=""></option></select>')
                                        .appendTo(jQuery(Ids[i - 7]).empty()) /*  Le id du span où afficher les données */
                                        .on('change', function() {
                                            var val = jQuery.fn.dataTable.util.escapeRegex(
                                                jQuery(this).val()
                                            );
                                            column
                                                .search(val ? '^' + val + '$' : '', true, false)
                                                .draw();
                                        });
                                    column.data().unique().sort().each(function(d, j) {
                                        select.append('<option value="' + d + '">' + d + '</option>')
                                    });
                                }

                                i = i + 1;
                            });
                        }
              });

              $('.filtering').change(function (e) { 
                  e.preventDefault();
                  let sendFilter = $('#sendFilter').val();
                  let resetFilter = $('#resetFilter').val();

                  oTable.columns(5).search(sendFilter).draw();
                  oTable.columns(3).search(resetFilter).draw();
              });


          } );

        </script>



	</main><!-- #main -->
</div><!-- #primary -->

<style>
    .grille {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 25px;
        padding: 50px 0px;
        text-align: center;
        margin-bottom: 50px;
        border: 1px solid #dedfe2;
        border-radius: 17px;
    }
     input[type=search] {
  
        padding-left: 2rem!important;
    }
</style>

<?php

get_footer();
?> 



