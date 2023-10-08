<?php
namespace EpElements\Modules\Profile;

use EpElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'ep-profile';
	}

	public function get_widgets() {
		$widgets = [
			'Profile',
		];

		return $widgets;
	}
}
