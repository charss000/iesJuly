<?php
namespace EpElements\Modules\Countdown;

use EpElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'ep-countdown';
	}

	public function get_widgets() {
		$widgets = [
			'Countdown',
		];

		return $widgets;
	}
}
