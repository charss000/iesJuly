<?php
namespace EpElements\Modules\CircleProgressBar;

use EpElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'ep-circle-progress-bar';
	}

	public function get_widgets() {
		$widgets = [
			'CircleProgressBar',
		];

		return $widgets;
	}
}
