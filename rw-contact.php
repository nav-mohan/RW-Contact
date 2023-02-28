<?php
/**
 * Plugin Name: RW-Contact
 * Plugin URI: https://navmohan.site
 * Author: Navaneeth Mohan
 * Author URI: https://navmohan.site
 * Description: A plugin that creates a custom contact page with contact forms and an admin-dashboard
 * Version: 0.1.0
 * License: GPL2
 * License URL: http://www.gnu.org/licenses/gpl-2.0.txt
 * text-domain: prefix-plugin-name
*/

// create contact page 
add_action("init",'rw_contact_plugin_custom_page_creator');
function rw_contact_plugin_custom_page_creator(){
    $contact_page_title = "RW-Contact";
    $contact_page_slug = "contact";
    if(get_page_by_title($contact_page_title) == NULL && get_page_by_path($contact_page_slug)==NULL){
        $contact_page_args = array(
            "post_title" => $contact_page_title,
            "post_content" => "",
            "post_status" => "publish",  
            "post_type" => "page",
            "post_name" => $contact_page_slug // this is teh slug
        );   
        $create_contact_page = wp_insert_post($contact_page_args);
    }
}

add_action('admin_menu', 'rw_contact_plugin_create_menu_entry');

// creating the menu entries
function rw_contact_plugin_create_menu_entry()
{
    // icon image path that will appear in the menu
    $icon = plugins_url('/images/rw-contact-plugin-icon-16x16.png', __FILE__);

    // adding the main menu entry
    add_menu_page(
        'RW-Contact Plugin',
        'RW-Contact',
        'manage_options',
        'main-page-rw-contact-plugin',
        'rw_contact_plugin_show_main_page',
        $icon
    );
}

function rw_contact_plugin_show_main_page()
{
    require_once('templates/messages.php');
}


require_once('ajax-endpoints/ajax-rw-contact-get-body.php');
require_once('ajax-endpoints/ajax-rw-contact-submit-form.php');
require_once('ajax-endpoints/ajax-rw-contact-read-messages.php');

// these JS files are required everywhere
wp_enqueue_script('global_vars',        get_template_directory_uri() . '/js/global-vars.js','','',false);
wp_enqueue_script('ready_audio_player', get_template_directory_uri() . '/js/audio-player.js','','',false);
wp_enqueue_script('get_contact_body', plugin_dir_url(__FILE__ ) . '/js/rw-contact-get-body.js','','',false);
wp_enqueue_script('submit_contact_form', plugin_dir_url(__FILE__ ) . '/js/rw-contact-submit-form.js','','',false);
wp_enqueue_script('enable_infinitescroll',get_template_directory_uri().'/js/enable-infinitescroll.js','','',false);