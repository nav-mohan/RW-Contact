<?php

require_once("/var/www/fm949.ca/wp-content/plugins/RW-Contact/class-ContactForm.php");

function rw_contact_submit_form()
{
    $contact_name = sanitize_text_field($_POST['name']);
    $contact_email = sanitize_email($_POST['email']);
    $contact_message = (trim($_POST['message']));
    if($contact_name==="")
    {
        $response = array('error'=>'You entered an invalid name');
        wp_send_json_error($response);
        die();
    }

    if($contact_email==="")
    {
        $response = array('error'=>'You entered an in-valid email');
        wp_send_json_error($response);
        die();
    }
    
    if($contact_message==="")
    {
        $response = array('error'=>'You message cannot be empty');
        wp_send_json_error($response);
        die();
    }

    $contact_form_content = array(
        'contact_name'=>$contact_name,
        'contact_email'=>$contact_email,
        'contact_message'=>$contact_message
    );

    $contact_form_ORM = new ContactForm();
    $db_response = $contact_form_ORM->create_record($contact_form_content);
    if(trim($db_response['error'])!="")
    {
        $response = array(
            'error'=> "DATABASE ERROR: " . $db_response['error']
        );
        wp_send_json_error($response);
        die();
    }
    $response = array(
        'name'=>$contact_name,
        'email'=>$contact_email,
        'count'=>$db_response['count'],
        'error'=>$db_response['error']
    );
    wp_send_json_success($response);

    die();
}

add_action('wp_ajax_rw_contact_submit_form', 'rw_contact_submit_form');           // for logged in user
add_action('wp_ajax_nopriv_rw_contact_submit_form', 'rw_contact_submit_form');    // if user not logged in


;?>