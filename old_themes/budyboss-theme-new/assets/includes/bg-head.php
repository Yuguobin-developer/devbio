<?php
$bloginfo = get_bloginfo(); ?><head>
	<meta charset="UTF-8"><?php $rand_id = rand(10000, 99999); ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="<?php echo site_url(); ?>/favicon.ico" />

    <title><?php echo $post->post_title; ?> &mdash; <?php echo get_bloginfo( 'name' ); ?></title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/ScrollTrigger.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script><?php if(isset($js) && count($js) > 0): foreach($js as $j): ?>
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/<?php echo $j; ?>?id=<?php echo $rand_id; ?>"></script>
<?php endforeach; endif; ?>
    <script>
var style_url = "<?php echo get_stylesheet_directory_uri(); ?>";
</script>
	<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>

    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/bgcommunity.css?id=<?php echo $rand_id; ?>" />
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/bgcommunity.js?id=<?php echo $rand_id; ?>"></script><?php if(isset($css) && count($css) > 0): foreach($css as $c): ?>
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/<?php echo $c; ?>?id=<?php echo $rand_id; ?>">
<?php endforeach; endif; ?>
<?php if(true): ?><meta property="og:site_name" content="<?php echo get_bloginfo( 'name' ); ?>"/>
<meta property="og:url" content="<?php echo get_permalink(); ?>"/>
<meta property="og:title" content="<?php echo $post->post_title; ?> &mdash; <?php echo get_bloginfo( 'name' ); ?>"/>
<meta property="og:image" content=""/>
<meta property="og:image" content="<?php echo $post->post_excerpt; ?>"/>
<?php endif; 
    wp_head();
?>
<script>
    var site_url = '<?php echo $site_url; ?>';
</script>
</head>
<div id="fb-root"></div>