<?php
namespace EpElements\Modules\NewsTicker;

use EpElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'ep-news-ticker';
	}

	public function get_widgets() {
		$widgets = [
			'NewsTicker',
		];

		return $widgets;
	}
}
