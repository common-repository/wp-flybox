<?php
/*
Plugin Name: WP-FlyBox
Plugin URI: https://wordpress.org/plugins/wp-flybox/
Description: Tabbed fly-out social boxes for Facebook, Twitter, Google Plus, Youtube, LinkedIn, Feedburner, Pinterest, Flickr, DeviantArt, Instagram,Contact Me or a custom Tab.
Version: 6.46
Author: Cyle Conoly
Author URI: http://www.facebook.com/cylec
License: GPL2
Copyright 2017  Cyle Conoly  (email : cyle.conoly@gmail.com)
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 2, as 
  published by the Free Software Foundation.
  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.
  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
function wpflybox_admin() {  
    include_once('wpfb_options.php');  
}  
function wpflybox_admin_actions() {  
  add_options_page("WP-FlyBox", "WP-FlyBox", "manage_options", "WP-FlyBox", "wpflybox_admin");          
  }  
add_action('admin_menu', 'wpflybox_admin_actions');
/**
 * Add settings link on plugin page
 * @since 3.0
 * @author c.bavota (http://bavotasan.com/2009/a-settings-link-for-your-wordpress-plugins/)
 * from Beee @ http://berryplasman.com 
 */
function wpflybox_settings_link($links) { 
	  $wpflybox_settings_link = '<a href="options-general.php?page=WP-FlyBox">Settings</a>'; 
	  array_unshift($links, $wpflybox_settings_link); 
	  return $links; 
}

function wpflybox_contains($teststring, $commastring) {
  $commastring=str_replace(' ','',$commastring);
  $array = explode(",", $commastring);
  foreach($array as $a) {
        if (stripos($teststring,$a) !== false) return true;
    }
    return false;
}

$wpflybox_plugin = plugin_basename(__FILE__); 
add_filter("plugin_action_links_$wpflybox_plugin", 'wpflybox_settings_link' );
function wpflybox_init_head (){
$wpflybox_pid=get_the_ID();
if ($wpflybox_pid < 1){$wpflybox_pid='noid';}
if (get_option('wpflybox_side') !== "none" 
  && (((is_front_page() && get_option('wpflybox_showon_front')==is_front_page())
  || ((is_home() && get_option('wpflybox_showon_front')==is_home())))
  || (is_page() && get_option('wpflybox_showon_page')==is_page())
  || (is_single() && get_option('wpflybox_showon_post')==is_single())
  || (is_archive() && get_option('wpflybox_showon_archive')==is_archive())
  || (is_feed() && get_option('wpflybox_showon_feed')==is_feed())
  || (is_search() && get_option('wpflybox_showon_search')==is_search())
  || ((is_page() || is_single()) && @stripos(get_option('wpflybox_showon_pid'), $wpflybox_pid.'')!==false))  
  && ((!is_user_logged_in() && get_option('wpflybox_showon_guest')!=is_user_logged_in())
  || (is_user_logged_in() && get_option('wpflybox_showon_logged')==is_user_logged_in()))
  && @stripos(get_option('wpflybox_showon_pidhide'), $wpflybox_pid.'')===false
  && ((get_option('wpflybox_showon_urlhide')!='' && wpflybox_contains($_SERVER['REQUEST_URI'], get_option('wpflybox_showon_urlhide'))===false) || get_option('wpflybox_showon_urlhide')=='')   
  ){
include_once('head_import.php');
}
}
function wpflybox_init_body (){
$wpflybox_pid=get_the_ID();
if ($wpflybox_pid < 1){$wpflybox_pid='noid';}
if (get_option('wpflybox_side') !== "none" 
  && (((is_front_page() && get_option('wpflybox_showon_front')==is_front_page())
  || ((is_home() && get_option('wpflybox_showon_front')==is_home())))
  || (is_page() && get_option('wpflybox_showon_page')==is_page())
  || (is_single() && get_option('wpflybox_showon_post')==is_single())
  || (is_archive() && get_option('wpflybox_showon_archive')==is_archive())
  || (is_feed() && get_option('wpflybox_showon_feed')==is_feed())
  || (is_search() && get_option('wpflybox_showon_search')==is_search())
  || ((is_page() || is_single()) && @stripos(get_option('wpflybox_showon_pid'),$wpflybox_pid.'')!==false))  
  && ((!is_user_logged_in() && get_option('wpflybox_showon_guest')!=is_user_logged_in())
  || (is_user_logged_in() && get_option('wpflybox_showon_logged')==is_user_logged_in()))
  && @stripos(get_option('wpflybox_showon_pidhide'),$wpflybox_pid.'')===false
  && ((get_option('wpflybox_showon_urlhide')!='' && wpflybox_contains($_SERVER['REQUEST_URI'], get_option('wpflybox_showon_urlhide'))===false) || get_option('wpflybox_showon_urlhide')=='')  
  ){
include_once('body_import.php');
}
}
function wpflybox_init(){
wp_enqueue_script("jquery");
} 

function wpflybox_debug(){
  echo '<!-- WPFLYBOX DEBUGGER
    ';
  include('defaults.php');
  foreach ($wpfb_defaults as $key => $value) {
    echo $key.' = "'.get_option($key).'"
    ';
  }
  echo '-->';
}

if (get_option('wpflybox_debug')=='true'){
add_action('wp_head','wpflybox_debug');
}

add_action('init', 'wpflybox_init');
add_action('wp_head', 'wpflybox_init_head');
add_action('wp_footer', 'wpflybox_init_body', 1);