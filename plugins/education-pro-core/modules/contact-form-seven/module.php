<?php
namespace EpElements\Modules\ContactFormSeven;

use EpElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'ep-contact-form-7';
	}

	public function get_widgets() {
		$widgets = [
			'ContactFormSeven',
		];

		return $widgets;
	}
}
