<?php



/**

 * Template name: Jobs Listing Template

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



        <h1 style="color:white"><?php echo $post->post_title; ?> </h1>



        <div id="post_list" class="bids_list" style="margin-top:70px">

            <div class="row">
                <div class="col-sm-6">
                    <p>Keyword</p>
                    <input type="text" id='keyword' name="keyword" placeholder="Keyword" class="form-control">
                </div>  

                <div class="col-sm-6">
                    <p>Job Domain</p>
                    <span id="Country"></span>
                </div>

                
                <!--
                <div class="col-sm-6">
                    <p>Main Topic</p>
                    <span id="Topic"></span>
                </div>
                -->
                <div class="col-sm-12" style="padding: 25px 0px 0px 0px;" >
                    <h3 >THERE ARE CURRENTLY <span id='bidsNum' style="font-weight:bold"></span> JOB OPPORTUNITIES ON BIOGAS COMMUNITY</h3>
                </div>

            </div>


            <?php     

            $date_args = array(
                'post_type'   => 'career_jobs',
                'meta_key' => 'deadline_to_apply',
                'posts_per_page' => -1,
                'orderby' => 'meta_value_num',
                'post_status' => 'publish',
                'order' => 'ASC',
                'meta_query'=> array(
                    array(
                    'key' => 'deadline_to_apply',
                    'compare' => '>=',
                    'value' => date("Y-m-d"),
                    'type' => 'DATE'
                    )
                ),
            );
            $query = new WP_Query( $date_args );






            $query = $query->posts;


            




            ?>



            <?php

                
                

            ?>

            <table class='sortable display responsive' id='Tableau' style="width:100%">

                <thead>
                    <th class='first_column'></th>
                    <th>Title</th>
                    <th>Job Domain</th>
                    <th>Location</th>
                    <th>End Date</th>
                </thead>

                <tbody>
                    <?php $k = 0; foreach ($query as $value) : ?>

                        <?php
                            $post_id = intval(get_post_meta( $value->ID, 'company')[0]);                
                            $post_id = intval(get_post_meta( $post_id, 'logo')[0]);
                            $logo_url = get_site_url()."/wp-content/uploads/".get_post_meta( $post_id, '_wp_attached_file')[0];
                        ?>

                        <tr>
                            <td><img src="<?=$logo_url;?>" alt="" ></td>
                            <td><a href="<?= $value->guid; ?>"><?= $value->post_title; ?></a></td>
                            <td><?= get_field("job_domain", $value->ID);   ?></td>
                            <td><?= get_field("location", $value->ID); ?></td>
                            <td  class="nowrap"><?= date('Y-m-d',strtotime(get_field("deadline_to_apply", $value->ID))); ?></td>
                        </tr>


                    <?php endforeach ?>

                </tbody>

            </table>



            <style>

                @media only screen and (min-width: 600px) {
                    .first_column{width:35px!important}
                }

                @media only screen and (max-width: 600px) {
                    .first_column{width:200px!important}
                }
                

                #Tableau_length,#Tableau_filter {display: none;}

                .col-sm-6>input,.col-sm-6>span>select {width: 100%;}

                .col-sm-6 {padding: 10px;}

                .col-sm-6>p {margin-bottom: 10px;}

                thead>tr {background: #00d37d;color: white;border-radius: 67px;}

                td {vertical-align: revert;}

                table.dataTable.dtr-inline.collapsed>tbody>tr>td.dtr-control:before, table.dataTable.dtr-inline.collapsed>tbody>tr>th.dtr-control:before {
                    background-color: #000daa!important;
                }

                #primary.content-area::before {
                    content: "";
                    width: 100vw;
                    height: 110px;
                    position: absolute;
                    top: 105px;
                    left: 0;
                    background: rgb(0,13,157);
                    background: linear-gradient(
                132deg, rgba(0,13,157,1) 0%, rgba(0,198,125,1) 100%);
                }
            </style>





            <script>

                jQuery(document).ready(function() {

                    $('#bidsNum').html('<?= count($query) ;?>');

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

                    $('#container').css( 'display', 'block' );
                    oTable.columns.adjust().draw();



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












