<?php // phpcs:ignore
/**
 * Modal for editing an existing schedule.
 *
 * @package snapshot
 */

use WPMUDEV\Snapshot4\Helper;
use WPMUDEV\Snapshot4\Helper\Api;
use WPMUDEV\Snapshot4\Helper\Str;

$is_pro = \WPMUDEV\Snapshot4\Helper\Api::is_pro();

$assets        = new \WPMUDEV\Snapshot4\Helper\Assets();
$settings_link = network_admin_url( 'options-general.php' );

$hours        = Helper\Datetime::get_hour_list();
$profile      = Api::get_dashboard_profile();
$masked_email = Str::mask_email( $profile['user_name'] );
?>

<div class="sui-modal sui-modal-md">
	<div role="dialog"
		id="modal-snapshot-export-backup"
		class="sui-modal-content"
		aria-modal="true"
		aria-labelledby="modal-snapshot-export-backup-title"
		aria-describedby="modal-snapshot-export-backup-description">
		<div class="sui-box" style="margin-bottom: 0;">
			<div class="sui-box-header sui-flatten sui-content-center">
				<figure class="sui-box-banner" role="banner" aria-hidden="true">
					<img src="<?php echo esc_attr( $assets->get_asset( 'img/export-backup-header.png' ) ); ?>"
						srcset="<?php echo esc_attr( $assets->get_asset( 'img/export-backup-header.png' ) ); ?> 1x,
						<?php echo esc_attr( $assets->get_asset( 'img/export-backup-header@2x.png' ) ); ?> 2x" />
				</figure>
				<button class="sui-button-icon sui-button-float--right" data-modal-close>
					<span class="sui-icon-close sui-md" aria-hidden="true"></span>
				</button>
				<h3 class="sui-box-title sui-lg" id="modal-snapshot-export-backup-title">
					<?php esc_html_e( 'Export Backup', 'snapshot' ); ?>
				</h3>
			</div>
			<div class="sui-box-body">
				<form action="#" id="snapshot-export-form">
					<input type="hidden" name="snapshot_id" id="snapshot--backup__id" value="">
					<div class="sui-tabs sui-side-tabs">
						<div role="tablist" class="sui-tabs-menu">
							<buttton
								type="button"
								id="send-mail__tab"
								class="sui-tab-item"
								role="tab"
								aria-controls="send-mail__content"
								aria-selected="false"><?php esc_html_e( 'Send to mail', 'snapshot' ); ?></buttton>
							<button
								type="button"
								id="direct-download__tab"
								role="tab"
								aria-selected="true"
								aria-controls="direct-download__content"
								class="sui-tab-item active"><?php esc_html_e( 'Direct Download', 'snapshot' ); ?></button>
						</div>

						<div class="sui-tabs-content" style="margin-top: 30px;">
							<div
								role="tabpanel"
								id="send-mail__content"
								class="sui-tab-content"
								aria-labelledby="send-mail__tab"
								tabindex="0">
								<div class="sui-border-frame" style="padding: 25px 20px;">
									<div class="sui-form-field" role="radiogroup">
										<label for="default-email" class="sui-radio">
											<input
												type="radio"
												name="send-to-mail"
												id="default-email"
												aria-labelledby="radio-label-default-mail"
												checked="checked"
												value="default-mail"
												aria-controls="default-email__content"/>
											<span aria-hidden="true"></span>
											<span id="radio-label-default-mail"><?php esc_html_e( 'Default mail', 'snapshot' ); ?></span>
										</label>
										<label for="different-email" class="sui-radio">
											<input
												type="radio"
												name="send-to-mail"
												id="different-email"
												aria-labelledby="radio-label-different-mail"
												value="different-mail"
												aria-controls="different-email__content" />
											<span aria-hidden="true"></span>
											<span id="radio-label-different-mail"><?php esc_html_e( 'Use different email', 'snapshot' ); ?></span>
										</label>
									</div>

									<div class="sui-form-field">
										<div class="default-email__content active">
											<p class="sui-description">
											<?php
											/* translators: Masked email address */
											printf( __( 'The backup will be sent to the default email address <strong>%s</strong>.', 'snapshot' ), $masked_email );
											?>
											</p>
										</div>
										<div class="different-email__content" style="display: none;">
											<p class="sui-description"><?php esc_html_e( 'The backup will be sent to the following email address', 'snapshot' ); ?></p>
											<div class="sui-form-field">
												<label class="sui-label"><?php esc_html_e( 'Enter different email address', 'snapshot' ); ?></label>
												<input class="sui-form-control" placeholder="<?php esc_attr_e( 'Enter the new email', 'snapshot' ); ?>" type="email" name="email-address" />
												<span id="email-address--error_message" class="sui-error-message" style="display: none;" role="alert"><?php esc_html_e( 'Please enter valid email.', 'snapshot' ); ?></span>
											</div>
										</div>
									</div>

									<div class="sui-notice sui-notice-info">
										<div class="sui-notice-content" style="padding: 11px 17px;">
											<div class="sui-notice-message">
												<span class="sui-notice-icon sui-icon-warning-alert sui-md" aria-hidden="true"></span>
												<p><?php esc_html_e( 'The following process might take a while. Once it is complete, you will be sent an email with instructions for accessing and downloading the backup.', 'snapshot' ); ?></p>
											</div>
										</div>
									</div>
								</div>

								<div class="snapshot-actions-pane sui-block-content-center">
									<button type="button" class="sui-button sui-button-blue snapshot--send__email">
										<span class="sui-icon-send" aria-hidden="true"></span><?php esc_html_e( 'Send to mail', 'snapshot' ); ?>
									</button>
								</div>
							</div>
							<div
								role="tabpanel"
								id="direct-download__content"
								class="sui-tab-content active"
								aria-labelledby="direct-download__tab"
								tabindex="0">
								<div class="sui-border-frame" style="padding: 25px 20px;">
									<p class="sui-description"><?php esc_html_e( 'We will initiate the collection of files and database and you will be notified when the backup is available for download.', 'snapshot' ); ?></p>

									<div class="sui-notice sui-notice-info">
										<div class="sui-notice-content" style="padding: 11px 17px;">
											<div class="sui-notice-message">
												<span class="sui-notice-icon sui-icon-warning-alert sui-md" aria-hidden="true"></span>
												<p><?php esc_html_e( 'Generating the download link may take 15-30 minutes depending on the backup size. Please note that the download link will remain valid for 7 days.', 'snapshot' ); ?></p>
											</div>
										</div>
									</div>
								</div>

								<div class="snapshot-actions-pane sui-block-content-center">
									<button type="button" class="sui-button sui-button-blue snapshot--direct__download">
										<span class="sui-icon-send" aria-hidden="true"></span><?php esc_html_e( 'Start the process' ); ?>
									</button>
								</div>
							</div>
						</div>
					</div>
				</form>

			</div>
		</div>
	</div>
</div>