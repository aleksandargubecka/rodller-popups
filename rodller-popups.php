<?php

/*
Plugin Name: Rodller Popups
Plugin URI: http://rodller.com
Description: Plugin for adding popups to your website
Author: Rodller
Version: 1.0.0
Author URI: http://rodller.com
*/

defined( 'ABSPATH' ) || exit;

define('RODLLER_POPUPS_CORE_VERSION', '1.0.0');
define('RODLLER_POPUPS_CORE_BASE', plugin_dir_path( __FILE__ )  );
define('RODLLER_POPUPS_CORE_DIR_URI', trailingslashit(plugins_url('', __FILE__)) );
define('RODLLER_POPUPS_TEXTDOMAIN', 'rodller-popups');

require_once RODLLER_POPUPS_CORE_BASE . 'core/helpers.php';
require_once RODLLER_POPUPS_CORE_BASE . 'core/enqueue.php';
require_once RODLLER_POPUPS_CORE_BASE . 'cpts/popup.php';
require_once RODLLER_POPUPS_CORE_BASE . 'metaboxes/popup.php';
require_once RODLLER_POPUPS_CORE_BASE . 'core/show-popup.php';
