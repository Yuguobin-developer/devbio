<?php 
$wp_user = wp_get_current_user();

?><div id="masthead" class="splash_head">
		<div class="webwrapper">
			<a href="#" class="logo"></a><?php if(true): ?>
			<div id="middle_menu">
				<?php
				$menuname = "short menu";
            $defaults = array(
                'theme_location'  => '',
                'menu'            => $menuname,
                'container'       => 'div',
                'container_class' => '',
                'container_id'    => 'short_menu',
                'menu_class'      => 's_menu',
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
			<?php endif; ?>
			<div class="right_nav">
				<a href="<?php echo site_url(); ?>/wp-login.php" class="button button_3">Log in</a> <a href="<?php echo site_url(); ?>/register/" class="button ">Sign up</a>
			</div>
		</div>
	</div>