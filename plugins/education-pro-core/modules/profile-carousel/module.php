<?php
namespace EpElements\Modules\ProfileCarousel;

use EpElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'ep-profile-carousel';
	}

	public function get_widgets() {
		$widgets = [
			'ProfileCarousel',
		];

		return $widgets;
	}
}
