<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package BuddyBoss_Theme
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<?php wp_head(); ?>

	<script type='text/javascript'>/*
        var googletag = googletag || {};
        googletag.cmd = googletag.cmd || [];
        (function () {
            var gads = document.createElement('script');
            gads.async = true;
            gads.type = 'text/javascript';
            var useSSL = 'https:' == document.location.protocol;
            gads.src = (useSSL ? 'https:' : 'http:') +
                '//www.googletagservices.com/tag/js/gpt.js';
            var node = document.getElementsByTagName('script')[0];
            node.parentNode.insertBefore(gads, node);
        })();*/
    </script>



	<script async src="https://securepubads.g.doubleclick.net/tag/js/gpt.js"></script>
	<script>
	window.googletag = window.googletag || {cmd: []};
	googletag.cmd.push(function() {
		googletag.defineSlot('/91306070/sidebar_bigbox_2', [300, 250], 'div-gpt-ad-1632368774662-0').addService(googletag.pubads());
		googletag.pubads().enableSingleRequest();
		googletag.enableServices();
	});
	</script>

	<!-- Google tag (gtag.js) -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-XND44QW444"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());
		gtag('config', 'G-XND44QW444');
	</script>

<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/bg-global.css?id=<?php echo rand(1000,9999); ?>" />
	</head>
<?php
						if(get_current_user_id() && current_user_can('mepr-active','rule:1025')){
							echo do_shortcode( '[cometchat layout="docked"]' );
						}

?><body <?php body_class(); ?>>

        <?php wp_body_open(); ?>

		<?php if (!is_singular('llms_my_certificate')):
		 
			do_action( THEME_HOOK_PREFIX . 'before_page' ); 
	
		endif; ?>

		<div id="page" class="site">

			<?php do_action( THEME_HOOK_PREFIX . 'before_header' ); ?>

			<header id="masthead" class="<?php echo apply_filters( 'buddyboss_site_header_class', 'site-header site-header--bb' ); ?>" >
				<?php do_action( THEME_HOOK_PREFIX . 'header' ); ?>
			</header>

			<?php do_action( THEME_HOOK_PREFIX . 'after_header' ); ?>

			<?php do_action( THEME_HOOK_PREFIX . 'before_content' ); ?>

			<div id="content" class="site-content">

				<?php do_action( THEME_HOOK_PREFIX . 'begin_content' ); ?>

				<div class="container">
					<div class="<?php echo apply_filters( 'buddyboss_site_content_grid_class', 'bb-grid site-content-grid' ); ?>">
						