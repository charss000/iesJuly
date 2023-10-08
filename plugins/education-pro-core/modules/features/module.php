<?php
namespace EpElements\Modules\Features;

use EpElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'ep-features';
	}

	public function get_widgets() {
		$widgets = [
			'Features',
		];

		return $widgets;
	}
}
