<?php



/**

 * Template name: Business Intelligence Template

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
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/bgcommunity.css?id=<?php echo rand(1000,
9999); ?>" />
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/business-intelligence.css?id=<?php echo rand(1000,9999); ?>" />



<script src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-grid-only@1.0.0/bootstrap.css">
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/bg-list.css?id=<?php echo rand(1000,9999); ?>">





<div id="primary" class="content-area">

    <main id="main" class="site-main">
    


        <h1><?php echo $post->post_title; ?><sup>(<span class="no_items">0</span>)</sup> </h1>



        <div id="bi_list" class="bi_list" style="">
        <?php $no_bi = 0; ?>
        <?php $bi_title = get_field("section_1_title"); $bi_content = get_field("section_1_content"); if(!empty($bi_title)): ?>
            <div class="bi_section" id="bi_section_1">
                <div class="bi_head">
                    <h2><?php echo $bi_title; ?></h2>
                    <div class="toggle_sub" onclick="$(this).parent().parent().toggleClass('show'); $('#bi_section_1 .bi_content').slideToggle(250); "></div>
                </div>
                <div class="bi_content">
                    <?php if(!empty($bi_content)): foreach($bi_content as $bi_element): ?>
                    <div class="bi_element"><p><a href='<?php echo $bi_element['document_link']; ?>' target="_blank"><?php echo $bi_element['document_name']; ?></a></p></div>
                    <?php $no_bi++; endforeach; endif; ?>
                </div>
            </div>
        <?php endif; ?>
        <?php $bi_title = get_field("section_2_title"); $bi_content = get_field("section_2_content"); if(!empty($bi_title)): ?>
            <div class="bi_section" id="bi_section_2">
                <div class="bi_head">
                    <h2><?php echo $bi_title; ?></h2>
                    <div class="toggle_sub" onclick="$(this).parent().parent().toggleClass('show'); $('#bi_section_2 .bi_content').slideToggle(250); "></div>
                </div>
                <div class="bi_content">
                    <?php if(!empty($bi_content)): foreach($bi_content as $bi_element): ?>
                    <div class="bi_element"><p><a href='<?php echo $bi_element['document_link']; ?>' target="_blank"><?php echo $bi_element['document_name']; ?></a></p></div>
                    <?php $no_bi++; endforeach; endif; ?>
                </div>
            </div>
        <?php endif; ?>
        <?php $bi_title = get_field("section_3_title"); $bi_content = get_field("section_3_content"); if(!empty($bi_title)): ?>
            <div class="bi_section" id="bi_section_3">
                <div class="bi_head">
                    <h2><?php echo $bi_title; ?></h2>
                    <div class="toggle_sub" onclick="$(this).parent().parent().toggleClass('show'); $('#bi_section_3 .bi_content').slideToggle(250); "></div>
                </div>
                <div class="bi_content">
                    <?php if(!empty($bi_content)): foreach($bi_content as $bi_element): ?>
                    <div class="bi_element"><p><a href='<?php echo $bi_element['document_link']; ?>' target="_blank"><?php echo $bi_element['document_name']; ?></a></p></div>
                    <?php $no_bi++; endforeach; endif; ?>
                </div>
            </div>
        <?php endif; ?>
        <?php $bi_title = get_field("section_4_title"); $bi_content = get_field("section_4_content"); if(!empty($bi_title)): ?>
            <div class="bi_section" id="bi_section_4">
                <div class="bi_head">
                    <h2><?php echo $bi_title; ?></h2>
                    <div class="toggle_sub" onclick="$(this).parent().parent().toggleClass('show'); $('#bi_section_4 .bi_content').slideToggle(250); "></div>
                </div>
                <div class="bi_content">
                    <?php if(!empty($bi_content)): foreach($bi_content as $bi_element): ?>
                    <div class="bi_element"><p><a href='<?php echo $bi_element['document_link']; ?>' target="_blank"><?php echo $bi_element['document_name']; ?></a></p></div>
                    <?php $no_bi++; endforeach; endif; ?>
                </div>
            </div>
        <?php endif; ?>
        
            

        </div>

    </main><!-- #main -->

</div><!-- #primary -->



<?php //get_sidebar(); 

?>



<?php

get_footer();

?>
<?php include(get_template_directory() . "/assets/includes/promo-footer.php");  ?>
<?php include(get_template_directory() . "/assets/includes/bg-footer.php");  ?>
<style>
    #page.site, #content.site-content{min-height: initial;}
</style>
<script>
    jQuery(document).ready(function(){
        updateNoItems();
        addPlaceHolders();
        
        setInterval(updateNoItems, 1000);
    });
    
    function updateNoItems(){
        var no_items = $("#bidsNum").html();
        
        jQuery('.no_items').html(<?php echo $no_bi; ?>);
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















