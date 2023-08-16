<?php
/**
 * Template name: manage subaccounts
 *
 * @package BuddyBoss_Theme
 */

get_header();
global $wpdb;
$pswd = wp_generate_password(16,1,1);?>


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
          $memberPressMembers = $wpdb->get_results("SELECT user_id , parent_transaction_id FROM wp_mepr_transactions WHERE corporate_account_id != 0 AND parent_transaction_id != 0");
        ?>

        <div class="row"    style=" margin: 50px 0px;">
            <div class="col-sm-3 select_wrapper">
                <h3>Filter by companies</h3>
                <span id="Organization"  placeholder="Organization"></span>
            </div>
        </div>

        <table id="Table">
            <thead>
              <th>Company name</th>              
              <th>Email</th>
              <th>Registred on</th>              
              <th>Parent</th>  
              <th>Parent's email</th>             
              <th>Displayed Company</th> 
              <th>Displayed on members?</th>
              <th>Update</th>
            </thead>

            <tbody >
              <?php foreach ($memberPressMembers as $value) : ?>
              
                <?php
                 

                  $parent_id = $wpdb->get_results(  "SELECT user_id FROM wp_mepr_transactions WHERE id = ".intval($value->parent_transaction_id)  );

                  $checked='';

                  if ( is_array(get_userdata( $value->user_id)->roles)) {
                    if (in_array( 'memberpress_account', get_userdata( $value->user_id)->roles )) {
                      $checked='checked';
                    }
                    
                  }
                  $displayed_name = $wpdb->get_results(  "SELECT value FROM wp_bp_xprofile_data WHERE field_id = 20 AND user_id = ".$value->user_id  )[0]->value; 
                ?>


                <?php if ( is_array(get_userdata( $value->user_id)->roles)): ?>
                  <?php if ( !in_array( 'test', get_userdata( $value->user_id)->roles )): ?>
                    
                  <?php 
                    $userLink = "https://www.biogascommunity.com/wp-admin/user-edit.php?user_id=".$value->user_id."&wp_http_referer=%2Fwp-admin%2Fusers.php%3Fs%3DWAGA%26action%3D-1%26members-bulk-users-nonce%3D77462a15d4%26members-add-role-top%26members-remove-role-top%26bp_change_type%26bp-bulk-users-change-type-nonce%3Dd005a9c200%26paged%3D1%26action2%3D-1%26members-add-role-bottom%26members-remove-role-bottom%26bp_change_type2"; 

                  ?>
                    <tr>
                      <td><a target='_blank' href="<?=$userLink;?>"><?= get_userdata( $value->user_id)->data->user_login; ?></a></td>
                      <td><?= get_userdata( $value->user_id)->data->user_email; ?></td>
                      <td><?= get_userdata( $value->user_id)->data->user_registered; ?></td>
                      <td><?= get_userdata( $parent_id[0]->user_id )->data->user_login; ?></td>
                      <td><a href="https://www.biogascommunity.com/wp-admin/user-edit.php?user_id=<?= $parent_id[0]->user_id;?>" target='_blank' ><?= get_userdata( $parent_id[0]->user_id )->data->user_email;?></a></td>
                      <td ><input type="text" id="company_name_<?=$value->user_id;?>" data-userID="<?= $value->user_id; ?>" value="<?=$displayed_name;?>"></td>
                      <td class='displayed'><input type="checkbox" id="is_displayed_<?=$value->user_id;?>" <?= $checked; ?> data-userID="<?= $value->user_id; ?>"></td>
                      <td><button id='<?= "update".$value->user_id; ?>' class='update' data-userID="<?= $value->user_id; ?>">Update</button></td>
                    </tr>
                  <?php endif; ?>  <!--    if ( !in_array( 'test', get_userdata( $value->user_id)->roles ))     -->
                <?php endif; ?>  <!--    if ( is_array(get_userdata( $value->user_id)->roles))     -->
              <?php endforeach; ?>

              
              
            </tbody>

          </table>



        <script>

          jQuery(document).ready(function() {
            
              jQuery(".update").click(function(){

              var id = jQuery(this).attr("data-userID");
              var company_name = jQuery("#company_name_"+id).val();
              var is_displayed = jQuery("#is_displayed_"+id).prop('checked');
 
              jQuery.ajax({
                url: " <?= admin_url( 'admin-ajax.php' ); ?>",
                type: "POST",
                data: {                  
                  'action': 'corporate_accounts_management',
                  'company_name' : company_name,
                  'is_displayed' : is_displayed,
                  'user_id': id
                }
              }).done(function(response) {
                console.log(response);
              });
 
            });

            jQuery('#Organization').change(function() {
                oTable.search(jQuery(this).val()).draw();
            });
            

            oTable = jQuery('#Table').DataTable({
                "pageLength": 200,
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
                            var Ids = [/*"#Year",  "#Type",*/ "#Organization","#Country"];
                            this.api().columns().every(function() {
                                var column = this;
                                if (i > 2) { /*  Colonne à laquelle commence la capture */
                                    var select = jQuery('<select class=\'form-control\' style="width:95%" ><option value=""></option></select>')
                                        .appendTo(jQuery(Ids[i - 3]).empty()) /*  Le id du span où afficher les données */
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
              } );

            } );

        </script>



	</main><!-- #main -->
</div><!-- #primary -->





<?php

//get_footer();
?> 



