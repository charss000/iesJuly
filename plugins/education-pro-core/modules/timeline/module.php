<?php
namespace EpElements\Modules\Timeline;

use EpElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'ep-timeline';
	}

	public function get_widgets() {
		$widgets = [
			'Timeline',
		];

		return $widgets;
	}
}
