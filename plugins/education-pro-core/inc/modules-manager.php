<?php
namespace EpElements;

final class ModuleManager {
	/**
	 * @var Module_Base[]
	 */
	private $modules = [];

	public function __construct() {
		$modules = [
			'animated-heading',
			'button',
			'call-to-action',
			'circle-progress-bar',
			'classes',
			'classes-carousel',
			'contact-form-seven',
			'countdown',
			'courses',
			'courses-carousel',
			'features',
			'flip-box',
			'flipster',
			'heading',
			'icon-box',
			'image-box',
			'image-hover',
			'news-ticker',
			'popup',
			'post-carousel',
			'post-grid',
			'post-list',
			'post-tiled',
			'price-menu',		
			'price-table',
			'profile',
			'profile-carousel',
			'table',
			'teachers',
			'teachers-carousel',
			'testimonial',
			'timeline',
			'woocommerce-carousel',
			'woocommerce-grid'
		];

		foreach ( $modules as $module_name ) {
			$class_name = str_replace( '-', ' ', $module_name );
			$class_name = str_replace( ' ', '', ucwords( $class_name ) );
			$class_name = __NAMESPACE__ . '\\Modules\\' . $class_name . '\Module';

			
			if ( $class_name::is_active() ) {
				$this->modules[ $module_name ] = $class_name::instance();
			}
		}
	}

	/**
	 * @param string $module_name
	 *
	 * @return Module_Base|Module_Base[]
	 */
	public function get_modules( $module_name ) {
		if ( $module_name ) {
			if ( isset( $this->modules[ $module_name ] ) ) {
				return $this->modules[ $module_name ];
			}

			return null;
		}

		return $this->modules;
	}
}

