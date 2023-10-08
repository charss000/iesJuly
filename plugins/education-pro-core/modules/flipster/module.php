<?php
namespace EpElements\Modules\Flipster;

use EpElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'ep-flipster';
	}

	public function get_widgets() {
		$widgets = [
			'Flipster',
		];

		return $widgets;
	}
}
