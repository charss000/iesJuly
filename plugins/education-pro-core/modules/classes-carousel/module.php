<?php
namespace EpElements\Modules\ClassesCarousel;

use EpElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'ep-classes-carousel';
	}

	public function get_widgets() {
		$widgets = [
			'ClassesCarousel',
		];

		return $widgets;
	}
}
