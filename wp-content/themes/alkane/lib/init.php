<?php
/** Core Theme Framework */
class Alkane {
	
	/** Constructor Method */
	function __construct() {

		/** Define a Global variable Standard Class */
		global $alkane;
		$alkane = new stdClass;
		
		/** Define framework, parent theme, and child theme constants. */
		add_action( 'after_setup_theme', array( &$this, 'constants' ), 1 );
		
		/** Load the core functions required by the rest of the framework. */
		add_action( 'after_setup_theme', array( &$this, 'core' ), 2 );
		
		/** Language functions and translations setup. */
		add_action( 'after_setup_theme', array( &$this, 'i18n' ), 3 );
		
		/** Load the framework functions. */
		add_action( 'after_setup_theme', array( &$this, 'functions' ), 12 );
		
		/** Load admin files. */
		add_action( 'wp_loaded', array( &$this, 'admin' ) );		

	}
	
	/** Define Constant Paths */
	function constants() {

		/** Directory Location Constants */
		
		/** Sets the path to the parent theme directory. */
		define( 'ALKANE_DIR', trailingslashit( get_template_directory() ) );
		define( 'ALKANE_LIB_DIR', trailingslashit( ALKANE_DIR . 'lib' ) );
		
		define( 'ALKANE_FUNCTIONS_DIR', trailingslashit( ALKANE_LIB_DIR . 'functions' ) );
		define( 'ALKANE_ADMIN_DIR', trailingslashit( ALKANE_LIB_DIR . 'admin' ) );
		define( 'ALKANE_JS_DIR', trailingslashit( ALKANE_LIB_DIR . 'js' ) );
		define( 'ALKANE_CSS_DIR', trailingslashit( ALKANE_LIB_DIR . 'css' ) );
		
		/** URI Location Constants */
		
		/** Sets the path to the parent theme directory URI. */
		define( 'ALKANE_URI', trailingslashit( get_template_directory_uri() ) );
		define( 'ALKANE_LIB_URI', trailingslashit( ALKANE_URI . 'lib' ) );
		
		define( 'ALKANE_ADMIN_URI', trailingslashit( ALKANE_LIB_URI . 'admin' ) );
		define( 'ALKANE_JS_URI', trailingslashit( ALKANE_LIB_URI . 'js' ) );
		define( 'ALKANE_CSS_URI', trailingslashit( ALKANE_LIB_URI . 'css' ) );
		
	}
	
	/** Loads the core framework functions. */
	function core() {
		
		/** Load the core framework functions. */
		require_once( ALKANE_FUNCTIONS_DIR . 'core.php' );
	
	}
	
	/** Loads translation files */
	function i18n() {

		/** Translations can be filed in the /languages/ directory */
		load_theme_textdomain( 'alkane', ALKANE_DIR . 'languages' );
		
		/** Get the user's locale. */
		$locale = get_locale();
		
		/** Locate a locale-specific functions file. */
		$locale_functions = ALKANE_DIR . 'languages/$locale.php';
		
		/** If the locale file exists and is readable, load it. */
		if ( !empty( $locale_functions ) && is_readable( $locale_functions ) ) {
			require_once( $locale_functions );
		}
		
	}
	
	/** Loads the framework functions. */
	function functions() {

		/** Load media-related functions. */
		require_once( ALKANE_FUNCTIONS_DIR . 'media.php' );
		
		/** Load utility functions. */
		require_once( ALKANE_FUNCTIONS_DIR . 'utility.php' );
		
		/** Load theme settings functions. */
		require_once( ALKANE_FUNCTIONS_DIR . 'settings.php' );
		
		/** Load menus functions. */
		require_once( ALKANE_FUNCTIONS_DIR . 'menus.php' );		
		
		/** Load sidebars functions. */
		require_once( ALKANE_FUNCTIONS_DIR . 'sidebars.php' );
		
		/** Load featured image functions. */
		require_once( ALKANE_FUNCTIONS_DIR . 'featured-image.php' );
		
		/** Load custom header functions. */
		require_once( ALKANE_FUNCTIONS_DIR . 'custom-header.php' );
		
	}
	
	/** Load admin files for the framework. */
	function admin() {

		/* Check if in the WordPress admin. */
		if ( is_admin() ) {

			/* Load the main admin file. */
			require_once( ALKANE_ADMIN_DIR . 'admin.php' );

		}
	}	
	
}
?>