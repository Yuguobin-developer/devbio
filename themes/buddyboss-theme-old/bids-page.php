<?php



/**

 * Template name: Public Bids Template

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



<script src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-grid-only@1.0.0/bootstrap.css">





<div id="primary" class="content-area">

    <main id="main" class="site-main">



        <h1><?php echo $post->post_title; ?> </h1>



        <div id="post_list" class="bids_list">

            <div class="row">
                <div class="col-sm-6">
                    <p>Keyword</p>
                    <input type="text" id='keyword' name="keyword" placeholder="Keyword" class="form-control">
                </div>

                <div class="col-sm-6">
                    <p>Main Topic</p>
                    <span id="Topic"></span>
                </div>

                <div class="col-sm-6">
                    <p>Country</p>
                    <span id="Country"></span>
                </div>

                <div class="col-sm-12" style="padding: 25px 0px 0px 0px;" >
                    <h3 >THERE ARE CURRENTLY <span id='bidsNum' style="font-weight:bold"></span> BIDS ON BIOGAS COMMUNITY</h3>
                </div>

            </div>


            <?php     

            $date_args = array(
                'post_type'   => 'bid',
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
                    <?php $k = 0; foreach ($query as $value) : ?>

                        <?php 

                        if (strtotime(get_field("closing_date", $value->ID)) >= strtotime(date('Y-m-d'))) : ?>

                            <?php $cat = get_field("category", $value->ID); $k++;
                            $category = "";

                            if (!empty($cat) > 0) { $category =  implode(",", $cat); } 
                        ?>

                            <tr>
                                <td><a href="<?= get_permalink($value->ID); ?>"><?= $value->post_title; ?></a></td>
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

                .col-sm-6 {padding: 10px;}

                .col-sm-6>p {margin-bottom: 10px;}

                thead>tr {background: #00d37d;color: white;border-radius: 67px;}

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

?>

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




