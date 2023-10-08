<?php
namespace EpElements\Modules\Teachers;

use EpElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'ep-teachers';
	}

	public function get_widgets() {
		$widgets = [
			'Teachers',
		];

		return $widgets;
	}
}
