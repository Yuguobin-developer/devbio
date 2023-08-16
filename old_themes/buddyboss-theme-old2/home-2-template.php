<?php
/**
 * Template name: Home Template 2
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package BuddyBoss_Theme
 */

get_header();

$blog_type = 'masonry'; // standard, grid, masonry.
$blog_type = apply_filters( 'bb_blog_type', $blog_type );

$class = '';

if ( 'masonry' === $blog_type ) {
	$class = 'bb-masonry';
} elseif ( 'grid' === $blog_type ) {
	$class = 'bb-grid';
} else {
	$class = 'bb-standard';
}
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main">

		<?php if ( have_posts() ) : ?>

			<?php do_action( THEME_HOOK_PREFIX . '_template_parts_content_top' ); ?>

			<div class="">

				<?php if ( 'masonry' === $blog_type ) { ?>
					<div class="bb-masonry-sizer"></div>
				<?php } ?>
                <style>
    .bb-grid{display: block;}
    .button.signin-button{background: #000daa; transition-duration: 0.25s;}
    .button.signin-button:Hover{background: #000973;}
    @media(min-width: 1023px){
       .console_nav a.button{padding: 25px 45px; font-size: 20px;} 
    }
    
</style>
	<div style="display: block;"><img src="<?php echo site_url(); ?>/wp-content/uploads/2021/06/cover-1.png" style="width: 100%; display: block;" /></div>
	<div class="console_nav" style="text-align: center; padding: 20px 0;">
	    <a href="<?php echo site_url(); ?>/wp-login.php" class="button signin-button link" >Sign in</a> <a href="<?php echo site_url(); ?>/register/" class="button">Sign up</a>
	</div>
				<?php
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();

					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 *
					 * I am not sure why we need to laod content-post_format.php only if blog_type is not standard
					 * lets load that in all cases.
					 * Please change this if required.
					 */

					get_template_part( 'template-parts/content', apply_filters( 'bb_blog_content', get_post_format() ) );

				endwhile;
				?>
			</div>

			<?php
			buddyboss_pagination();

		else :
			get_template_part( 'template-parts/content', 'none' );
			?>

		<?php endif; ?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php get_sidebar(); ?>

<?php
get_footer();
