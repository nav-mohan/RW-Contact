<?php

require_once("/var/www/fm949.ca/wp-content/plugins/RW-Contact/class-ContactForm.php");

function rw_contact_read_update_delete_messages()
{
    if(!is_user_logged_in() or !in_array('administrator',wp_get_current_user()->roles)){
        echo ("You are not authorized to make this edit!");
        exit;
    }
    $contact_form_ORM = new ContactForm();
    $task = $_POST['task'];
    switch ($task) {
            
        case 'read':
            $result = $contact_form_ORM->get_all();
            wp_send_json($result);
            break;

        case 'update_read_status':
            $rw_message_id = $_POST['rw_message_id'];
            $read_status = $_POST['read_status'];
            $result = $contact_form_ORM->update_read_status($rw_message_id,$read_status);
            wp_send_json($result);
            break;

        case 'update_admin_comment':
            $rw_message_id = $_POST['rw_message_id'];
            $admin_comment = $_POST['admin_comment'];
            $result = $contact_form_ORM->update_admin_comment($rw_message_id,$admin_comment);
            wp_send_json($result);
            break;
            
        case 'delete':
            $rw_message_id = $_POST['rw_message_id'];
            $result = $contact_form_ORM->delete_record($rw_message_id);
            wp_send_json($result);
            break;
        
        default:
            $result = $contact_form_ORM->get_all();
            wp_send_json($result);
            break;
    }

}

add_action('wp_ajax_rw_contact_read_update_delete_messages', 'rw_contact_read_update_delete_messages');           // for logged in user
add_action('wp_ajax_nopriv_rw_contact_read_update_delete_messages', 'rw_contact_read_update_delete_messages');    // if user not logged in


;?>
