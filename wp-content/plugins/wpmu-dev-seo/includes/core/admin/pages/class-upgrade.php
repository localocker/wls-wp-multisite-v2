<?php
/**
 * Class Upgrade
 *
 * @package SmartCrawl
 */

namespace SmartCrawl\Admin\Pages;

if ( ! defined( 'WPINC' ) ) {
	die;
}

use SmartCrawl\Singleton;

class Upgrade extends Page {

	use Singleton;

	const MENU_SLUG = 'wds_upgrade';

	protected function init() {
	}

	public function get_menu_slug() {
		return '';
	}
}