<?php
/**
 * Template name: Single Events Template
 *
 * @package BuddyBoss_Theme
 */

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
    
    
    #main.site-main h1{color: white; font-weight: 700; padding-top: 50px; font-size: 24px; color: #151515; letter-spacing: 0.05em;}
    .bids_list .row{
        display: grid; 
        grid-template-columns: 30px 30% 1fr 1fr 1fr;
        grid-gap: 20px;
        padding: 15px 0;
    }
    
    .bids_list .row:nth-child(odd){background: #e0e1eb;}
    .bids_list .row p{margin: 0; padding: 0; font-size: 13px; line-height: 1em;}
    .bids_list .row p a{font-size: 16px; color: #000daa;}
    
    .bids_list .row.head{background: #5fcf85; border-top-right-radius: 20px; border-top-left-radius: 20px;}
    .bids_list .row.head p{color: white; font-weight: 600; display: block;}
    
    .bids_list .row.head.footer{border-top-right-radius: 0px; border-top-left-radius: 0px; border-bottom-right-radius: 20px; border-bottom-left-radius: 20px;}
    @media(max-width: 940px){
        .bids_list .row{grid-template-columns: 30px 30% 1fr 1fr;}
        .bids_list .row > div:nth-child(3){display: none;}
    }
    
    @media(max-width: 740px){
        .bids_list .row{grid-template-columns: 30px 1fr 100px;}
        .bids_list .row.row_content  > div.aligncenter:nth-child(4){
            grid-column: 2/3;
            grid-row: 2/3;
            text-align: left;
        }
        .bids_list .row.row_content  > div.aligncenter:nth-child(3){
            text-align: left;
        }
        
        .bids_list .row  > div.aligncenter:nth-child(4) p{display: block; }
    }
    
    .search_bar{
        display: block; width: 100%;
        padding: 50px 0 0 0;
        
    }
    
    .search_bar .form{
        display: grid; width: 100%;
        grid-template-columns: 2fr 1fr 1fr 100px;
        grid-gap: 20px;
    }
    
    .search_bar .formfield{}
    .search_bar .formfield label{font-size: 13px;}
    .search_bar .formfield input[type=text]{display: block; width: 100%;}
    
    .search_bar .form .button{transform: translateY(27px);}
    
    .bids_list p, .bids_list .row p a{font-size: 14px;}
    
    .single .site-content-grid{position: initial!Important;}
    
    .grid_1_4 > div{
        display: block;
        border: 1px solid #999;
        margin-bottom: 10px;
        
    }
    
    .grid_1_4 > div > .block{display: grid; grid-template-columns: 150px 1fr; }
        .grid_1_4  p,     .grid_1_4  h3{padding: 10px; margin: 0;}
    
    .grid_1_4 > div > .block:nth-child(odd){
        background: #EEE;
    }
    
    
    
        .grid_1_4 > div > .block h3{text-transform: uppercase; font-family: 'SF UI Text', sans-serif; font-weight: 700; font-size: 14px; margin-bottom: 0;}
    
        .grid_1_4 > div > .block p{
        overflow-wrap: break-word;
        word-wrap: break-word;
    }
</style>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
            
            <h1><?= $post->post_title; ?></h1>
            <div class="single_nav">
            <p><a href="<?= get_permalink( 394 ); ?>" class="button">< Return to list</a></p>
            </div>
            <div id="" class="grid_1_4">
                <div>
                    <div class="block">
                        <h3>Title</h3>
                        <p><?php echo $post->post_title; ?></p>
                    </div>
                    <div class="block">
                        <h3>Date</h3>
                        <p><?php echo get_field("event_date", $post->ID); ?></p>
                    </div>
                    
                    <?php if(strlen(get_field("event_time", $post->ID))>0):?>
                        <div class="block">
                            <h3>Hours</h3>
                            <p><?php echo get_field("event_time", $post->ID); ?></p>
                        </div>
                    <?php endif; ?>
                    
                    
                    <div class="block">
                        <h3>Location</h3>
                        <p><?php echo get_field("event_location", $post->ID); ?></p>
                    </div>
                    <div class="block">
                        <h3>Event website</h3>
                        <p><?php $website = get_field("event_web_site", $post->ID); if(strlen($website) > 0){echo '<a href="' . $website . '" target="_blank">Original Link</a>';} else {echo "NA";} ?></p>
                    </div><?php 
						$discount_name = get_field("discount_code_name", $post->ID);
						$discount_code = get_field("discount_code", $post->ID);
						$discount_link = get_field("discount_code_link", $post->ID);

						if( strlen($discount_name) > 0 || strlen($discount_code) > 0 ): ?>
					<div class="block">
						<h3>Discount</h3>
                        <?php if(current_user_can('mepr-active','rules:1043')): ?>
                            <?php $discount_array = array();
                            if(strlen($discount_name) > 0){$discount_array[] = $discount_name;}
                            if(strlen($discount_code) > 0){$discount_array[] = $discount_code;}
                            
                            $discount_string = implode($discount_array, ": ");
                            if(strlen($discount_link) > 0){$discount_string = "<a href='" . $discount_link . "' >" . $discount_string . "</a>";}
                            
                            ?><p><?php  echo $discount_string;  ?></p>
                        <?php else:?>
                            <p>You are not allowed to see the promo code</p>
                        <?php endif; ?>

					</div>
					<?php endif; ?>
					
                </div>
                <div style="padding: 25px;text-align:center">
					<?php $event_poster = get_field("event_poster"); if(!empty($event_poster)): ?>
					    <img class="event_poster" src="<?php echo $event_poster['url']; ?>"  style="   />
					­<?php else:?>
                        <?php  if( strlen( get_field("event_banner", $post->ID)    )>0): ?>  
                            <img class="event_poster" src="<?= get_field("event_banner", $post->ID); ?>" />
                        <?php endif; ?>
                    <?php endif; ?>
                    <div style="padding: 50px;text-align: justify;">
					    <?php echo wpautop($post->post_content); ?></div>
                    </div>


            </div>
            <div class="single_nav">
                <p><a href="<?= get_permalink( 394 ); ?>" class="button">< Return to list</a></p>
            </div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php //get_sidebar(); ?>

<?php
get_footer();
?>
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
</style>
