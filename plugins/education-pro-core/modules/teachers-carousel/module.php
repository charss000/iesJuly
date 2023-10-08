<?php
namespace EpElements\Modules\TeachersCarousel;

use EpElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'ep-teachers-carousel';
	}

	public function get_widgets() {
		$widgets = [
			'TeachersCarousel',
		];

		return $widgets;
	}
}
