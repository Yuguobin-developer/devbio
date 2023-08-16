<?php



/**

 * Template name: Pricing Page Template

 *

 * @package BuddyBoss_Theme

 */



get_header();

global $wpdb;



$has_access = false;

if (current_user_can('editor') || current_user_can('administrator')) {

    $has_access = true;

}

$current_date = strtotime(date("Y-m-d"));

?>
<script>
var mobile_pricing_nav_top = 0;
</script>
<?php

$share_box = buddyboss_theme_get_option('blog_share_box');

if (!empty($share_box) && is_singular('post')) :

    get_template_part('template-parts/share');

endif;

?>







<link rel="stylesheet" href="https://cdn.datatables.net/1.11.2/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/bgcommunity.css?id=<?php echo rand(1000,9999); ?>" />



<script src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/gsap-public/minified/gsap.min.js?id=<?php echo rand(1000,9999); ?>"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/gsap-public/minified/ScrollTrigger.min.js?id=<?php echo rand(1000,9999); ?>"></script>


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-grid-only@1.0.0/bootstrap.css">
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/bg-list.css?id=<?php echo rand(1000,9999); ?>">
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/bg-pricing.css?id=<?php echo rand(1000,9999); ?>">





<div id="primary" class="content-area">

    <main id="main" class="site-main">
    <div class="deck" id="deck_1">
        <div class="deck_background">
            <div class="bg_shape"></div>
            <div class="bg_shape"></div>
        </div>
        <div class="webwrapper">
            <?php echo wpautop($post->post_content); ?>
            <div class="pricing_nav">
                <a href="#" class="button individual active" onclick="selectPricing('individual'); return false;">Individual</a> <a href="#" class="button business" onclick="selectPricing('business'); return false;">Business</a> <a href="#" class="button plant_owners" onclick="selectPricing('plant_owners'); return false;">Plant owners</a>
            </div><?php $pricing = get_field("pricing"); //print_r($pricing); ?>
            <div class="pricing_grid">
                <?php if(!empty($pricing)): foreach($pricing as $price): if($price['category'] == "plant owners"){$price['category'] = "plant_owners";} ?>
                <div class="item price_item <?php echo urlencode($price['category']); if($price['highlight']){echo " highlight ";} ?>">
                    <div class="text_block"><p><?php echo $price['title']; ?></p></div>
                    <div class="text_block"><h1><?php echo $price['price']; ?></h1><p><?php echo $price['frequency']; ?></p></div>
                    <div class="text_block">
                        <?php echo wpautop($price['options']); ?>
                    </div>
                    <div class="text_block price_cta_block">
                        <?php if(!empty($price['url_to_sign_up'])): ?><a class="button button_1" href="<?php echo $price['url_to_sign_up']; ?>">Sign up now</a><?php endif; ?>
                        <?php if(!empty($price['url_to_learn_more'])): ?><a class="button button_2" href="#deck_1b">Learn More</a><?php endif; ?>
                    </div>
                </div>
                <?php endforeach; endif; ?>
            </div>
        </div>
    </div><?php function setOptionContent($string){
			$output = $string;
			if($string == 'check'){$output = "<span class='option_check'></span>";}
			if($string == 'lock'){$output = "<span class='option_lock'></span>";}
			if($string == 'unlock'){$output = "<span class='option_unlock'></span>";}

				return $output;
			}
		
		function setList($section_title, $section_list, $pricing_ID, $layout_class = "three_column"){ ?>
			<h2 class="bubble_title"><?php echo get_field($section_title, $pricing_ID); ?></h2>
					<?php $pricing_list = get_field($section_list, $pricing_ID); ?>
					<div class="pricing_list_grid">
						<div class="pricing_grid_row head_row <?php echo $layout_class; ?>">
							<div><p>Features</p></div>
							<div class="option_column "><p><?php echo get_field("title_column_1", $pricing_ID); ?></p></div>
							<div class="option_column"><p><?php echo get_field("title_column_2", $pricing_ID); ?></p></div>
							<?php if($layout_class == 'three_column'): ?><div class="option_column"><p><?php echo get_field("title_column_3", $pricing_ID); ?></p></div><?php endif; ?>
							
						</div>
						<?php if(!empty($pricing_list)): ?>
						<?php foreach($pricing_list as $pricing_item): ?>
						<div class="pricing_grid_row content_row <?php echo $layout_class; ?>">
							<div class="title_column"><p><?php echo $pricing_item['section_title']; ?></p><?php $bubble = $pricing_item['bubble']; if(!empty($bubble)):  ?><div class="bubble"><p><?php echo $bubble; ?></p></div><?php endif; ?></div>
							<div class="option_column column_0 active"><p><?php echo setOptionContent($pricing_item['option_1']); ?></p></div>
							<div class="option_column column_1"><p><?php echo setOptionContent($pricing_item['option_2']); ?></p></div>
							<?php if($layout_class == 'three_column'): ?><div class="option_column column_2"><p><?php echo setOptionContent($pricing_item['option_3']); ?></p></div><?php endif; ?>
							
						</div>
						<?php endforeach; ?>
						<?php endif; ?>
					</div>
		<?php }
		
		?>
	<div class="deck" id="deck_1b"><?php //Business = 449 - Plant Owners 557, Membership 445 ?>
		<div class="webwrapper">
			<div class="swap_wrapper">		
				<h3>Join our community  with no up-front costs</h3>
				<div class="swap_item individual_member"><?php $pricing_ID = 445; ?>
										<div class="swap_item_title"><h1><?php echo get_field("main_title", 445); ?></h1></div>
					<div id="mobile_pricing_nav_1" class="mobile_pricing_nav two_columns">
						<span href="#" onclick="selectPriceOption(0); " class="active" >Basic</span>
						<span href="#" onclick="selectPriceOption(1); " class="" >Standard</span>
					</div>
					<?php setList("section_title_1", "pricing_list_1", 445, "two_column"); ?>
					<?php setList("section_title_2", "pricing_list_2", 445, "two_column"); ?>
				</div>
			</div>
			<div class="swap_wrapper">					
				<div class="swap_item business_member"><?php $pricing_ID = 449; ?>
					<div class="swap_item_title"><h1><?php echo get_field("main_title", 449); ?></h1></div>
					<div class="mobile_pricing_nav">
						<span href="#" onclick="selectPriceOption(0); " class="active" >Basic</span>
						<span href="#" onclick="selectPriceOption(1); " class="" >Standard</span>
						<span href="#" onclick="selectPriceOption(2); " class="" >Premium</span>
					</div>
					<?php setList("section_title_1", "pricing_list_1", 449); ?>
					<?php setList("section_title_2", "pricing_list_2", 449); ?>
					<?php setList("section_title_3", "pricing_list_3", 449); ?>
					<?php setList("section_title_4", "pricing_list_4", 449); ?>
					<?php setList("section_title_5", "pricing_list_5", 449); ?>
					<?php setList("section_title_6", "pricing_list_6", 449); ?>
					<?php setList("section_title_7", "pricing_list_7", 449); ?>
				</div>
			</div>
			<div class="swap_wrapper">					
				<div class="swap_item plant_owners_member"><?php $pricing_ID = 557; ?>
					<div class="swap_item_title"><h1><?php echo get_field("main_title", 557); ?></h1></div>
					<div class="mobile_pricing_nav two_columns">
						<span href="#" onclick="selectPriceOption(0); " class="active" >Free</span>
						<span href="#" onclick="selectPriceOption(1); " class="" >Basic</span>
					</div>
					<?php setList("section_title_1", "pricing_list_1", 557, "two_column"); ?>
					<?php setList("section_title_2", "pricing_list_2", 557, "two_column"); ?>
					<?php setList("section_title_3", "pricing_list_3", 557, "two_column"); ?>
					<?php setList("section_title_4", "pricing_list_4", 557, "two_column"); ?>
					<?php setList("section_title_5", "pricing_list_5", 557, "two_column"); ?>
					<?php setList("section_title_6", "pricing_list_6", 557, "two_column"); ?>
					<?php setList("section_title_7", "pricing_list_7", 557, "two_column"); ?>
				</div>
			</div>
		</div>
		</div>
    <div class="deck" id="deck_2"><?php $text_blocks = get_field("text_block");  ?>
        <div class="webwrapper">
            <?php echo wpautop($text_blocks[0]['text']); 
                $q_as = get_field("q-a"); 
            ?>
            <div class="qa_list"><?php if(!empty($q_as)): foreach($q_as as $q): ?>
                <div class="qa_item">
                    <div class="qa_head" onclick="$(this).parent().toggleClass('active'); $(this).next().slideToggle(500); ">
                        <h2><?php echo $q['question']; ?></h2>
                        <div class="toggle_button"></div>
                    </div>
                    <div class="qa_body">
                        <?php echo wpautop($q['answer']); ?>
                    </div>
                </div>
                <?php endforeach; endif; ?>
            </div>
            <div class="qa_footer">
                <?php echo wpautop($text_blocks[1]['text']); ?>
            </div>
        </div>
    </div>
    <?php $items = get_field("items", 2913);  ?>
    
    <div class="deck" id="deck_4">
				<div class='webwrapper section_header'>
					<div class="grid grid_1_1">
						<div>
							<?php echo wpautop($items[4]['text_1']); ?>
						</div>
						<div>
							<?php echo wpautop($items[4]['text_2']); ?>
						</div>
					</div>
					<div class="grid grid_1_1_1">
						<div class="box">
							<div>
								<?php echo wpautop($items[5]['text_1']); ?>
							</div>
							<div>
								<?php echo wpautop($items[5]['text_2']); ?>
							</div>
							
						</div>
						<div class="box">
							<div>
								<?php echo wpautop($items[6]['text_1']); ?>
							</div>
							<div>
								<?php echo wpautop($items[6]['text_2']); ?>
							</div>
							
						</div>
						<div class="box">
							<div>
								<?php echo wpautop($items[7]['text_1']); ?>
							</div>
							<div>
								<?php echo wpautop($items[7]['text_2']); ?>
							</div>
							
						</div>
					</div>
				</div>
			</div>
			<div class="deck " id="deck_5">
				<div class="webwrapper">
					<div class="box dark_green box_round">
						<div class="box_background" style="background: url(<?php echo $items[8]['image']['url']; ?>) no-repeat;"></div>
						<div class="text_wrapper top_box">
							<?php echo wpautop($items[8]['text_1']); ?>
						</div>
						<div class="slider_wrapper">
							<?php $testimonials = get_field("testimonials", 2913); if(!empty($testimonials)): foreach($testimonials as $testimonial): ?>
							<div class="item testimonial_item">
								<?php echo wpautop($testimonial['text']); ?>
							</div>
							<?php endforeach; endif; ?>
						</div>
						
					</div>
				</div>
			</div>
			
			<div class="deck" id="deck_7">
				<div class="webwrapper">
					<div class="box light_green box_round">
						<div class="box_background" style="background: url(<?php echo $items[10]['image']['url']; ?>) no-repeat;"></div>
						<div class="text_wrapper">
							<?php echo wpautop($items[10]['text_1']); ?>
						</div>
					</div>
				</div>
			</div>
    </main><!-- #main -->
	<div id="main_mobile_nav_wrapper" class="main_mobile_nav_wrapper ">
		<div class="mobile_nav_swap_wrapper individual">
			<div id="mobile_pricing_nav_1" class="mobile_pricing_nav two_columns">
				<span href="#" onclick="selectPriceOption(0); " class="active" >Basic</span>
				<span href="#" onclick="selectPriceOption(1); " class="" >Standard</span>
			</div>
		</div>
		<div class="mobile_nav_swap_wrapper business active">
			<div class="mobile_pricing_nav">
				<span href="#" onclick="selectPriceOption(0); " class="active" >Basic</span>
				<span href="#" onclick="selectPriceOption(1); " class="" >Standard</span>
				<span href="#" onclick="selectPriceOption(2); " class="" >Premium</span>
			</div>
		</div>
		<div class="mobile_nav_swap_wrapper plant_owners">
			<div class="mobile_pricing_nav two_columns">
				<span href="#" onclick="selectPriceOption(0); " class="active" >Free</span>
				<span href="#" onclick="selectPriceOption(1); " class="" >Basic</span>
			</div>
		</div>
	</div>
</div><!-- #primary -->



<?php //get_sidebar(); 

?>



<?php

get_footer();

?>
<?php //include(get_template_directory() . "/assets/includes/promo-footer.php");  ?>
<?php include(get_template_directory() . "/assets/includes/bg-footer.php");  ?>

<style>

    .deck {

        display: block;

        padding: 20px 0;

    }



    .grid_2 {

        display: grid;

        grid-template-columns: 1fr 1fr;

        grid-gap: 20px;

    }



    .single .entry-title {

        margin-top: -30px;



    }

</style>
<style>

                #Tableau_length,#Tableau_filter {display: none;}

                .col-sm-6>input,.col-sm-6>span>select {width: 100%;}

                .col-sm-6 {padding: 10px;}

                .col-sm-6>p {margin-bottom: 10px;}

                thead>tr {background: #006633;color: white;border-radius: 67px;}

                td {vertical-align: revert;}

                table.dataTable.dtr-inline.collapsed>tbody>tr>td.dtr-control:before, table.dataTable.dtr-inline.collapsed>tbody>tr>th.dtr-control:before {
                    background-color: #000daa!important;
                }
table.dataTable thead th, table.dataTable thead td {
padding: 25px 5px;
    
}

table.dataTable thead th, table.dataTable tfoot th{font-weight: initial;}
    

table.dataTable.display tbody tr.odd>.sorting_2, table.dataTable.order-column.stripe tbody tr.odd>.sorting_2, table.dataTable.display tbody tr.even>.sorting_2, table.dataTable.order-column.stripe tbody tr.even>.sorting_2{
    background-color: #D2E4DA;
}

table.dataTable.display tbody tr.odd>.sorting_1, table.dataTable.order-column.stripe tbody tr.odd>.sorting_1{background-color: initial;

body.bb-custom-typo{font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;}

tbody > tr >td:nth-child(2){background-color: #D2E4DA;}
tbody > tr{border-bottom: 1px solid #006633;}
td, th{border-bottom: 1px solid #006633;}
body > tr >td:nth-child(2){background-color: #d2E4D1;}


</style>
<script>
jQuery(document).ready(function(){

	$('.slider_wrapper').slick({
		  infinite: true,
		  slidesToShow: 2,
		  slidesToScroll: 1,
		responsive: [
			 {
				  breakpoint: 1280,
				  settings: {
					slidesToShow: 1,
					slidesToScroll: 1
					
				  }
			}
		]
		}); 
	
	adjustSlickHeight();
	positionSliderNav();
	
	jQuery(window).resize(function(){
		$('.slick-initialized .slick-slide').css({"height" : "initial"});
		setTimeout(function(){adjustSlickHeight();},500);
		positionSliderNav();
		mobileFlipper();
	});
	
	mobileFlipper();
	
	initStickyMenu();
});
		
	function adjustSlickHeight(){
		var slickHeight = $('.slider_wrapper').height();
		$('.slick-initialized .slick-slide').css({"height" : slickHeight + 'px'});
		
	}
		
	function positionSliderNav(){
		var wWidth = $(window).width();
		var topMargin = 100;
		if(wWidth < 1300){topMargin = 0;}
		var sliderPos = jQuery(".slider_wrapper").position();
		var sliderNavTop = (sliderPos.top - 40 + topMargin) * -1;
		$(".slick-arrow.slick-next").css({"top" : sliderNavTop + "px"});
		$(".slick-arrow.slick-prev").css({"top" : sliderNavTop + "px"});
	}
	
    jQuery(document).ready(function(){
        selectPricing('business');
    });
    
    function selectPricing(current_card_category){ console.log(current_card_category);
        $(".pricing_nav .button.active").removeClass("active");
        $(".pricing_nav .button." + current_card_category).addClass("active");
        
        $(".pricing_grid .price_item").removeClass("active");
        $(".pricing_grid .price_item." + current_card_category).addClass("active");
		
		$(".swap_item").removeClass("active");
		$(".swap_item." + current_card_category + "_member").addClass("active");
		
		$(".mobile_nav_swap_wrapper.active").removeClass("active");
		$(".mobile_nav_swap_wrapper." + current_card_category).addClass("active");
    }
	
	function mobileFlipper(){
		if($(".pricing_list_grid .pricing_grid_row div.option_column").size() < 1){
			$(".pricing_list_grid .pricing_grid_row div.option_column:nth-child(1)").addClass("active");
		}
		// .pricing_list_grid .pricing_grid_row div.option_column
	}
	
	function selectPriceOption(option_id){
		var column_id = option_id + 1;
		$(".swap_item.active .mobile_pricing_nav span").removeClass("active")
		$(".swap_item.active .mobile_pricing_nav span").eq(option_id).addClass('active');
		
		$(".swap_item.active .pricing_grid_row.content_row div.option_column").removeClass("active");
		$(".swap_item.active .pricing_grid_row.content_row div.option_column.column_" + option_id).addClass("active");
		
		$(".mobile_nav_swap_wrapper.active .mobile_pricing_nav span").removeClass("active");
		$(".mobile_nav_swap_wrapper.active .mobile_pricing_nav span").eq(option_id).addClass("active");
		
		return false;
	}
	
	function initStickyMenu(){
		var item_offset = $("#deck_1b").offset(); console.log(item_offset);
		mobile_pricing_nav_top = item_offset.top + $(window).height() * 1.25;
		var top_string = 'top -' + mobile_pricing_nav_top;
		console.log(top_string + " : " + mobile_pricing_nav_top);

		ScrollTrigger.create({
		  start: top_string,
		  end: 99999,
		  toggleClass: {className: 'static_mobile_menu', targets: 'body'}
		}); 
		
		
		

	}
</script>















