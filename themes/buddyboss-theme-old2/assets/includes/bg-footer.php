<?php $user = wp_get_current_user(); ?><footer class="<?php if($user->exists()){echo "logged_in";} ?>">
					<div class="webwrapper">
						<div class="grid grid_1_1">
							<div>
								<p><a href="<?php echo site_url(); ?>" class="logo"></a></p>
								<p><a href="<?php echo site_url(); ?>" class="button button_2">Contact us now</a></p>
							</div>
							<div>
								<p>Sign up for the latest updates!</p>
								<div class="sign_up_form">
									<div>
										<input type="email" placeholder="Email Address" />
									</div>
									<div>
										<a href="#" class="button white_button">Subscribe</a>
									</div>
								</div>
							</div>
						</div>
						
						<div class="separation"></div>
						<div class="grid grid_1_1 grid_align_bottom no_bottom_margin">
							<div>
								<?php
                $defaults = array(
                    'theme_location'  => '',
                    'menu'            => 'footer menu',
                    'container'       => 'div',
                    'container_class' => 'footer_menu',
                    'container_id'    => 'footer_menu',
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
							<div class="rightalign">
								<p class="small_font">Powered by BiogasWorld<br/>&copy; <?php echo date("Y"); ?> All Rights Reserved Biogas Community</p>
							</div>
						</div>
					</div>
	</footer>