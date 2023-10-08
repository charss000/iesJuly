<?php
namespace EpElements\Modules\WoocommerceCarousel;

use EpElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'ep-woocommerce-carousel';
	}

	public function get_widgets() {
		$widgets = [
			'WoocommerceCarousel',
		];

		return $widgets;
	}
}
