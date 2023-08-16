<?php
/**  Template Name: About Template
* The Template for displaying product archives, including the main shop page which is a post type archive
*
* This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
*
* HOWEVER, on occasion WooCommerce will need to update template files and you
* (the theme developer) will need to copy the new files to your theme to
* maintain compatibility. We try to do this as little as possible, but it does
* happen. When this occurs the version of the template file will be bumped and
* the readme will list any important changes.
*
* @see 	    https://docs.woothemes.com/document/template-structure/
* @author 		WooThemes
* @package 	WooCommerce/Templates
* @version     2.0.0
*/
//
$user = wp_get_current_user();
 
	

$items = get_field("items");
$text_block = get_field("text_block");
$js = array("slick.js");
$css = array("bg-list.css","about.css");
include(get_template_directory() . "/assets/includes/bg-head.php"); 

?><body>
<?php 	include(get_template_directory() . "/assets/includes/bg-masthead.php");  ?>
	<div class="pageblock">
		<div class="pagewrapper">
			<div class="deck deck_top_page" id="deck_1">
			    <div class="deck_background">
			        <div class="bubble"></div>
			        <div class="bubble"></div>
			        <div class="bubble"></div>
			    </div>
				<div class="webwrapper">
					<div class="box_background" style="background: url(<?php echo $items[0]['image']['url']; ?>) no-repeat;"></div>
					<div class="text_wrapper top_box">
						<?php echo wpautop($post->post_content); ?>
					</div>
					
				</div>
			</div><?php $items = get_field("items"); ?>
			<div class="deck" id ="deck_2">
				<div class="webwrapper">
					<div class="grid grid_1_1">
						<div class="">
							
						<div class="text_wrapper ">
							<?php echo wpautop($items[0]['text_1']); ?>
						</div>
						
						</div>
						<div class="">
							
						<div class="text_wrapper ">
							<?php echo wpautop($items[0]['text_2']); ?>
						</div>
						
						</div>
					</div>
				</div>
			</div>
			<div class="deck" id="deck_2_2">
			    <?php $carousel = get_field("carousel");  ?>
			    <?php if(!empty($carousel)): ?>
			    <div class="carousel_wrapper" id="carousel_wrapper">
			        <?php foreach($carousel as $c): ?>
			        <div class="item box">
			            <div class="item_background" style="background: url(<?php echo $c['image']['url']; ?>) no-repeat;"></div>
			            <div class="grid grid_1_1">
			                <div><?php echo wpautop($c['text']); ?></div>
			            <div><div class="imgwrapper box" style="background: url(<?php echo $c['image']['url']; ?>) no-repeat;"></div></div>
			            </div>
			        </div>
			        <?php endforeach; ?>
			        
			    </div>
			    <?php endif; ?>
			    <div class="drag_cursor"><span>Drag</span></div>
			</div>
			<div class="deck" id="deck_2_3">
			    <div class="webwrapper">
			        <?php echo wpautop($items[1]['text_1']); ?> 
			        <div class="grid grid_1_2_2">
			            <div></div>
			            <div><?php echo wpautop($items[2]['text_1']); ?></div>
			            <div><?php echo wpautop($items[2]['text_2']); ?></div>
			        </div>
			    </div>
			</div>
			
			<div class="deck" id="deck_4">
				<div class='webwrapper '>
					<div class="grid grid_1_1">
						<div>
							<?php echo wpautop($items[3]['text_1']); ?>
						</div>
						<div>
							<?php echo wpautop($items[3]['text_2']); ?>
						</div>
					</div>
					<div class="grid grid_1_1_1">
						<div class="box">
							<div>
								<?php echo wpautop($items[4]['text_1']); ?>
							</div>
							<div>
								<?php echo wpautop($items[4]['text_2']); ?>
							</div>
							
						</div>
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
					</div>
				</div>
			</div>
			<div class="deck" id="deck_7">
				<div class="webwrapper">
					<div class="box light_green box_round">
						<div class="box_background" style="background: url(<?php echo $items[7]['image']['url']; ?>) no-repeat;"></div>
						<div class="text_wrapper">
							<?php echo wpautop($items[7]['text_1']); ?>
						</div>
					</div>
				</div>
			</div>
		<?php include(get_template_directory() . "/assets/includes/bg-footer.php");  ?>
			
		</div>
	</div><div class="toggle_mobile_menu" onclick="jQuery('body').toggleClass('show_menu');"></div>
	<div class="mobile_menu_wrapper">
		<div class="scroll_wrapper">
			<div class="scroll_content">
				<?php
                $defaults = array(
                    'theme_location'  => '',
                    'menu'            => 'main menu short',
                    'container'       => 'div',
                    'container_class' => 'main_menu_mobile',
                    'container_id'    => 'main_menu_mobile',
                    'menu_class'      => 'menu',
                    'menu_id'         => '',
                    'echo'            => true,
                    'fallback_cb'     => 'wp_page_menu',
                    'before'          => '',
                    'after'           => '',
                    'link_before'     => '',
                    'link_after'      => '',
                    'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                    'depth'           => 0,
                    'walker'          => ''
                );
                
                wp_nav_menu( $defaults );
            ?> 
			</div>
		</div>
		<div class="mobile_nav">
				<a href="#" class="button">Log in</a> <a href="#" class="button button_2">Sign up</a>
			</div>
	</div>
	<script>
	var $circle = new Object();
jQuery(document).ready(function(){
    $circle = $("#deck_2_2 .drag_cursor");
	$('#carousel_wrapper').slick({
		  infinite: true,
		  centerMode: true,
            centerPadding: '50px',
		  slidesToShow: 2,
		  slidesToScroll: 1,
		  autoplay: true,
            autoplaySpeed: 5000,
		responsive: [
			 {
				  breakpoint: 1480,
				  settings: {
					slidesToShow: 1,
					slidesToScroll: 1
					
				  }
			}
		]
		});
	
	//adjustSlickHeight();
	//positionSliderNav();
	
	jQuery(window).resize(function(){
		$('.slick-initialized .slick-slide').css({"height" : "initial"});
		setTimeout(function(){adjustSlickHeight();},500);
		positionSliderNav();
		
	});
	
	$(window).on('mousemove', moveCircle);
	
});
	
	
	function moveCircle(e) {
TweenLite.to($circle, 0, {
    css: {
      left: e.pageX,
      top: e.pageY - 150
    }
  });
}
		
	function adjustSlickHeight(){
		var slickHeight = $('.slider_wrapper').height();
		//$('.slick-initialized .slick-slide').css({"height" : slickHeight + 'px'});
		
	}
	/*	
	function positionSliderNav(){
		var wWidth = $(window).width();
		var topMargin = 100;
		if(wWidth < 600){topMargin = 20;}
		var sliderPos = jQuery(".slider_wrapper").position();
		var sliderNavTop = (sliderPos.top - 40 + topMargin) * -1;
		$(".slick-arrow.slick-next").css({"top" : sliderNavTop + "px"});
		$(".slick-arrow.slick-prev").css({"top" : sliderNavTop + "px"});
	} */
	
	</script>

	</body>



