<?php
namespace EpElements;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class TX_Load {

	private static $_instance;

	private $_modules_manager;

	public static function elementor() {
		return \Elementor\Plugin::$instance;
	}

	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}
	
	private function _includes() {
		require TX_PLUGIN_PATH . 'inc/modules-manager.php';
		require TX_PLUGIN_PATH . 'inc/helper.php';
	}

	public function autoload( $class ) {
		if ( 0 !== strpos( $class, __NAMESPACE__ ) ) {
			return;
		}

		$has_class_alias = isset( $this->classes_aliases[ $class ] );

		// Backward Compatibility: Save old class name for set an alias after the new class is loaded
		if ( $has_class_alias ) {
			$class_alias_name = $this->classes_aliases[ $class ];
			$class_to_load = $class_alias_name;
		} else {
			$class_to_load = $class;
		}

		if ( ! class_exists( $class_to_load ) ) {
			$filename = strtolower(
				preg_replace(
					[ '/^' . __NAMESPACE__ . '\\\/', '/([a-z])([A-Z])/', '/_/', '/\\\/' ],
					[ '', '$1-$2', '-', DIRECTORY_SEPARATOR ],
					$class_to_load
				)
			);
			$filename = TX_PLUGIN_PATH . $filename . '.php';

			if ( is_readable( $filename ) ) {
				include( $filename );
			}
		}

		if ( $has_class_alias ) {
			class_alias( $class_alias_name, $class );
		}
	}


	public function elementor_init() {
		$this->_modules_manager = new ModuleManager();

		// Add element category in panel
		$category = \Elementor\Plugin::instance();
		$category->elements_manager->add_category(
			'ep-elements', // category name
			[
				'title' => esc_html__( 'Education Pro Widgets', 'education-pro-core' ), 
				'icon' => 'font',
			],
			1
		);
	}



	private function setup_hooks() {
		add_action( 'elementor/init', [ $this, 'elementor_init' ] );

		
		// Register Widget Scripts
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ] );

	}

	public function widget_scripts() {

		wp_register_script( 'typed', TX_PLUGIN_URL . '/assets/js/widgets/animated-heading/typed.min.js' );
		wp_register_script( 'morphext', TX_PLUGIN_URL . '/assets/js/widgets/animated-heading/morphext.min.js' );
		wp_register_script( 'asPieProgress', TX_PLUGIN_URL . '/assets/js/widgets/circle-progress-bar/jquery-asPieProgress.min.js' );
		wp_register_script( 'countdown', TX_PLUGIN_URL . '/assets/js/widgets/countdown/countdown.min.js' );
		wp_register_script( 'flipster', TX_PLUGIN_URL . '/assets/js/widgets/flipster/jquery.flipster.min.js' );
		wp_register_script( 'lity', TX_PLUGIN_URL . '/assets/js/widgets/popup/lity.min.js' );
		wp_register_script( 'ep-timeline', TX_PLUGIN_URL . '/assets/js/widgets/timeline/timeline.min.js' );
		
		

	}

	private function __construct() {
		
		spl_autoload_register( [ $this, 'autoload' ] );
		
		$this->_includes();
		
		$this->setup_hooks();
	}
}



TX_Load::instance();
