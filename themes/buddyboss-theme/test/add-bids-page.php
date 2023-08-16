<?php



/**

 * Template name: Add Entry Form Template

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
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/bgcommunity.css?id=<?php echo rand(1000,9999); ?>" />



<script src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-grid-only@1.0.0/bootstrap.css">
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/bg-list.css?id=<?php echo rand(1000,9999); ?>">
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/bg-forms.css?id=<?php echo rand(1000,9999); ?>">





<div id="primary" class="content-area">

    <main id="main" class="site-main">
        <div class="flex grid_flex">
            <div><h1><?php echo $post->post_title; ?> </h1></div>
            
        </div>


        



        <div id="main_form">
            <?php echo do_shortcode($post->post_content); ?>
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
