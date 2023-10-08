<?php
namespace EpElements\Modules\Courses;

use EpElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'ep-courses';
	}

	public function get_widgets() {
		$widgets = [
			'Courses',
		];

		return $widgets;
	}
}
