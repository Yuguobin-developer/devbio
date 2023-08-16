<?php



/**

 * Template name: FAQ Template

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
    <div class="webwrapper">
            <?php echo wpautop($post->post_content); ?>
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
			
    </main>
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















