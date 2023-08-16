<?php



/**

 * Template name: Events Template

 *

 * @package BuddyBoss_Theme

 */



get_header();

global $wpdb;



$has_access = false;

if (current_user_can('editor') || current_user_can('administrator')) {

    $has_access = true;

}

$current_date = strtotime(date("Y-m-d"));

?>

<?php

$share_box = buddyboss_theme_get_option('blog_share_box');

if (!empty($share_box) && is_singular('post')) :

    get_template_part('template-parts/share');

endif;

?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-grid-only@1.0.0/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.2/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/bgcommunity.css?id=<?php echo rand(1000,9999); ?>" />
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/bg-list.css?id=<?php echo rand(1000,9999); ?>">
<script src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>



<div id="primary" class="content-area">

    <main id="main" class="site-main">

        <div class="flex grid_flex">
            <div><h1><?php echo $post->post_title; ?><sup>(<span class="no_items">0</span>)</sup> </h1></div>
            <div><a href="<?php echo site_url() . '/add-event/'; ?>" class="button ">+ Add your event</a></div>
        </div>
        <div id="post_list" class="bids_list">

            <div class="row bg_form_fields">
                <div class="col-sm-6">
                    <p>Filter by:</p>
                </div>
                <div class="col-sm-6">
                    <input type="text" id='keyword' n AMe="keyword" placeholder="Keyword" class="form-control">
                </div>
                <div class="col-sm-6 select_wrapper">
                    <span id="Country" placeholder="Country"></span>
                </div>
            </div>
            <?php $warning_message = get_field("warning_message"); if(strlen($warning_message) > 0):  ?>
            <div class="row">
                <div class="warning_message_block">
                    <div class="warning_sign">!</div>
                    <?php echo wpautop($warning_message); ?>
                </div>
            </div>
            <?php endif; ?>
            <div class="row">
                <div class="col-sm-12" style="padding: 25px 0px 0px 0px;" >
                    <h3 >THERE ARE CURRENTLY <span id='bidsNum' style="font-weight:bold"></span> EVENTS ON BIOGAS COMMUNITY</h3>
                </div>

            </div>


            <?php     

            /*
                global $wpdb;

                $sql = $wpdb->prepare( "SELECT ID FROM `wp_posts` WHERE `post_status` LIKE '%s' AND `post_type` LIKE '%s'",'publish','event' );
                $results = $wpdb->get_results( $sql );
            */
            

            ?>
 


            <?php
                     
            $date_args = array(
                'post_type'   => 'event',
                'meta_key' => 'end_date',
                'posts_per_page' => -1,
                //'orderby' => 'meta_value_num',
                'post_status' => 'publish',
                'orderby'    => array(
                    'status_clause' => 'ASC'
                ),
                'meta_query'     => array(
                    'status_clause' => array(
                        'key' => 'end_date',
                        'compare' => '>=',
                        'value' => date("Y-m-d"),
                        'type' => 'DATE'
                    ),

                    'featured_clause' => [
                        'relation'=>'OR',
                        array(
                        'key' => 'featured_event',
                        'compare' => 'NOT EXISTS'
                    ),array(
                        'key' => 'featured_event',
                        'compare' => '!=',
                        'value'=>true
                    )]
                )
            );
            $query = new WP_Query( $date_args );
            $query = $query->posts;
            $event_number = count($query);
            
            ?>


            <?php
                  
            $date_args1 = array(
                'post_type'   => 'event',
                // 'meta_key' => 'end_date',
                // 'posts_per_page' => -1,
                //'orderby' => 'meta_value_num',
                'post_status' => 'publish',
                //'order' => 'ASC',
                'meta_query'     => array(
                    //'relation' => 'OR',
                    'featured_clause' => array(
                        'key' => 'featured_event',
                        'compare' => '=',
                        'value' => true,
                    ),
                    'status_clause' => array(
                        'key' => 'end_date',
                        'compare' => '>=',
                        'value' => date("Y-m-d"),
                        'type' => 'DATE'
                    )
                ),
                'orderby'    => array(
                    'featured_clause' => 'ASC'
                )
            );
            $query1 = new WP_Query( $date_args1 );
            $query1 = $query1->posts;
            $event_number1 = count($query1);

            ?>


            <table class='sortable display responsive'  style="width:100%">

                <thead>
                    <th>Title</th>
                    <th class="nowrap">Event Date</th>
                    <th>Location</th>                    
                </thead>

                <tbody>

                    <?php $a = 0; foreach ($query1 as $value1) { ?>

                        <tr>
                            <td>    
                                <div class="contenant">
                                <span style="font-weight: bold;font-size: 20px;">★ </span> <a href="<?= $value1->guid; ?>"  style="font-weight: bold" > <?= $value1->post_title; ?></a>

                                <?php if(strlen(get_field('field_60e31b240995e',$value1->ID))>0): ?>
                                <p style="padding-top: 5px;margin-bottom: 0;">
                                    <span id="discountMsg" style="font-weight: bold">
                                        <?= get_field('field_60e31b240995e',$value1->ID); ?>
                                    </span>
                                </p>
                                <span id='br'><br><span><span class='tooltiptext' id='tooltiptext' style='display:none'><?= Texte_Brut(substr($value1->post_content, 0,200)); ?>' ...</span>
                                <?php endif; ?>
                                </div>
                            </td>
                            <td class="nowrap" style="font-weight: bold"><?= date('Y-m-d',strtotime(get_field("start_date", $value1->ID))); ?></td>
                            <td style="font-weight: bold"><?= get_field("event_location", $value1->ID); ?></td>                                
                        </tr>

                    <?php $a++;} ?>

                    <?php $k = 0; foreach ($query as $value) { ?>

                        <tr>
                            <td>    
                                <div class="contenant">
                                <a href="<?= $value->guid; ?>"   ><?= $value->post_title; ?></a>

                                <?php if(strlen(get_field('field_60e31b240995e',$value->ID))>0): ?>
                                <p style="padding-top: 5px;margin-bottom: 0;">
                                    <span id="discountMsg">
                                        <?= get_field('field_60e31b240995e',$value->ID); ?>
                                    </span>
                                </p>
                                <span id='br'><br><span><span class='tooltiptext' id='tooltiptext' style='display:none'><?= Texte_Brut(substr($value->post_content, 0,200)); ?>' ...</span>
                                <?php endif; ?>
                                </div>
                            </td>
                            <td  class="nowrap" ><?= date('Y-m-d',strtotime(get_field("start_date", $value->ID))); ?></td>
                            <td><?= get_field("event_location", $value->ID); ?></td>                                
                        </tr>

                    <?php $k++;} ?>

                </tbody>

            </table>





<script type="text/javascript">



</script>


            <script>

                jQuery(document).ready(function() {

                    $('#bidsNum').html('<?= $event_number ;?>');

                    jQuery('#keyword').keyup(function() {
                        oTable.search(jQuery(this).val()).draw();
                    });

                    oTable = $('#Tableau').DataTable({                  

                        "order": [
                            /*[0, 'desc'],*/
                            [1, "asc"]
                        ],

                        "pageLength": 50,
                        responsive: true,


                    });


                    jQuery(".contenant").hover(function(){
                        
                        console.log("AAA");
                        jQuery(this).find('span#tooltiptext').css('transition','1s');                    
                        jQuery(this).find('span#tooltiptext').toggle();

                  
                    });

                    jQuery(".contenant").mouseout(function(){
                    //jQuery(this).find('span#tooltiptext').css('display','none');
                    //jQuery(this).html(text.replace('<br>', ''));  

                    });


                    // Remonter en haut du tableau lorsque l'utilisateur change de page dans le tableau

                    /*

                    oTable.on('page.dt', function() {

                        jQuery('html, body').animate({

                            scrollTop: jQuery("#exclusivebids").offset().top

                        }, 'slow');

                    });

                    */

                });

            </script>



            <?php



            $big = 999999999; // need an unlikely integer



            ?>



        </div>

    </main><!-- #main -->

</div><!-- #primary -->



<?php //get_sidebar(); 

?>

<?php 

function Texte_Brut($Text){
    $line = strip_tags($Text);
    $line = html_entity_decode($line);
    $line = preg_replace_callback('~&#x([0-9a-f]+);~i', function($matches) { 
        return 'chr(hexdec('.$matches[1].'))';
        
    }, $line);   
    $line = preg_replace_callback('~&#([0-9]+);~', function($matches) { 
        return 'chr('.$matches[1].')';
        
    }, $line);
    $line = preg_replace('(\n|\r|\t)',' ',$line);
    $line = preg_replace('/\s\s+/', ' ', $line); 
    return $line;
  } 
  
  ?>



<?php

get_footer();

?>
<?php include(get_template_directory() . "/assets/includes/promo-footer.php");  ?>
<?php include(get_template_directory() . "/assets/includes/bg-footer.php");  ?>


<script>
    jQuery(document).ready(function(){
        updateNoItems();
        addPlaceHolders();
        
        setInterval(updateNoItems, 1000);
    });
    
    function updateNoItems(){
        var no_items = $("#bidsNum").html();
        
        jQuery('.no_items').html(no_items);
    }
    
    function addPlaceHolders(){
        var no_select = jQuery(".select_wrapper").size();
        
        for(var i = 0; i < no_select; i++){
            var select_title = jQuery(".select_wrapper:eq(" + i + ") span").attr("placeholder");
            //jQuery(".select_wrapper:eq(" + i + ") select").prepend('<option value="">' + select_title + '</option>');
            jQuery(".select_wrapper:eq(" + i + ") select option:first-child").html(select_title);
            jQuery(".select_wrapper:eq(" + i + ") select").addClass("unselected");
        }
    }
</script>



<style>.deck{display:block;padding:20px 0}.grid_2{display:grid;grid-template-columns:1fr 1fr;grid-gap:20px}.single .entry-title{margin-top:-30px}table.dataTable thead td,table.dataTable thead th{padding:25px 5px}table.dataTable tfoot th,table.dataTable thead th{font-weight:initial}table.dataTable.display tbody tr.even>.sorting_2,table.dataTable.display tbody tr.odd>.sorting_2,table.dataTable.order-column.stripe tbody tr.even>.sorting_2,table.dataTable.order-column.stripe tbody tr.odd>.sorting_2,tbody>tr>td:nth-child(2){background-color:#d2e4da}table.dataTable.display tbody tr.odd>.sorting_1,table.dataTable.order-column.stripe tbody tr.odd>.sorting_1{background-color:initial}tbody>tr,td,th{border-bottom:1px solid #063}body>tr>td:nth-child(2){background-color:#d2e4d1}.col-sm-6>input,.col-sm-6>span>select{font-size:12px;color:#063;width:100%}#Tableau_filter,#Tableau_length{display:none}@media(min-width:1200px){.col-sm-6>input::placeholder{font-size:20px}}.col-sm-6{padding:10px}.col-sm-6>p{margin-bottom:10px}thead>tr{background:#00d37d;color:#fff;border-radius:67px}td{vertical-align:revert}table.dataTable.dtr-inline.collapsed>tbody>tr>td.dtr-control:before,table.dataTable.dtr-inline.collapsed>tbody>tr>th.dtr-control:before{background-color:#000daa!important}#discountMsg{font-size:small;color:#00c67ddb;font-weight:700}span.tooltiptext{display:block;width:95%!important;background-color:rgba(0,13,170,.9);color:#fff!important;text-align:justify!important;border-radius:6px!important;padding:10px;font-size:small;font-weight:unset;position:relative!important;z-index:1!important;margin-top:1px!important}</style>