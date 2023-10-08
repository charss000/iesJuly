<?php
namespace EpElements\Modules\Testimonial;

use EpElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'ep-testimonial';
	}

	public function get_widgets() {
		$widgets = [
			'Testimonial',
		];

		return $widgets;
	}
}
