<?php



/**

 * Template name: Under construction Template

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







<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/bgcommunity.css?id=<?php echo rand(1000,9999); ?>" />



<script src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-grid-only@1.0.0/bootstrap.css">
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/bg-list.css?id=<?php echo rand(1000,9999); ?>">





<div id="primary" class="content-area">

    <main id="main" class="site-main">
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/unauthorized.css?id=<?php echo rand(1000,9999); ?>" /><?php
    $auth_text_blocks = get_field("text_block"); 
?>
<div class="unauthorized_box">
    <div class="grid grid_1_1">
        <div>
            <div class="box khaki_green warning">
                <?php echo wpautop($auth_text_blocks[0]['text']); ?>
                <div class="warning_sign">!</div>
            </div>
            
        </div>
        
    </div>
</div>
    </main><!-- #main -->

</div><!-- #primary -->



<?php //get_sidebar(); 

?>



<?php

get_footer();

?>

<?php include(get_template_directory() . "/assets/includes/bg-footer.php");  ?>

<style>

    .deck {

        display: block;

        padding: 20px 0;

    }



    .grid_2 {

        display: grid;

        grid-template-columns: 1fr 1fr;

        grid-gap: 20px;

    }



    .single .entry-title {

        margin-top: -30px;



    }

</style>
<style>

                #Tableau_length,#Tableau_filter {display: none;}

                .col-sm-6>input,.col-sm-6>span>select {width: 100%;}

                .col-sm-6 {padding: 10px;}

                .col-sm-6>p {margin-bottom: 10px;}

                thead>tr {background: #006633;color: white;border-radius: 67px;}

                td {vertical-align: revert;}

                table.dataTable.dtr-inline.collapsed>tbody>tr>td.dtr-control:before, table.dataTable.dtr-inline.collapsed>tbody>tr>th.dtr-control:before {
                    background-color: #000daa!important;
                }
table.dataTable thead th, table.dataTable thead td {
padding: 25px 5px;
    
}

table.dataTable thead th, table.dataTable tfoot th{font-weight: initial;}
    

table.dataTable.display tbody tr.odd>.sorting_2, table.dataTable.order-column.stripe tbody tr.odd>.sorting_2, table.dataTable.display tbody tr.even>.sorting_2, table.dataTable.order-column.stripe tbody tr.even>.sorting_2{
    background-color: #D2E4DA;
}

table.dataTable.display tbody tr.odd>.sorting_1, table.dataTable.order-column.stripe tbody tr.odd>.sorting_1{background-color: initial;

body.bb-custom-typo{font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;}

tbody > tr >td:nth-child(2){background-color: #D2E4DA;}
tbody > tr{border-bottom: 1px solid #006633;}
td, th{border-bottom: 1px solid #006633;}
body > tr >td:nth-child(2){background-color: #d2E4D1;}


</style>
















