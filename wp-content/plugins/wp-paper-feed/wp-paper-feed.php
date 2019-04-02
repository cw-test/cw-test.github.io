<?php
/**
 * Plugin Name:  WP Paper Feed Plugin
 * Plugin URI:   github.#.io/wp-paper-feed
 * Description:  Gets the latest post from a blog via the REST API and transform it into a NewsPaper style Headline ! Blog link, title and date included.
 * Author: 		 Chris Woolf
 * Author URI: 	 cwoolf123.github.io
 * Text Domain:	 wp-paper-feed
 * License:      GPL v2 or later
 * License URI:  https://www.gnu.org/licenses/gpl-2.0.txt
 *
 * @package wp-paper-feed
 */

/*
WordPress Paper Feed Plugin
Copyright (C) 2019  Chris Woolf

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <https://www.gnu.org/licenses/>.
*/

// Disable direct file access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* Add .css styles */
function wp_paper_feed_adding_styles() {
	wp_register_style('wp_paper_feed_plugin_style', plugins_url('style.css', __FILE__));
	wp_enqueue_style('wp_paper_feed_plugin_style');
	}
	add_action( 'wp_enqueue_scripts', 'wp_paper_feed_adding_styles' );  



/* Admin Menu Option */
function paper_feed_admin_menu_option()
{
    add_menu_page('Paper Feed Plugin','Paper Feed','manage_options','paper-feed-admin-menu','paper_feed_scripts_page','dashicons-image-filter',200);
}

add_action('admin_menu','paper_feed_admin_menu_option');



/* Settings Page */
function paper_feed_scripts_page()
{

    if(array_key_exists('submit_scripts_update',$_POST))
    {
        update_option('paper_feed_header_scripts',$_POST['header_scripts']);
        ?>
        <div id="setting-error-settings-updated" class="updated settings-error notice is-dismissible"><strong>Settings have been saved</strong></div>
        <?php

    }

    $header_script = get_option('paper_feed_header_scripts','none');
    
    ?>
    <h1>Paper Feed Plugin</h1>
			
	<p>Installation</p>
    <form method="post" action="">
    <label for=header_scripts>Delete any left over text and enter any <strong>WordPress</strong> Blog URL below. Then click the button and copy the result.</label>
	<textarea name="header_scripts" class="large-text"><?php print $header_script?>/?rest_route/wp/v2/posts</textarea>
	<input type="submit" name="submit_scripts_update" class="button button-primary" value="GET URL">
	<br />
	<br />
	<p>In your wp_paper_feed.php file via plugins</p>
    </form>
    </div>
	<?php
	
	
}


/**
 * Get posts via REST API.
 */
function get_posts_via_rest() {
	// Enter the name of your blog here followed by /wp-json/wp/v2/posts and add filters like this one that limits the result to 2 posts.
$response = wp_remote_get( 'http://localhost:9000/supadu/?rest_route=/wp/v2/posts'/*'http://localhost:9000/wordpress/?rest_route=/wp/v2/posts'*/ );//swap with your url


	//$response = wp_remote_get( $url );


	//$response = wp_remote_get( print $footer_scripts );//swap with your url
	// Exit if error.
	if ( is_wp_error( $response ) ) {
		return;
	}
	// Get the body.
	$posts = json_decode( wp_remote_retrieve_body( $response ) );
	// Exit if nothing is returned.
	if ( empty( $posts ) ) {
		return;
	}
	// If there are posts.
	if ( ! empty( $posts ) ) {
		// For each post.
		foreach ( $posts as $post ) {
			// Use print_r($post); to get the details of the post and all available fields
			// Format the date.
			$fordate = date( 'n/j/Y', strtotime( $post->modified ) );
			// Show a linked title and post date.
			$allposts = '';

			//$allposts .= '<a href="' . esc_url( $post->link ) . '" target=\"_blank\"><h1>' . esc_html( $post->title->rendered ) . '</h1></a><br />' . esc_html( $fordate ) . '<br />';
			$allposts = '
			<div class="paper-feed">
			<svg width="600" height="200">
			<filter id="money">
			<feMorphology in="SourceGraphic" operator="dilate" radius="2" result="expand"/>
			
			<feOffset in="expand" dx="1" dy="1" result="shadow_1"/>
			<feOffset in="expand" dx="2" dy="2" result="shadow_2"/>
			<feOffset in="expand" dx="3" dy="3" result="shadow_3"/>
			<feOffset in="expand" dx="4" dy="4" result="shadow_4"/>
			<feOffset in="expand" dx="5" dy="5" result="shadow_5"/>
			<feOffset in="expand" dx="6" dy="6" result="shadow_6"/>
			<feOffset in="expand" dx="7" dy="7" result="shadow_7"/>
			
			<feMerge result="shadow">
			<feMergeNode in="expand"/>
			<feMergeNode in="shadow_1"/>
			<feMergeNode in="shadow_2"/>
			<feMergeNode in="shadow_3"/>
			<feMergeNode in="shadow_4"/>
			<feMergeNode in="shadow_5"/>
			<feMergeNode in="shadow_6"/>
			<feMergeNode in="shadow_7"/>
			</feMerge>
			
			<feFlood flood-color="#ebe7e0"/>
			<feComposite in2="shadow" operator="in" result="shadow"/>
			
			<feMorphology in="shadow" operator="dilate" radius="1" result="border"/>
			<feFlood flood-color="#35322a" result="border_color"/>
			<feComposite in2="border" operator="in" result="border"/>
			
			<feOffset in="border" dx="1" dy="1" result="secondShadow_1"/>
			<feOffset in="border" dx="2" dy="2" result="secondShadow_2"/>
			<feOffset in="border" dx="3" dy="3" result="secondShadow_3"/>
			<feOffset in="border" dx="4" dy="4" result="secondShadow_4"/>
			<feOffset in="border" dx="5" dy="5" result="secondShadow_5"/>
			<feOffset in="border" dx="6" dy="6" result="secondShadow_6"/>
			<feOffset in="border" dx="7" dy="7" result="secondShadow_7"/>
			<feOffset in="border" dx="8" dy="8" result="secondShadow_8"/>
			<feOffset in="border" dx="9" dy="9" result="secondShadow_9"/>
			<feOffset in="border" dx="10" dy="10" result="secondShadow_10"/>
			<feOffset in="border" dx="11" dy="11" result="secondShadow_11"/>
			
			<feMerge result="secondShadow">
			<feMergeNode in="border"/>
			<feMergeNode in="secondShadow_1"/>
			<feMergeNode in="secondShadow_2"/>
			<feMergeNode in="secondShadow_3"/>
			<feMergeNode in="secondShadow_4"/>
			<feMergeNode in="secondShadow_5"/>
			<feMergeNode in="secondShadow_6"/>
			<feMergeNode in="secondShadow_7"/>
			<feMergeNode in="secondShadow_8"/>
			<feMergeNode in="secondShadow_9"/>
			<feMergeNode in="secondShadow_10"/>
			<feMergeNode in="secondShadow_11"/>
			</feMerge>
			
			<feImage x="0" y="0" width="600" height="200" xlink:href="https://s3-us-west-2.amazonaws.com/s.cdpn.io/78779/stripes.svg"/>
			<feComposite in2="secondShadow" operator="in" result="secondShadow"/>
			
			<feMerge>
			<feMergeNode in="secondShadow"/>
			<feMergeNode in="border"/>
			<feMergeNode in="shadow"/>
			<feMergeNode in="SourceGraphic"/>
			</feMerge>
			</filter>';
			
			$allposts .= '<a href="' . esc_url( $post->link ) . '" target=\"_blank\"> <text dominant-baseline="middle" text-anchor="middle" x="50%" y="50%">' . esc_html( $post->title->rendered ) . ' </text></svg></a><br />' . esc_html( $fordate ) . '<br /></div>';
			
		}
		
		return $allposts;
	}
}
// Register as a shortcode to be used on the site.
add_shortcode( 'sc_paper_feed', 'get_posts_via_rest' );





?>

