<?php
/*
Plugin Name: K2 Core
Plugin URI: http://k2.com.vn
Description: K2 core development by K2 Team.
Version: 1.0.0
Author: K2 Team
Author URI: http://k2.com.vn
License: GPL2
Text Domain: k2-core
*/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

include_once 'k2-framework/K2Framework.php';

if (!class_exists('k2_core')) {
    class k2_core extends K2Framework
    {
        /* single instance of the class */
        public $file = '';

        public $basename = '';

        /* base plugin_dir. */
        public $plugin_dir = '';
        public $plugin_url = '';

        /* base acess folder. */
        public $acess_dir = '';
        public $acess_url = '';
        public static $instance;

        public static function instance()
        {
            if (is_null(self::$instance)) {
                self::$instance = new k2_core();
                self::$instance->setup_globals();
                self::$instance->includes();
                self::$instance->setup_actions();
            }

            return self::$instance;
        }

        private function setup_globals()
        {
            parent::__construct();
//            $this->file = __FILE__;
//
//            /* base name. */
//            $this->basename = plugin_basename($this->file);
//
//            /* base plugin. */
//            $this->plugin_dir = plugin_dir_path($this->file);
//            $this->plugin_url = plugin_dir_url($this->file);
        }

        private function includes()
        {
            if (!class_exists('scssc')){
                require_once $this->plugin_dir . '/frameworks/scss/scss.inc.php';
            }
            require_once $this->plugin_dir . 'frameworks/ReduxCore/framework.php';
            require_once $this->plugin_dir . 'frameworks/Metacore/framework.php';
            require_once $this->plugin_dir . 'frameworks/Taxonomy/framework.php';
            $this->fs_require_folder('core/admin/widgets');
            $this->fs_require_folder('core/api');
            $this->fs_require_folder('core/admin');
            $this->fs_require_folder('core/frontend');
            $this->fs_require_folder('core/admin/post');
            $this->fs_require_folder('core/admin/settings');
            $this->fs_require_folder('core/admin/shortcodes');
        }

        private function setup_actions()
        {
//			add_filter( 'plugin_row_meta', array( $this, 'plugin_row_meta' ), 10, 2 );
        }

        public function plugin_row_meta($plugin_meta, $plugin_file)
        {
//			if ( $plugin_file !== plugin_basename( __FILE__ ) ) {
//				return $plugin_meta;
//			}
//
//			$plugin_meta[] = '<a href="https://github.com/vanquan805">' . esc_html__( 'GitHub', 'property' ) . '</a>';
//			$plugin_meta[] = '<a href="http://fsflex.com/support/" title="' . esc_html__( 'Support forum.', 'property' ) . '">' . esc_html__( 'Support', 'property' ) . '</a>';
//			$plugin_meta[] = '<a href="mailto:vanquan805@gmail.com" title="' . esc_html__( 'Send a email to Dev team.', 'property' ) . '">' . esc_html__( 'Contact', 'property' ) . '</a>';
//
//			return $plugin_meta;
        }
    }

    function k2_core()
    {
        return k2_core::instance();
    }

    if (defined('k2_core_LATE_LOAD')) {
        add_action('plugins_loaded', 'k2_core', (int)k2_core_LATE_LOAD);
    } else {
        $GLOBALS['k2_core'] = k2_core();
    }
}