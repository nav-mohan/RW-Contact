<?php

function rw_contact_get_body()
{
    // i would like to replace this with raw SQL statement
    $WP_QUERY_ARGS = array('pagename'=>'contact', 'post_status'=>'publish');
    $WP_QUERY = new WP_Query($WP_QUERY_ARGS);
    $WP_QUERY->the_post();
    // get_template_part('/var/www/fm949.ca/wp-content/plugins/RW-Contact/templates/contact.php');
    include(plugin_dir_path( __FILE__ ) . '../templates/contact.php');
}

add_action('wp_ajax_rw_contact_get_body', 'rw_contact_get_body');           // for logged in user
add_action('wp_ajax_nopriv_rw_contact_get_body', 'rw_contact_get_body');    // if user not logged in


;?>