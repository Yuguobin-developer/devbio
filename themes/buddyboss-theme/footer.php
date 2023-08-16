<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package BuddyBoss_Theme
 */

?>

<?php do_action( THEME_HOOK_PREFIX . 'end_content' ); ?>

</div><!-- .bb-grid -->
</div><!-- .container -->
</div><!-- #content -->

<?php do_action( THEME_HOOK_PREFIX . 'after_content' ); ?>

<?php do_action( THEME_HOOK_PREFIX . 'before_footer' ); ?>
<?php do_action( THEME_HOOK_PREFIX . 'footer' ); ?>
<?php do_action( THEME_HOOK_PREFIX . 'after_footer' ); ?>

</div><!-- #page -->

<?php do_action( THEME_HOOK_PREFIX . 'after_page' ); ?>

<?php wp_footer(); ?>

</body>

<!-- Show hide other tag field on signup page -->
<script>
    jQuery( "#field_624_100" ).click(function() {
        $(".field_625").toggle();
    });


    $('a').each(function() {
        var href = $(this).attr('href');
        if (href && href.indexOf('3D407%') !== -1) {
            jQuery('.option-1').attr('style', 'display:block');
        }
        if (href && href.indexOf('3D40%') !== -1) {
            jQuery('.option-1').attr('style', 'display:block');
        }
        if (href && href.indexOf('bid%') !== -1) {
            jQuery('.option-2').attr('style', 'display:block');
        }
        if (href && href.indexOf('3D8%') !== -1) {
            jQuery('.option-2').attr('style', 'display:block');
        }
        if (href && href.indexOf('bid-private') !== -1) {
            jQuery('.option-3').attr('style', 'display:block');
        }
        if (href && href.indexOf('3D421%') !== -1) {
            jQuery('.option-4').attr('style', 'display:block');
        }
    });
        // Get the value of the input field
    var inputValue = $('input[name="redirect_to"]').val();
    
    // Check if the input value contains "page=407"
    if (inputValue.includes('page=407&')) {
      jQuery('.option-1').attr('style', 'display:block');
    }
    if (inputValue.includes('page=40&')) {
      jQuery('.option-1').attr('style', 'display:block');
    }
    if (inputValue.includes('bid%')) {
      jQuery('.option-2').attr('style', 'display:block');
    }
    if (inputValue.includes('page=8&')) {
      jQuery('.option-2').attr('style', 'display:block');
    }
    if (inputValue.includes('bid-private')) {
      jQuery('.option-3').attr('style', 'display:block');
    }
    if (inputValue.includes('page=421&')) {
      jQuery('.option-4').attr('style', 'display:block');
      jQuery('.option-4 p').attr('style', 'padding-top:80px');
    }

   
</script>


</html>
