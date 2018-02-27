<?php
/*
Plugin Name: Custom Update Posts - Plugin
Plugin URI: https://google.com
Description: This is my own Plugin, I wrote it myself. It does so you can easily create Custom Posts with the post_type 'update'. You can then use the freely available 'Post in Page' plugin to show these posts on a specific updates page.
Version: 1.0.0
Author: Anthon Mølgaard Steiness
Author URI: https://google.com
License: GPLv2 or Later
Text Domain: My-Plugin
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

defined( 'ABSPATH' ) or die( 'Silly Human, you can not access this!' );


class MyPlugin
{
  function __construct()
  {
    add_action('init', array($this, 'custom_post_type'));
  }

  function register()
  {
    // This enqueues it in the backend, if we want it in the frontend replace 'admin' with 'wp'
    add_action( 'admin_enqueue_scripts', array($this, 'enqueue') );
  }

  function custom_post_type()
  {
    register_post_type('update', ['public' => true, 'label' => 'Post Updates']);
  }

  function enqueue()
  {
    // Enqueue all out scripts
    wp_enqueue_style( 'mypluginstyle', plugins_url('/assets/mystyle.css',  __FILE__) );
    wp_enqueue_script( 'myscript', plugins_url('/assets/myscript.js',  __FILE__) );
  }
}

if (class_exists ('MyPlugin'))
{
  $myPlugin = new MyPlugin();
  $myPlugin->register();
}

// activation
require_once plugin_dir_path(__FILE__) . 'includes/myPlugin-activate.php';
register_activation_hook(__FILE__, array('MyPluginActivate', 'activate'));

// deactivation
require_once plugin_dir_path(__FILE__) . 'includes/myPlugin-deactivate.php';
register_deactivation_hook(__FILE__, array('MyPluginDeactivate', 'deactivate'));
