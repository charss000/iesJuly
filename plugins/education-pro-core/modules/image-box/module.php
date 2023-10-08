<?php
namespace EpElements\Modules\ImageBox;

use EpElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'ep-image-box';
	}

	public function get_widgets() {
		$widgets = [
			'ImageBox',
		];

		return $widgets;
	}
}
