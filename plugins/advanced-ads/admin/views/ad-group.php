<?php
/**
 * Renders the ad group page in WP Admin
 *
 * @package   Advanced_Ads_Admin
 * @author    Thomas Maier <support@wpadvancedads.com>
 * @license   GPL-2.0+
 * @link      https://wpadvancedads.com
 * @copyright since 2013 Thomas Maier, Advanced Ads GmbH
 *
 * @var WP_List_Table|false $wp_list_table the groups list table
 * @var WP_Taxonomy         $tax ad group taxonomy
 * @var bool                $is_search true if a group is searched.
 */

$ad_groups_list = new Advanced_Ads_Groups_List();

?>
<div class="wrap">
<?php
// create new group.
if ( isset( $_REQUEST['advads-group-add-nonce'] ) ) {
	$create_result = $ad_groups_list->create_group();
	// display error message.
	if ( is_wp_error( $create_result ) ) {
		// potential error comes from WP_Error and is no user input.
		// phpcs:ignore
		$error_string = $create_result->get_error_message();
		echo '<div id="message" class="error inline"><p>' . esc_html( $error_string ) . '</p></div>';
	} else {
		echo '<div id="message" class="updated inline"><p>' . esc_html__( 'Ad Group successfully created', 'advanced-ads' ) . '</p></div>';
	}
}
// save updated groups.
if ( isset( $_REQUEST['advads-group-update-nonce'] ) ) {
	$udpate_result = $ad_groups_list->update_groups();
	// display error message.
	if ( is_wp_error( $udpate_result ) ) {
		$error_string = $udpate_result->get_error_message();
		// potential error comes from WP_Error and is no user input.
		// phpcs:ignore
		echo '<div id="message" class="error inline"><p>' . $error_string . '</p></div>';
	} else {
		echo '<div id="message" class="updated inline"><p>' . esc_html__( 'Ad Groups successfully updated', 'advanced-ads' ) . '</p></div>';
	}
}
?>
</div>
<?php

$last_edited_group_id = 0;
if ( isset( $_REQUEST['advads-last-edited-group'] ) ) {
	$last_edited_group_id = $_REQUEST['advads-last-edited-group'];
	?>
	<script>
		var body = document.getElementsByTagName("body")[0];
		body.addEventListener("load", function(){
			jQuery('#advads-ad-group-<?php echo esc_attr( $last_edited_group_id ); ?>').get(0).scrollIntoView(false);
		}, true);
	</script>
	<?php
}

?>
<div class="wrap nosubsub">
	<h2 style="display: none;"><!-- There needs to be an empty H2 headline at the top of the page so that WordPress can properly position admin notifications --></h2>
	<form id="advads-new-group-form" action="" method="post" style="display:none;">
		<?php wp_nonce_field( 'add-advads-groups', 'advads-group-add-nonce' ); ?>
		<input type="text" name="advads-group-name" placeholder="<?php esc_attr_e( 'Group title', 'advanced-ads' ); ?>"/>
		<input class="button button-primary" type="submit" value="<?php esc_attr_e( 'save', 'advanced-ads' ); ?>"/>
	</form>
	<p>
		<?php
		esc_attr_e( 'Ad Groups are a very flexible method to bundle ads. You can use them to display random ads in the frontend or run split tests, but also just for informational purposes. Not only can an Ad Groups have multiple ads, but an ad can belong to multiple ad groups.', 'advanced-ads' );
		?>
		 <a href="<?php echo esc_url( ADVADS_URL ) . 'manual/ad-groups/?utm_source=advanced-ads&utm_medium=link&utm_campaign=groups'; ?>" target="_blank" class="advads-manual-link"><?php esc_html_e( 'Manual', 'advanced-ads' ); ?></a>
	</p>
	<?php if ( isset( $message ) ) : ?>
		<div id="message" class="updated"><p><?php echo esc_html( $message ); ?></p></div>
		<?php
		$_SERVER['REQUEST_URI'] = esc_url( remove_query_arg( array( 'message' ), wp_unslash( $_SERVER['REQUEST_URI'] ) ) );
	endif;
	?>
	<div id="ajax-response"></div>

	<div id="col-container">
		<div class="col-wrap">
			<div class="tablenav top <?php echo $is_search ? '' : 'hidden advads-toggle-with-filters-button'; ?>" style="padding-bottom: 20px;">
				<?php
				if ( $is_search ) {
					printf( '<span class="subtitle" style="float:left;">' . __( 'Search results for: %s' ) . '</span>', '<strong>' . esc_html( wp_unslash( $_REQUEST['s'] ) ) . '</strong>' );
				}
				?>
				<form class="search-form" action="" method="get">
					<input type="hidden" name="page" value="advanced-ads-groups"/>
					<?php
					$wp_list_table->search_box( $tax->labels->search_items, 'tag' );
					?>
				</form>
			</div>
			<div id="advads-ad-group-list">
				<form action="" method="post" id="advads-form-groups">
					<?php wp_nonce_field( 'update-advads-groups', 'advads-group-update-nonce' ); ?>
					<table class="wp-list-table widefat fixed adgroups">
						<?php $ad_groups_list->render_header(); ?>
						<?php $ad_groups_list->render_rows(); ?>
					</table>
			<input type="hidden" name="advads-last-edited-group" id="advads-last-edited-group" value="<?php echo esc_attr( $last_edited_group_id ); ?>"/>
					<div class="tablenav bottom">
						<?php submit_button( __( 'Update Groups', 'advanced-ads' ) ); ?>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
