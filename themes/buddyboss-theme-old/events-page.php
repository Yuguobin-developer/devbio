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
<script src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>



<div id="primary" class="content-area">

    <main id="main" class="site-main">

        <h1><?php echo $post->post_title; ?> </h1>

        <div id="post_list" class="bids_list">

            <div class="row">

                <div class="col-sm-6">
                    <p>Keyword</p>
                    <input type="text" id='keyword' n AMe="keyword" placeholder="Keyword" class="form-control">
                </div>

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

            
            $aaaaaaa = [
            
                ["389" ,"2021-08-02","NO", "NA"	,"9:00 AM","5:00 PM"],
                ["509" ,"2021-09-01","YES", 	"2021-09-02",	"NA"	,"NA"],
                ["739" ,"2022-05-30","YES", 	"2022-06-03",	"NA"	,"NA"],
                ["742" ,"2021-09-20","YES", 	"2021-09-23",	"NA"	,"NA"],
                ["745" ,"2021-09-22","YES", 	"2021-09-23",	"NA"	,"NA"],
                ["748" ,"2021-09-22","YES", 	"2021-09-24",	"NA"	,"NA"],
                ["751" ,"2021-09-08","YES", 	"2021-09-09",	"NA"	,"NA"],
                ["754" ,"2021-10-27","YES", 	"2021-10-28",	"NA"	,"NA"],
                ["760" ,"2021-09-29","YES", 	"2021-09-30",	"NA"	,"NA"],
                ["763" ,"2021-12-15","YES", 	"2021-12-17",	"NA"	,"NA"],
                ["766" ,"2021-10-19","NO", "NA"	,"6:00 PM","7:00 PM"],
                ["769" ,"2021-10-05","YES", 	"2021-10-28",	"NA"	,"NA"],
                ["772" ,"2021-10-19","YES", 	"2021-11-04",	"NA"	,"NA"],
                ["775" ,"2022-01-10","YES", 	"2022-01-11",	"NA"	,"NA"],
                ["784" ,"2022-03-14","YES", 	"2022-03-16",	"NA"	,"NA"],
                ["791" ,"2021-09-23","NO", "NA"	,"9:00 AM","7:00 PM"],
                ["794" ,"2021-10-13","YES", 	"2021-10-14",	"NA"	,"NA"],
                /*["797" ,"1970-01-01","NO", "NA"	,"9:00 AM","7:00 PM"],*/
                ["800" ,"2021-09-21","NO", "NA" ,"0:00 AM","2:30 PM"],
                ["803" ,"2022-02-07","YES", 	"2022-02-08",	"NA"	,"NA"],
                ["806" ,"2022-01-26","YES", 	"2022-01-27",	"NA"	,"NA"],
                ["809" ,"2022-01-21","YES", 	"2022-01-22",	"NA"	,"NA"],
                ["812" ,"2021-09-22","YES", 	"2021-09-23",	"NA"	,"NA"],
                ["815" ,"2021-09-22","YES", 	"2021-09-23",	"NA"	,"NA"],
                ["818" ,"2022-03-15","YES", 	"2022-03-16",	"NA"	,"NA"],
                ["821" ,"2021-10-19","YES", 	"2021-10-20",	"NA"	,"NA"],
                ["824" ,"2021-10-16","YES", 	"2021-10-20",	"NA"	,"NA"],
                ["827" ,"2021-11-02","YES", 	"2021-11-05",	"NA"	,"NA"],
                ["830" ,"2022-04-12","YES", 	"2022-04-13",	"NA"	,"NA"],
                ["833" ,"2021-11-09","YES", 	"2021-11-10",	"NA"	,"NA"],
                ["836" ,"2022-02-23","YES", 	"2022-02-24",	"NA"	,"NA"],
                ["839" ,"2021-09-28","YES", 	"2021-09-29",	"NA"	,"NA"],
                ["842" ,"2021-09-13","YES", 	"2021-09-15",	"NA"	,"NA"],
                ["845" ,"2021-11-15","NO", "NA"	,"9:00 AM","7:00 PM"],
                ["848" ,"2022-01-26","YES", 	"2022-01-29",	"NA"	,"NA"],
                ["851" ,"2021-09-13","YES", 	"2021-09-14",	"NA"	,"NA"],
                ["854" ,"2022-03-14","YES", 	"2022-03-16",	"NA"	,"NA"],
                ["857" ,"2021-10-12","YES", 	"2021-10-15",	"NA"	,"NA"],
                ["860" ,"2021-10-11","YES", 	"2021-10-15",	"NA"	,"NA"],
                ["869" ,"2021-09-09","NO", "NA"	,"9:00 AM","7:00 PM"],
                ["872" ,"2021-10-12","YES", 	"2021-10-20",	"NA"	,"NA"],
                ["875" ,"2021-12-09","YES", 	"2021-12-10",	"NA"	,"NA"],
                ["878" ,"2022-03-15","YES", 	"2022-03-17",	"NA"	,"NA"],
                ["881" ,"2021-09-21","YES", 	"2021-09-23",	"NA"	,"NA"],
                ["884" ,"2021-09-14","YES", 	"2021-09-15",	"NA"	,"NA"],
                ["887" ,"2021-09-21","YES", 	"2021-09-23",	"NA"	,"NA"],
                ["890" ,"2021-12-13","YES", 	"2021-12-16",	"NA"	,"NA"],
                ["893" ,"2021-09-29","YES", 	"2021-09-30",	"NA"	,"NA"],
                ["896" ,"2021-09-21","YES", 	"2021-09-23",	"NA"	,"NA"],
                ["899" ,"2021-11-24","YES", 	"2021-09-25",	"NA"	,"NA"],
                ["902" ,"2022-02-17","NO", "NA"	,"9:00 AM","7:00 PM"],
                ["905" ,"2021-11-30","NO", "NA"	,"9:00 AM","7:00 PM"],
                ["908" ,"2021-09-30","NO", "NA"	,"9:00 AM","7:00 PM"],
                ["911" ,"2021-09-30","NO", "NA"	,"9:00 AM","7:00 PM"],
                ["914" ,"2021-09-21","YES", 	"2021-09-23",	"NA"	,"NA"],
                ["917" ,"2021-09-15","YES", 	"2021-09-17",	"NA"	,"NA"],
                ["920" ,"2021-10-05","YES", 	"2021-10-06",	"NA"	,"NA"],
                ["923" ,"2021-09-13","YES", 	"2021-09-15",	"NA"	,"NA"],
                ["926" ,"2021-10-27","YES", 	"2021-10-28",	"NA"	,"NA"],
                ["929" ,"2021-10-05","YES", 	"2021-10-06",	"NA"	,"NA"],
                ["932" ,"2021-10-26","YES", 	"2021-10-27",	"NA"	,"NA"],
                ["935" ,"2021-12-13","YES", 	"2021-12-16",	"NA"	,"NA"],
                ["938" ,"2021-10-26","YES", 	"2021-10-29",	"NA"	,"NA"],
                ["944" ,"2021-12-07","YES", 	"2021-12-09",	"NA"	,"NA"],
                
            ];  
            /*
            foreach ($aaaaaaa as $key => $value) {
                if($value[2] == 'YES'){                    
                    update_post_meta( $value[0] , "start_date", $value[1] );
                    update_post_meta( $value[0] , "end_date", $value[3] );                 
                }

                update_post_meta( $value[0] , "multiday", $value[2] );
            }
            
            */
            //update_post_meta( 389 , "start_time","9:00 AM" );

           

            
           

            $date_args = array(
                'post_type'   => 'event',
                'meta_key' => 'start_date',
                'posts_per_page' => -1,
                'orderby' => 'meta_value_num',
                'post_status' => 'publish',
                'order' => 'ASC',
                'meta_query'=> array(
                    array(
                    'key' => 'start_date',
                    'compare' => '>=',
                    'value' => date("Y-m-d"),
                    'type' => 'DATE'
                    )
                ),
            );
            $query = new WP_Query( $date_args );
            $query = $query->posts;

            $event_number = count($query);

            //echo '<pre>';
                //var_dump($query->posts);
            //echo '</pre>';




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

            ?>







            <div class="row" style="background: #000daa;margin-bottom: 40px;padding: 15px 10px 0px 10px;">
              <div class="col-sm-12">
                <p style="color:white;text-align: center">Please note that due to Covid-19 pandemic, many events are cancelled or being rescheduled. Our team is working hard to update this page as soon as the information becomes available. If you have any specific questions, feel free to contact us at <a href="mailto:info@biogasworld.com">info@biogascommunity.com</a></p>
              </div>
            </div>

            <table class='sortable display responsive' id='Tableau' style="width:100%">

                <thead>
                    <th>Title</th>
                    <th  class="nowrap">Event Date</th>
                    <th>Location</th>                    
                </thead>

                <tbody>

                    <?php $k = 0; foreach ($query as $value) : ?>

                        <tr>
                            <td><a href="<?= $value->guid; ?>"><?= $value->post_title; ?></a></td>
                            <td  class="nowrap" ><?= date('Y-m-d',strtotime(get_field("start_date", $value->ID))); ?></td>
                            <td><?= get_field("event_location", $value->ID); ?></td>                                
                        </tr>
                    

                    <?php $k++;endforeach ?>

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


