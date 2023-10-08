<?php
namespace EpElements\Modules\Classes;

use EpElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'ep-classes';
	}

	public function get_widgets() {
		$widgets = [
			'Classes',
		];

		return $widgets;
	}
}
