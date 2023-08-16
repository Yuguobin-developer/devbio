<?php
/**
 * Template name: Single Jobs Template
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
    
    /*.bids_list p, .bids_list .row p a{font-size: 14px;}*/
    
    .single .site-content-grid{position: initial!Important;}
    
    .bids_list{
        display: block;
        border: 1px solid #999;
        margin: 10px 0;
        
    }
    
    .bids_list > div{display: grid; grid-template-columns: 183px 1fr; }
    .bids_list > div p, .bids_list > div h3{padding: 10px; margin: 0;}
    
    .bids_list > div:nth-child(odd){
        background: #EEE;
    }
    
    
    
    .bids_list h3{text-transform: uppercase; font-family: 'SF UI Text', sans-serif; font-weight: 700; font-size: 14px;}
    
    .bids_list p{
        overflow-wrap: break-word;
        word-wrap: break-word;
    }

    @media only screen and (max-width: 600px) {
        .bids_list > div {
            display: block!important;
        }
    }

    .linkss{
        padding-left: 10px;
        margin-top: 10px;
    }
</style>
	<div id="primary" class="content-area">
	    
		<main id="main" class="site-main">
		    <div class="single_nav">
                <p><a href="<?= get_permalink( 498 ); ?>" class="button">< Return to list</a></p>
            </div>
            <?php $company = get_field("company"); ?>
            <h1><?php echo $post->post_title; ?></h1>
            
            <?php $logo = get_field("logo", $company->ID); if(!empty($logo)): ?>
            <img class="company_logo" src="<?php echo $logo['url']; ?>" />
            <?php endif; ?>
            <div id="" class="bids_list">
                
                <div><h3>Position title</h3><p><?php echo $post->post_title; ?></p></div>
                <div><h3>Company name</h3><p><?php echo $company->post_title; ?></p></div>
                <div><h3>Added on</h3><p><?php echo date("l, F jS Y", strtotime($post->post_date)); ?></p></div>
                
                <div class=""><h3>Position type</h3><?php echo wpautop(get_field("job_domain", $post->ID)); ?></div>
                <div class=""><h3>Location</h3><?php echo wpautop(get_field("location", $post->ID)); ?></div>
                <div class=""><h3>Deadline to apply</h3><p><?= get_field("deadline_to_apply"); ?></p></div>
                <div class=""><h3>Language(s)</h3><?php echo wpautop(get_field("languages")); ?></div>
                <div class="wide"><h3>Job description</h3><div><?php echo wpautop(get_field("job_description")); ?></div></div>
                <div class="wide"><h3>Responsibilities</h3><div><?php echo wpautop(get_field("responsibilities")); ?></div></div> 
                <div class="wide"><h3>Qualifications</h3><div><?php echo wpautop(get_field("qualifications")); ?></div></div> 

                <? if (strlen(get_field("tags"))>0) :?>
                    <div><h3>Tags</h3><p><?php echo get_field("tags"); ?></p></div>
                <? endif;?>
                
                <div class="wide"><h3>Link to opportunity</h3><div style="display:flex"><a class='linkss' href="<?= (get_field("link_to_opportunity")); ?>" target="_blank">Opportunity Link</a></div></div> 
                <div class="wide"><h3>Company web site</h3><a class='linkss' href="<?= (get_field("web_site", $company->ID)); ?>" target="_blank">Company</a></div> 
                <div class="wide"><h3>How to apply?</h3><div style="display:flex ;padding-left: 10px;margin-top: 10px;"><?= (get_field("how_to_apply")); ?></div></div> 
                
    


            </div>
            <div class="single_nav">
                <p><a href="<?= get_permalink( 498 ); ?>" class="button">< Return to list</a></p>
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

.company_logo{
    margin-left: 50%;
    transform: translateX(-50%);
    border: 1px #d6d6d6 solid;
    border-radius: 75px;
    height: 150px;
}
</style>
