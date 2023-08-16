<?php $post_content = $post->post_content;
/**
 * Template name: Home Template
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
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/bg-global.css?id=<?php echo rand(1000,9999); ?>" />
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/bg-news.css?id=<?php echo rand(1000,9999); ?>" />
<?php if(is_user_logged_in()): ?>

	<div id="primary" class="content-area">
    
		<main id="main" class="site-main bg-class">

			<?php if ( have_posts() ) : ?>

				<?php do_action( THEME_HOOK_PREFIX . '_template_parts_content_top' ); ?>

				<div class="post-grid <?php echo esc_attr( $class ); ?>">

					<?php if ( 'masonry' === $blog_type ) { ?>
						<div class="bb-masonry-sizer"></div>
					<?php } ?>

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

				<?php	buddyboss_pagination(); ?>
			
				<? else : get_template_part( 'template-parts/content', 'none' ); ?>

			<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>

<?php else: ?>

	<div id="primary" class="content-area">
    
		<main id="main" class="site-main">

			<?php if ( have_posts() ) : ?>

				<?php do_action( THEME_HOOK_PREFIX . '_template_parts_content_top' ); ?>

				<div class="post-grid <?php echo esc_attr( $class ); ?>">

					<?php if ( 'masonry' === $blog_type ) { ?>
						<div class="bb-masonry-sizer"></div>
					<?php } ?>

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

				<?php	buddyboss_pagination(); ?>
			
				<? else : get_template_part( 'template-parts/content', 'none' ); ?>

			<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

	<!--
	<style>
		.bb-grid{display: block;}
		.button.signin-button{background: #000daa; transition-duration: 0.25s;}
		.button.signin-button:Hover{background: #000973;}
		
		.pricing_grid{padding:  50px 0 150px 0;}
		.pricing_grid h3{display: block; text-align: center; }
		@media(min-width: 1023px){
		.console_nav a.button{padding: 25px 45px; font-size: 20px;} 
		}
		
	</style>
	<div style="display: block;"><img src="<?php //echo site_url(); ?>/wp-content/uploads/2021/06/cover-1.png" style="width: 100%; display: block;" /></div>
	<div class="console_nav" style="text-align: center; padding: 20px 0;">
	    <a href="<?php //echo site_url(); ?>/wp-login.php" class="button signin-button link" >Sign in</a> <a href="<?php //echo site_url(); ?>/register/" class="button">Sign up</a>
	</div>

	-->
            

            
	
<?php endif; ?>

<?php
get_footer();?><?php include(get_template_directory() . "/assets/includes/bg-footer.php");  ?>
