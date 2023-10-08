<?php
namespace EpElements\Modules\CallToAction;

use EpElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'ep-call-to-action';
	}

	public function get_widgets() {
		$widgets = [
			'CallToAction',
		];

		return $widgets;
	}
}
