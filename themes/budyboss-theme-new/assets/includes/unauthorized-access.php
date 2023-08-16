<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/unauthorized.css?id=<?php echo rand(1000,9999); ?>" /><?php
    $auth_text_blocks = get_field("text_block"); 
?>
<div class="unauthorized_box">
    <div class="grid grid_1_1">
        <div>
            <div class="box khaki_green warning">
                <?php echo wpautop($auth_text_blocks[0]['text']); ?>
                <div class="warning_sign">!</div>
            </div>
            
        </div>
        <div><?php
            $user = wp_get_current_user();
            if($user->exists()): // if user exists ?>
            <div class="box khaki_green">
                <div class="box_background" style="background: url(<?php $img = wp_get_attachment_image_src(2949, "url", false); echo $img[0]; ?>) no-repeat;"></div>
                <div class="textwrapper">
                    <?php echo wpautop($auth_text_blocks[1]['text']);  ?>
                </div>
            </div>
            
            <?php else: // if user does not exists ?>
            <div class="box white_box">
                <h2 class="align_center">Sign in</h2>
                <hr>
                <?php 
                    $form_args = array(
                        "label_username" => "",
                        "label_password" => ""
                    );
                    $form = wp_login_form($form_args);
                    echo $form;
                    
                    
                ?>
                <span class="centeralign"><?php echo wpautop($auth_text_blocks[3]['text']); ?></span>
            </div>
            <div class="box light_green">
                <div class="box_background" style="background: url(<?php $img = wp_get_attachment_image_src(2948, "url", false); echo $img[0]; ?>) no-repeat;"></div>
                <div class="textwrapper">
                    <?php echo wpautop($auth_text_blocks[2]['text']); ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>