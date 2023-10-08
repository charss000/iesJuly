<?php
namespace EpElements\Modules\IconBox;

use EpElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'ep-icon-box';
	}

	public function get_widgets() {
		$widgets = [
			'IconBox',
		];

		return $widgets;
	}
}
