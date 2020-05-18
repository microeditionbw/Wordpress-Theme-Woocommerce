<?php if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.
/**
 *
 * Get icons from admin ajax
 *
 * @since 1.0.0
 * @version 1.0.0
 */
if ( ! function_exists( 'spwps_get_icons' ) ) {
	function spwps_get_icons() {

		$nonce = ( ! empty( $_POST['nonce'] ) ) ? sanitize_text_field( wp_unslash( $_POST['nonce'] ) ) : '';

		if ( ! wp_verify_nonce( $nonce, 'spwps_icon_nonce' ) ) {
			wp_send_json_error( array( 'error' => esc_html__( 'Error: Nonce verification has failed. Please try again.', 'woo-product-slider' ) ) );
		}

		ob_start();

		$icon_library = ( apply_filters( 'spwps_fa4', false ) ) ? 'fa4' : 'fa5';

		SPWPS::include_plugin_file( 'fields/icon/' . $icon_library . '-icons.php' );

		$icon_lists = apply_filters( 'spwps_field_icon_add_icons', spwps_get_default_icons() );

		if ( ! empty( $icon_lists ) ) {

			foreach ( $icon_lists as $list ) {

				echo ( count( $icon_lists ) >= 2 ) ? '<div class="spwps-icon-title">' . esc_attr( $list['title'] ) . '</div>' : '';

				foreach ( $list['icons'] as $icon ) {
					echo '<i title="' . esc_attr( $icon ) . '" class="' . esc_attr( $icon ) . '"></i>';
				}
			}
		} else {

				echo '<div class="spwps-text-error">' . esc_html__( 'No data provided by developer', 'woo-product-slider' ) . '</div>';

		}

		$content = ob_get_clean();

		wp_send_json_success( array( 'content' => $content ) );

	}
	add_action( 'wp_ajax_spwps-get-icons', 'spwps_get_icons' );
}

/**
 *
 * Export
 *
 * @since 1.0.0
 * @version 1.0.0
 */
if ( ! function_exists( 'spwps_export' ) ) {
	function spwps_export() {

		$nonce  = ( ! empty( $_GET['nonce'] ) ) ? sanitize_text_field( wp_unslash( $_GET['nonce'] ) ) : '';
		$unique = ( ! empty( $_GET['unique'] ) ) ? sanitize_text_field( wp_unslash( $_GET['unique'] ) ) : '';

		if ( ! wp_verify_nonce( $nonce, 'spwps_backup_nonce' ) ) {
			die( esc_html__( 'Error: Nonce verification has failed. Please try again.', 'woo-product-slider' ) );
		}

		if ( empty( $unique ) ) {
			die( esc_html__( 'Error: Options unique id could not valid.', 'woo-product-slider' ) );
		}

		// Export
		header( 'Content-Type: application/json' );
		header( 'Content-disposition: attachment; filename=backup-' . gmdate( 'd-m-Y' ) . '.json' );
		header( 'Content-Transfer-Encoding: binary' );
		header( 'Pragma: no-cache' );
		header( 'Expires: 0' );

		echo json_encode( get_option( $unique ) );

		die();

	}
	add_action( 'wp_ajax_spwps-export', 'spwps_export' );
}

/**
 *
 * Import Ajax
 *
 * @since 1.0.0
 * @version 1.0.0
 */
if ( ! function_exists( 'spwps_import_ajax' ) ) {
	function spwps_import_ajax() {

		$nonce  = ( ! empty( $_POST['nonce'] ) ) ? sanitize_text_field( wp_unslash( $_POST['nonce'] ) ) : '';
		$unique = ( ! empty( $_POST['unique'] ) ) ? sanitize_text_field( wp_unslash( $_POST['unique'] ) ) : '';
		$data   = ( ! empty( $_POST['data'] ) ) ? wp_kses_post_deep( json_decode( wp_unslash( trim( $_POST['data'] ) ), true ) ) : array();

		if ( ! wp_verify_nonce( $nonce, 'spwps_backup_nonce' ) ) {
			wp_send_json_error( array( 'error' => esc_html__( 'Error: Nonce verification has failed. Please try again.', 'woo-product-slider' ) ) );
		}

		if ( empty( $unique ) ) {
			wp_send_json_error( array( 'error' => esc_html__( 'Error: Options unique id could not valid.', 'woo-product-slider' ) ) );
		}

		if ( empty( $data ) || ! is_array( $data ) ) {
			wp_send_json_error( array( 'error' => esc_html__( 'Error: Import data could not valid.', 'woo-product-slider' ) ) );
		}

		// Success
		update_option( $unique, $data );

		wp_send_json_success();

	}
	add_action( 'wp_ajax_spwps-import', 'spwps_import_ajax' );
}

/**
 *
 * Reset Ajax
 *
 * @since 1.0.0
 * @version 1.0.0
 */
if ( ! function_exists( 'spwps_reset_ajax' ) ) {
	function spwps_reset_ajax() {

		$nonce  = ( ! empty( $_POST['nonce'] ) ) ? sanitize_text_field( wp_unslash( $_POST['nonce'] ) ) : '';
		$unique = ( ! empty( $_POST['unique'] ) ) ? sanitize_text_field( wp_unslash( $_POST['unique'] ) ) : '';

		if ( ! wp_verify_nonce( $nonce, 'spwps_backup_nonce' ) ) {
			wp_send_json_error( array( 'error' => esc_html__( 'Error: Nonce verification has failed. Please try again.', 'woo-product-slider' ) ) );
		}

		// Success
		delete_option( $unique );

		wp_send_json_success();

	}
	add_action( 'wp_ajax_spwps-reset', 'spwps_reset_ajax' );
}

/**
 *
 * Chosen Ajax
 *
 * @since 1.0.0
 * @version 1.0.0
 */
if ( ! function_exists( 'spwps_chosen_ajax' ) ) {
	function spwps_chosen_ajax() {

		$nonce = ( ! empty( $_POST['nonce'] ) ) ? sanitize_text_field( wp_unslash( $_POST['nonce'] ) ) : '';
		$type  = ( ! empty( $_POST['type'] ) ) ? sanitize_text_field( wp_unslash( $_POST['type'] ) ) : '';
		$term  = ( ! empty( $_POST['term'] ) ) ? sanitize_text_field( wp_unslash( $_POST['term'] ) ) : '';
		$query = ( ! empty( $_POST['query_args'] ) ) ? wp_kses_post_deep( $_POST['query_args'] ) : array();

		if ( ! wp_verify_nonce( $nonce, 'spwps_chosen_ajax_nonce' ) ) {
			wp_send_json_error( array( 'error' => esc_html__( 'Error: Nonce verification has failed. Please try again.', 'woo-product-slider' ) ) );
		}

		if ( empty( $type ) || empty( $term ) ) {
			wp_send_json_error( array( 'error' => esc_html__( 'Error: Missing request arguments.', 'woo-product-slider' ) ) );
		}

		$capability = apply_filters( 'spwps_chosen_ajax_capability', 'manage_options' );

		if ( ! current_user_can( $capability ) ) {
			wp_send_json_error( array( 'error' => esc_html__( 'You do not have required permissions to access.', 'woo-product-slider' ) ) );
		}

		// Success
		$options = SPWPS_Fields::field_data( $type, $term, $query );

		wp_send_json_success( $options );

	}
	add_action( 'wp_ajax_spwps-chosen', 'spwps_chosen_ajax' );
}

/**
 *
 * Set icons for wp dialog
 *
 * @since 1.0.0
 * @version 1.0.0
 */
if ( ! function_exists( 'spwps_set_icons' ) ) {
	function spwps_set_icons() {
		?>
	<div id="spwps-modal-icon" class="spwps-modal spwps-modal-icon">
	  <div class="spwps-modal-table">
		<div class="spwps-modal-table-cell">
		  <div class="spwps-modal-overlay"></div>
		  <div class="spwps-modal-inner">
			<div class="spwps-modal-title">
			  <?php esc_html_e( 'Add Icon', 'woo-product-slider' ); ?>
			  <div class="spwps-modal-close spwps-icon-close"></div>
			</div>
			<div class="spwps-modal-header spwps-text-center">
			  <input type="text" placeholder="<?php esc_html_e( 'Search a Icon...', 'woo-product-slider' ); ?>" class="spwps-icon-search" />
			</div>
			<div class="spwps-modal-content">
			  <div class="spwps-modal-loading"><div class="spwps-loading"></div></div>
			  <div class="spwps-modal-load"></div>
			</div>
		  </div>
		</div>
	  </div>
	</div>
		<?php
	}
	add_action( 'admin_footer', 'spwps_set_icons' );
}
