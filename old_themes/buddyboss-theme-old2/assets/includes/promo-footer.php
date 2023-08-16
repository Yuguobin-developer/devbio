<?php $user = wp_get_current_user(); $items = get_field("footer_items"); ?><div class="deck <?php if($user->exists()){echo "logged_in";} ?>" id ="promo_footer">
				<div class="webwrapper">
					<div class="grid grid_1_1_1">
						<div class="box dark_green">
							<div class="box_background" style="background: url(<?php echo $items[0]['image']['url']; ?>) no-repeat;"></div>
						<div class="text_wrapper top_box">
							<?php echo wpautop($items[0]['text_1']); ?>
						</div>
						<div class="text_wrapper bottom_box">
							<?php echo wpautop($items[0]['text_2']); ?>
						</div>
						</div>
						<div class="box dark_green">
							<div class="box_background" style="background: url(<?php echo $items[1]['image']['url']; ?>) no-repeat;"></div>
						<div class="text_wrapper top_box">
							<?php echo wpautop($items[1]['text_1']); ?>
						</div>
						<div class="text_wrapper bottom_box">
							<?php echo wpautop($items[1]['text_2']); ?>
						</div>
						</div>
						<div class="box dark_green">
							<div class="box_background" style="background: url(<?php echo $items[2]['image']['url']; ?>) no-repeat;"></div>
						<div class="text_wrapper top_box">
							<?php echo wpautop($items[2]['text_1']); ?>
						</div>
						<div class="text_wrapper bottom_box">
							<?php echo wpautop($items[2]['text_2']); ?>
						</div>
						</div>
					</div>
				</div>
			</div>