<?php
/**
 * Template name: test ghiles
 *
 * @package BuddyBoss_Theme
 */

get_header();
global $wpdb;

/* echo "<pre>";
var_dump($rslt);
echo "</pre>"; */
?>


<link href="https://fonts.googleapis.com/css?family=Kaushan+Script|Source+Sans+Pro" rel="stylesheet">
<link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet">


<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>



<div id="primary" class="content-area">

    <main id="main" class="site-main">            

        <h1><?php echo $post->post_title; ?> </h1>   

        <?php
        /* 
          $Events = $wpdb->get_results("SELECT ID,post_title FROM `wp_posts` WHERE `post_type` LIKE 'event'");

          foreach ($Events as $key => $value) {

            if ( strtotime(date('2022-01-01')) <  strtotime(date( $wpdb->get_results("SELECT * FROM `wp_postmeta` WHERE `post_id` = $value->ID AND `meta_key` LIKE 'start_date'")[0]->meta_value )) ) {
              $AA[$value->ID]['start_date'] = $wpdb->get_results("SELECT * FROM `wp_postmeta` WHERE `post_id` = $value->ID AND `meta_key` LIKE 'start_date'")[0]->meta_value ;
              $AA[$value->ID]['post_title'] = $value->post_title;
            }
           
           
          }

          $url = "https://biogasworld.com/wp-json/v1/events?api_key=85wefzfc-ef47-4934-b350-u5979e0ax581&from_date=2022-01-01";

          $json = file_get_contents($url);
          $json = json_decode($json);

          foreach ($json->result as $key => $value) {
            $BCD[] = $value->Title;
          }
        */
          
            echo '<pre>';
            var_dump( get_field('field_5ab3ba1b453f3','option') );
            echo '</pre>';

          
        ?>


        
        <table id="emailsTab">
           

            <tbody >

              <?php //foreach ($memberPressMembers as $value) : ?>      

              <?php //endforeach; ?>              
              
            </tbody>

          </table>



        <script>

        

        </script>

	</main><!-- #main -->
</div><!-- #primary -->





<?php

//get_footer();
?> 



