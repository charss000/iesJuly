<?php
namespace EpElements\Modules\PostCarousel;

use EpElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'ep-post-carousel';
	}

	public function get_widgets() {
		$widgets = [
			'PostCarousel',
		];

		return $widgets;
	}
}
