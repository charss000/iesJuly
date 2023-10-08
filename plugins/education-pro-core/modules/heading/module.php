<?php
namespace EpElements\Modules\Heading;

use EpElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'ep-heading';
	}

	public function get_widgets() {
		$widgets = [
			'Heading',
		];

		return $widgets;
	}
}
