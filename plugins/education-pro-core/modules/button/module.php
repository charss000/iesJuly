<?php
namespace EpElements\Modules\Button;

use EpElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'ep-button';
	}

	public function get_widgets() {
		$widgets = [
			'Button',
		];

		return $widgets;
	}
}
