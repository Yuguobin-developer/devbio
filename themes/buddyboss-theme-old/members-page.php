



<?php
/**
 * Template name: Members Template
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
    
    .people_grid{
        display: grid;
        padding: 20px 0;
        grid-template-columns: 1fr 1fr 1fr 1fr;
        grid-gap: 15px;
    }
    
    .people_grid .item{
        min-height: 300px;
        border: 1px solid #eaeaea;
        border-radius: 4px;
        background: white;
        position: relative;
    }
    
    .people_grid .item .item_avatar{
        width: 126px; height: 126px;
        margin: 20px auto;
        border-radius: 50%;
        background: url(<?php echo site_url(); ?>/wp-content/plugins/buddyboss-platform/bp-core/images/mystery-man.jpg) no-repeat;
        background-size: cover!important;
        background-position: center!important;
    }
    
    
    .people_grid .item .text_block{
        text-align: center;
        width: calc(100% - 40px);
        margin: 10px auto 30px auto;
        padding-bottom: 40px;
    }
    
    .people_grid .item .text_block h2{
        line-height: 1.1;
        margin-bottom: 6px;
        margin-top: 0;
        word-break: break-word;
        color: #122b46;
        letter-spacing: -.21px;
        padding: 0;
    }
    
    .people_grid .item .text_block a{
        
        
    }
    
    .people_grid .item .text_block a.button{
        position: absolute;
        bottom: 30px;
        left: 50%;
        transform: translateX(-50%);
    }
    
    
    
    .item_member_overview{
        margin-top: 5px;
        font-weight: 500;
        letter-spacing: -.24px;
        line-height: 1.3;
        font-size: 12px;
        margin: 0;
    }
	
	@media(max-width: 1240px){
		.people_grid{
			grid-template-columns: 1fr 1fr 1fr;
		}
	}
	
	@media(max-width: 940px){
		.people_grid{
			grid-template-columns: 1fr 1fr;
		}
		
		.search_bar .form{grid-template-columns: 1fr; grid-gap: 0.5em;}
		.search_bar .form .button{transform: translateY(0);}
	}
	
	@media(max-width: 640px){
		.people_grid{
			grid-template-columns: 1fr ;
		}
		
		
	}
</style>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
            
            <h1><?php echo $post->post_title; ?></h1>

            <?php if(current_user_can('mepr-active','rules:2542')):  ?> 

                <div id="search_bar" class="search_bar">
                    <form class="form">
                        <div class="formfield">
                            <label>Search member by name, title or company name</label>
                            <input type="text" id="search" name="search" placeholder="Search" value="<?php if(isset($_GET['search']) && strlen($_GET['search']) > 0){echo $_GET['search'];} ?>" />
                        </div>
                        
                        <div class="formfield">
                            <input type="submit" value="Search" class="button" />
                        </div>
                    </form>
                </div>
                <div id="members_list" class="members_list">


                <?php $user = wp_get_current_user();  if(true): ?>
                
                    <?php $w = array(); ?>
                
                    <?php 
                        $offset = 0;
                        if(isset($_GET['offset'])){$offset = (int)$_GET['offset'];}
                        if(isset($_GET['search']) && strlen($_GET['search']) > 0){
                            $q['key'] = "post_title";
                            $q['value'] = esc_attr($_GET['search']);
                            $q['compare'] = "like";
                            
                        // $w[] = " (SELECT * FROM wp_posts LEFT JOIN wp_postmeta ON wp_posts.ID = wp_postmeta.post_id WHERE wp_posts.post_title LIKE '%" . $q['value'] . "%' LIMIT 300) ";
                        $loop = $wpdb->get_results("SELECT DISTINCT wp_users.ID FROM wp_users LEFT JOIN wp_bp_xprofile_data ON wp_users.ID = wp_bp_xprofile_data.user_id LEFT JOIN wp_usermeta ON wp_usermeta.user_id = wp_users.ID  WHERE (wp_usermeta.meta_key = 'first_name' && wp_usermeta.meta_value LIKE '%" . $q['value'] . "%') OR (wp_usermeta.meta_key = 'last_name' && wp_usermeta.meta_value LIKE '%" . $q['value'] . "%') OR (wp_usermeta.meta_value = 'nickname' && wp_usermeta.meta_value LIKE '%" . $q['value'] . "%') OR (wp_bp_xprofile_data.field_id = 19 && wp_bp_xprofile_data.value LIKE '%" . $q['value'] . "%') OR (wp_bp_xprofile_data.field_id = 20 && wp_bp_xprofile_data.value LIKE '%" . $q['value'] . "%') OR (wp_bp_xprofile_data.field_id = 21 && wp_bp_xprofile_data.value LIKE '%" . $q['value'] . "%') LIMIT 20 OFFSET " . $offset);
                            
                            
                        } else {
                            $loop = $wpdb->get_results("SELECT * FROM wp_users ORDER BY ID DESC /*LIMIT 100 OFFSET */" /*. $offset*/);
                            
                        }

                    ?>

                    <div class="people_grid" id="people_grid">
                        <?php foreach($loop as $l): ?>
                            <?php if( !in_array('test',get_userdata($l->ID)->roles) && in_array('memberpress_account',get_userdata($l->ID)->roles)) :?>
                                <div class="grid_item item" item_id="<?php echo $l->ID; ?>" id="item_<?php echo $l->ID; ?>">

                                    <?php $avatar = get_avatar_data($l->ID); //print_r($avatar);
                                        $meta_loop = $wpdb->get_results("SELECT * FROM wp_usermeta WHERE user_id = " . (int)$l->ID);
                                        //echo "SELECT * FROM wp_bp_xprofile_data WHERE user_id = " . $l->ID;
                                        $meta_loop2 = $wpdb->get_results("SELECT * FROM wp_bp_xprofile_data WHERE user_id = " . (int)$l->ID);
                                        
                                        
                                        
                                        $meta = array();
                                        
                                        if(!empty($meta_loop)){
                                            foreach($meta_loop as $row){ //print_r($row);
                                                $meta[$row->meta_key] = $row->meta_value;
                                            }
                                        }
                                        $meta2 = array();
                                        if(!empty($meta_loop2)){
                                            foreach($meta_loop2 as $row){ //print_r($row);
                                                $meta2[$row->field_id] = $row->value;
                                            }
                                        // 
                                        }
                                        //print_r($meta_loop2);
                                        $user_link =   site_url() . "/people/" . $meta['nickname'] . "/";
                                        
                                    ?>

                                    <a href="<?php echo $user_link; ?>"></a><div class="item_avatar" style="background: url(<?php echo $avatar['url']; ?>) no-repeat;"></div>
                                    
                                    <div class="text_block">
                                        <h2 class="list-title member-name"><a href='<?php echo $user_link; ?>'><?php echo $meta['first_name'] . " " . $meta['last_name']; ?></a></h2><?php
                                            $title_array = array();
                                            if(isset($meta2[19])){$title_array[] = $meta2[19];} 
                                            if(isset($meta2[20])){$title_array[] = $meta2[20];} 
                                        ?>
                                        
                                        
                                        <p class="item_member_overview"><?php if(count($title_array) > 0){echo implode(" – ", $title_array);} ?></p>
                                        <p><a href="<?php echo $user_link; ?>" class="button">View</a></p>
                                    </div>
                                    
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                    
                <?php endif;  ?>
            
            <?php else: ?>

                <div style="text-align:center">
                    <img style="max-height:250px" src="https://www.biogascommunity.com/wp-content/uploads/2021/10/stop.png">
                </div>
                <h1 style="text-align:center">YOU ARE NOT ALLOWED TO SEE THE CONTENT OF THIS PAGE</h1>
                
            <?php endif; //  if(current_user_can('mepr-active',*****))?> 
    



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
