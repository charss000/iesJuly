<?php
namespace EpElements\Modules\Popup;

use EpElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'ep-popup';
	}

	public function get_widgets() {
		$widgets = [
			'Popup',
		];

		return $widgets;
	}
}
