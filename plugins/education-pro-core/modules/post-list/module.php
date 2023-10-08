<?php
namespace EpElements\Modules\PostList;

use EpElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'ep-post-list';
	}

	public function get_widgets() {
		$widgets = [
			'PostList',
		];

		return $widgets;
	}
}
