<?php
/*
Plugin Name: WP Showtime
Plugin URI: http://tsepelev.ru/wp-showtime
Description: The plugin allows you to display on any page of your blog movie showtimes. There is the possibility showtimes for any city.
Version: 1.0
Author: Sergey Tsepelev
Author URI: http://tsepelev.ru
*/

/*  Copyright 2010  WP Showtime  (email: sergey@tsepelev.ru)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

?>
<?php
add_action('admin_menu', 'tp_add_tools_menu');
add_shortcode('showtime', 'show_showtime');
function tp_add_tools_menu() {

add_submenu_page('tools.php', 'WP Showtime', 'WP Showtime', 10, basename(__FILE__), 'tp_manage_menu');

}

function tp_manage_menu(){

	include('wp-showtime-opt.php'); 

}

function show_showtime(){
$lng = get_option('showtime_lang');
	if ($lng == ru):
  include('wp-showtime-func.php'); 
elseif ($lng == en):
  include('wp-showtime-func-en.php'); 
else:
  echo "Language you entered is not supported by the plugin.";
endif;

}

?>