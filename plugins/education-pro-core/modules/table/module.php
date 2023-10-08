<?php
namespace EpElements\Modules\Table;

use EpElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'ep-table';
	}

	public function get_widgets() {
		$widgets = [
			'Table',
		];

		return $widgets;
	}
}
