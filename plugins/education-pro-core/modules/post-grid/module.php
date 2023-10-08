<?php
namespace EpElements\Modules\PostGrid;

use EpElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'ep-post-grid';
	}

	public function get_widgets() {
		$widgets = [
			'PostGrid',
		];

		return $widgets;
	}
}
