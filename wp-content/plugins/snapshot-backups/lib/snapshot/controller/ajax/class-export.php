<?php // phpcs:ignore
/**
 * Snapshot controllers: Backup export AJAX controller class
 *
 * @package snapshot
 */

namespace WPMUDEV\Snapshot4\Controller\Ajax;

use WPMUDEV\Snapshot4\Controller;
use WPMUDEV\Snapshot4\Task;
use WPMUDEV\Snapshot4\Model;
use WPMUDEV\Snapshot4\Helper\Log;

/**
 * Backup export AJAX controller class
 */
class Export extends Controller\Ajax {

	/**
	 * Boots the controller and sets up event listeners.
	 */
	public function boot() {
		if ( ! is_admin() ) {
			return false;
		}

		// Request the service actions regarding backup schedules.
		add_action( 'wp_ajax_snapshot-export_backup', array( $this, 'json_export_backup' ) );
	}

	/**
	 * Handles requesting the service for backup export.
	 */
	public function json_export_backup() {
		$this->do_request_sanity_check( 'snapshot_export_backup', self::TYPE_POST );

		$data = array(
			'backup_id'     => isset( $_POST['backup_id'] ) ? $_POST['backup_id'] : null, // phpcs:ignore
		);

		$task = new Task\Request\Export();

		$validated_data = $task->validate_request_data( $data );

		if ( is_wp_error( $validated_data ) ) {
			wp_send_json_error( $validated_data );
		}

		$args = $validated_data;

		// We're always setting `send_email` flag as true.
		$args['send_email'] = true;

		if ( isset( $_POST['email_address'] ) && ! empty( $_POST['email_address'] ) ) {
			$args['email_account'] = sanitize_email( wp_unslash( $_POST['email_address'] ) );
		}

		$args['request_model'] = new Model\Request\Export();
		$result                = $task->apply( $args );

		if ( $task->has_errors() ) {
			foreach ( $task->get_errors() as $error ) {
				Log::error( $error->get_error_message() );
			}
			wp_send_json_error();
		}

		if ( isset( $_POST['direct_download'] ) &&
			isset( $_POST['send_email'] ) &&
			'0' === $_POST['send_email'] &&
			array_key_exists( 'export_id', $result ) ) {
			set_site_transient( 'snapshot_direct_download_export_' . $args['backup_id'], $result['export_id'], DAY_IN_SECONDS );
		}

		wp_send_json_success(
			array(
				'api_response' => $result,
				'site'         => esc_html( wp_parse_url( get_site_url(), PHP_URL_HOST ) ),
			)
		);
	}
}