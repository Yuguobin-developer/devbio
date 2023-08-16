<?php
/**
 * Template name: Bids Template
 *
 * @package BuddyBoss_Theme
 */
if(!current_user_can('mepr-active','rules:461')){
	header("https://www.biogascommunity.com/unauthorized/");
}
get_header();
global $wpdb;
?>
	<?php 
	$share_box = buddyboss_theme_get_option( 'blog_share_box' );
	if ( !empty( $share_box ) && is_singular('post') ) :
		get_template_part( 'template-parts/share' ); 
	endif;
	?>
<style>
    
</style>
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/bgcommunity.css?id=<?php echo rand(1000,9999); ?>" />
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/bg-single.css?id=<?php echo rand(1000,9999); ?>" />

	<div id="primary" class="content-area">
		<main id="main" class="site-main bg_single">
            
            
            <div id="search_bar" class="search_bar">
                
            </div>
            <div class="single_nav">
                <p><a href="<?= get_permalink( 305 ); ?>" class="button button_2 button_arrow_left">Return to public bids</a></p>
            </div>
            
            <h1>Public bid information</h1>
            <?php if(true || current_user_can('mepr-active','rules:461')): ?>
            <div id="" class="item_list_wrapper">
                <div class="list_item grid_1_1">
                    <div>
                        <h3>Title</h3>
                        <p><?php echo $post->post_title; ?></p>
                        <p><a class="button button_dark button_arrow" href="<?= get_field('bid_link', $post->ID); ?>" target="_blank">Direct Link to bid</a></p>
                    </div>
                    <div>
                        <h3>Organization</h3>
                        <p><?php echo get_field("organization", $post->ID); ?></p>
                    </div>
                </div>
                <div class="list_item grid_1_1">
                    <div>
                        <h3>Added on</h3>
                        <p><?php echo date("l, F jS Y", strtotime($post->post_date)); ?></p>
                        
                    </div>
                    <div>
                        <h3>Closing date</h3>
                        <p><?php echo get_field("closing_date", $post->ID); ?></p>
                    </div>
                </div>
                <div class="list_item grid_1">
                    <div>
                        <h3>Description</h3>
                        <?php echo wpautop(get_field("description", $post->ID)); ?>
                        
                    </div>
                    
                </div>
                <div class="list_item grid_1_1">
                    <div>
                        <h3>Contact name</h3>
                        <p><?php echo get_field("contact_name", $post->ID); ?></p>
                        
                    </div>
                    <div>
                        <h3>Location</h3>
                        <p><?php echo get_field("location", $post->ID); ?></p>
                    </div>
                </div>
                <div class="list_item grid_1_1">
                    <div class="break_word_wrapper">
                        <h3>Contact email</h3>
                        <p><?php echo get_field("contact_email", $post->ID); ?></p>
                        
                    </div>
                    <div>
                        <h3>Tags</h3>
                        <p><?php echo get_field("tags", $post->ID); ?></p>
                    </div>
                </div>
            </div>
            
            <?php else: ?>
            <div id="" class="item_list_wrapper">
            <h2>We are sorry you do not have credentials to view this page.</h2>
            </div>
            <?php endif; ?>
            <div class="single_nav">
                <p><a href="<?= get_permalink( 305 ); ?>" class="button button_2 button_arrow_left">Return to public bids</a></p>
            </div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php //get_sidebar(); ?>

<?php
get_footer();
?>
<?php include(get_template_directory() . "/assets/includes/bg-footer.php");  ?>
<style>

.deck{
    display: block; padding: 20px 0;
}

.grid_2{
    display: grid;
    grid-template-columns: 1fr 1fr;
    grid-gap: 20px;
}

.single .entry-title {
    margin-top: -30px;
    
}
.bids_list > div {
    align-items: center;
}
.bids_list > div a {
    padding: 10px;
    margin: 0;
}
</style>
