<?php



/**

 * Template name: Private bids Template

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







<link rel="stylesheet" href="https://cdn.datatables.net/1.11.2/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/bgcommunity.css?id=<?php echo $rand_id; ?>" />



<script src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-grid-only@1.0.0/bootstrap.css">
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/bg-list.css?id=<?php echo rand(1000,9999); ?>">





<div id="primary" class="content-area">

    <main id="main" class="site-main">



        <div class="flex grid_flex">
            <div><h1><?php echo $post->post_title; ?><sup>(<span class="no_items">0</span>)</sup> </h1></div>
            <div><a href="<?php echo site_url() . '/add-a-private-bid/'; ?>" class="button">+ Add a private bid</a></div>
        </div>



        <div id="post_list" class="bids_list">

            <div class="row bg_form_fields">
                <div class="col-sm-6">
                    <p>Filter by:</p>
                </div>
                <div class="col-sm-6">
                    <input type="text" id='keyword' name="keyword" placeholder="Keyword" class="form-control">
                </div>

                <div class="col-sm-6 select_wrapper">
                    <span id="Topic" placeholder="Topic"></span>
                </div>

                <div class="col-sm-6 select_wrapper">
                    <span id="Country" placeholder="Country"></span>
                </div>
            </div>
            <div class="row">
                <div class="line" style="padding: 25px 0px 0px 0px;" >
                    <h3 >THERE ARE CURRENTLY <span id='bidsNum' style="font-weight:bold"></span> BIDS ON BIOGAS COMMUNITY</h3>
                </div>

            </div>


            <?php     

            $date_args = array(
                'post_type'   => 'bid-private',
                'meta_key' => 'closing_date',
                'posts_per_page' => -1,
                'orderby' => 'meta_value_num',
                'post_status' => 'publish',
                'order' => 'ASC',
                'meta_query'=> array(
                    array(
                    'key' => 'closing_date',
                    'compare' => '>=',
                    'value' => date("Ymd"),
                    'type' => 'DATE'
                    )
                ),
            );
            $query = new WP_Query( $date_args );


            $date_args1 = array(
                'post_type'   => 'bid-private',
                'post_status' => 'publish',
                //'order' => 'ASC',
                'meta_query'     => array(
                    //'relation' => 'OR',
                    'featured_clause' => array(
                        'key' => 'featured_bid',
                        'compare' => '=',
                        'value' => true,
                    ),
                    'status_clause' => array(
                        'key' => 'closing_date',
                        'compare' => '>=',
                        'value' => date("Ymd"),
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


            /*
            echo '<pre>';
                var_dump($date_query->posts);
            echo '</pre>';
            
            $query = new WP_Query(array(

                'post_type' => 'bid',

                'post_status' => 'publish',

                'posts_per_page' => -1

            ));

            */



            $query = $query->posts;
            ?>

            <table class='sortable display responsive' id='Tableau' style="width:100%">

                <thead>
                    <th>Title</th>
                    <th>Main topic</th>
                    <th>Location</th>
                    <th>End Date</th>
                </thead>

                <tbody>


                    <?php $a = 0; foreach ($query1 as $value1) { ?>

                        <?php 

                        if (strtotime(get_field("closing_date", $value1->ID)) >= strtotime(date('Y-m-d'))) : ?>

                            <?php $cat = get_field("category", $value1->ID); $k++;
                            $category = "";

                            if (!empty($cat) > 0) { $category =  implode(",", $cat); } 
                        ?>

                         <tr>
                            <td><span style="font-weight: bold;font-size: 20px;">★ </span><a href="<?= $value1->guid; ?>"  style="font-weight: bold"><?= $value1->post_title; ?></a></td>
                            <td style="font-weight: bold"><?= $category; ?></td>
                            <td style="font-weight: bold"><?= get_field("location", $value1->ID); ?></td>
                            <td  style="font-weight: bold" class="nowrap"><?= date('Y-m-d',strtotime(get_field("closing_date", $value1->ID))); ?></td>
                        </tr>

                    <?php  endif; $a++;} ?>

                    <?php $k = 0; foreach ($query as $value) : ?>



                        <?php 

                        if (strtotime(get_field("closing_date", $value->ID)) >= strtotime(date('Y-m-d'))) : ?>

                            <?php $cat = get_field("category", $value->ID); $k++;
                            $category = "";

                            if (!empty($cat) > 0) { $category =  implode(",", $cat); } 
                        ?>

                            <tr>
                                <td><a href="<?= $value->guid; ?>"><?= $value->post_title; ?></a></td>
                                <td><?= $category; ?></td>
                                <td><?= get_field("location", $value->ID); ?></td>
                                <td  class="nowrap"><?= date('Y-m-d',strtotime(get_field("closing_date", $value->ID))); ?></td>
                            </tr>

                        <?php  endif ?>

                    <?php endforeach ?>

                </tbody>

            </table>



            <style>

                #Tableau_length,#Tableau_filter {display: none;}

                .col-sm-6>input,.col-sm-6>span>select {width: 100%;}
                @media(min-width: 1200px){
                    .col-sm-6>input::placeholder{font-size: 20px;}    
                }

                .col-sm-6 {padding: 10px;}

                .col-sm-6>p {margin-bottom: 10px;}

                thead>tr { color: white; border-radius: 67px;}

                td {vertical-align: revert;}

                table.dataTable.dtr-inline.collapsed>tbody>tr>td.dtr-control:before, table.dataTable.dtr-inline.collapsed>tbody>tr>th.dtr-control:before {
                    background-color: #000daa!important;
                }

            </style>





            <script>

                jQuery(document).ready(function() {

                    $('#bidsNum').html('<?= $k ;?>');

                    jQuery('#keyword').keyup(function() {
                        oTable.search(jQuery(this).val()).draw();
                    });



                    oTable = $('#Tableau').DataTable({                  

                        "order": [
                            [0, 'desc'],
                            [3, "asc"]
                        ],

                        "pageLength": 50,
                        responsive: true,
                        initComplete: function() {

                            var i = 0;

                            var Ids = ["#Topic", /* "#Type",*/ "#Country"];



                            this.api().columns().every(function() {



                                var column = this;



                                if (i > 0) {

                                    var select = $('<select class=\'form-control\' ><option value=""></option></select>')

                                        .appendTo($(Ids[i - 1]).empty())

                                        .on('change', function() {

                                            var val = $.fn.dataTable.util.escapeRegex(

                                                $(this).val()

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

get_footer();

?><?php include(get_template_directory() . "/assets/includes/promo-footer.php");  ?>
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
table.dataTable thead th, table.dataTable thead td {
padding: 25px 5px;
    
}

table.dataTable thead th, table.dataTable tfoot th{font-weight: initial;}
    

table.dataTable.display tbody tr.odd>.sorting_2, table.dataTable.order-column.stripe tbody tr.odd>.sorting_2, table.dataTable.display tbody tr.even>.sorting_2, table.dataTable.order-column.stripe tbody tr.even>.sorting_2{
    background-color: #D2E4DA;
}

table.dataTable.display tbody tr.odd>.sorting_1, table.dataTable.order-column.stripe tbody tr.odd>.sorting_1{background-color: initial;
}
body.bb-custom-typo{font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;}

tbody > tr >td:nth-child(2){background-color: #D2E4DA;}
tbody > tr{border-bottom: 1px solid #006633;}
td, th{border-bottom: 1px solid #006633;}
body > tr >td:nth-child(2){background-color: #d2E4D1;}

.col-sm-6>input, .col-sm-6>span>select{
    font-size: 12px; color: #006633;
}
</style>
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
