<?php
namespace EpElements\Modules\PostTiled;

use EpElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'ep-post-tiled';
	}

	public function get_widgets() {
		$widgets = [
			'PostTiled',
		];

		return $widgets;
	}
}
