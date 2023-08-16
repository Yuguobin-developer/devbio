<?php
/**
 * Template name: Members Template sorted
 *
 * @package BuddyBoss_Theme
 */
if(!current_user_can('mepr-active','rules:2542')){
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
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/bgcommunity.css?id=<?php echo rand(1000,9999); ?>" />
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/bg-list.css?id=<?php echo rand(1000,9999); ?>" />
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/bg-members.css?id=<?php echo rand(1000,9999); ?>" />
<style>
    
</style>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
            
                <script>
                    jQuery(document).ready(function () {

                        jQuery.expr[':'].contains = function(a, i, m) {
                            return jQuery(a).text().toUpperCase().indexOf(m[3].toUpperCase()) >= 0;
                        };

                        $('#MembersNumber').html($('.grid_item').length);


                        $('#search').keyup(function (e) { 
                            let val = $(this).val();
                            
                            if (val != '') {

                                $("div.grid_item").hide();

                                $("div.grid_item h2:contains('"+val+"')").parent('div').parent('div').show();
                                $("div.grid_item p:contains('"+val+"')").parent('div').parent('div').show(); 

                                val1 = $("div.grid_item h2:contains('"+val+"')").length;
                                val2 = $("div.grid_item p:contains('"+val+"')").length;

                                val =  Math.max(val1, val2);

                            }else{
                                $("div.grid_item").show();

                                val = $('.grid_item').length;
                            }
                            
                            $('#MembersNumber').html(val);
                            
                            
                        });
                    });

                  

                </script>

            <?php if(true): // if(current_user_can('mepr-active','rules:2542')):  ?> 
                <h1><?php echo $post->post_title; ?><sup>(<span id='MembersNumber'></span>)</sup></h1>
                <div id="search_bar" class="search_bar">
                   
                        <div class="formfield">
                            <label>Search member by name, title or company name</label>
                            <input type="text" id="search" name="search" placeholder="Search Members" value="<?php if(isset($_GET['search']) && strlen($_GET['search']) > 0){echo $_GET['search'];} ?>" />
                        </div>
                        
                      
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
                        
                        $member = new MeprUser();     
                        
                        foreach ($loop as $key => $value) {
                            $sorted_ids[$value->ID] =  intval(get_field('userslevel','user_'.$value->ID)) ;                            
                        }

                        arsort($sorted_ids);
                 
                    ?>
                    

                    <div class="people_grid" id="people_grid">

                    <?php //foreach($loop as $l): ?>
                        <?php foreach($sorted_ids as $key => $l): ?>

                            
                            
                            <?php $member->ID = $key/*$l->ID*/; $Subscription = $member->active_product_subscriptions(); ?>
                            
                            <?php if( !in_array('test',get_userdata($key/*$l->ID*/)->roles) && (count($Subscription) > 0 && in_array('memberpress_account',get_userdata($key)->roles)) )  :?>

                                <div class="grid_item item" item_id="<?php echo $key/*$l->ID*/; ?>" id="item_<?php echo $key/*$l->ID*/; ?>">

                                    <?php $avatar = get_avatar_data($key/*$l->ID*/); //print_r($avatar);
                                        $meta_loop = $wpdb->get_results("SELECT * FROM wp_usermeta WHERE user_id = " . (int)$key/*$l->ID*/);
                                        //echo "SELECT * FROM wp_bp_xprofile_data WHERE user_id = " . $key/*$l->ID*/;
                                        $meta_loop2 = $wpdb->get_results("SELECT * FROM wp_bp_xprofile_data WHERE user_id = " . (int)$key/*$l->ID*/);
                                        
                                        
                                        
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
                                        <p><a href="<?php echo $user_link; ?>" class="button">View Profile</a></p>
                                    </div>
                                    
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                    
                <?php endif;  ?>
            
            <?php else: ?>
                <?php include(get_template_directory() . "/assets/includes/unauthorized-access.php");  ?>
                
                
            <?php endif; //  if(current_user_can('mepr-active',*****))?> 
    



</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php //get_sidebar(); ?>

<?php
get_footer();
include(get_template_directory() . "/assets/includes/bg-footer.php");  ?>
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
