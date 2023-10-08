<?php
namespace EpElements\Modules\WoocommerceGrid;

use EpElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'ep-woocommerce-grid';
	}

	public function get_widgets() {
		$widgets = [
			'WoocommerceGrid',
		];

		return $widgets;
	}
}
