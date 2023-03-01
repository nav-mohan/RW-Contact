<?php
/**
 * this is the model for the rw_contactform table
 * it handles all CRUD operations of the table
 * it is used for saving a message sent by a web-browser to wp-ajax (action : rw_contact_submit_form)
 * it is used by the admin-dashboard for reading/deleting/updating messages received so far
 */

include_once("/var/www/fm949.ca/wp-load.php");
require_once('/var/www/fm949.ca/wp-admin/includes/upgrade.php' );

global $wpdb;

class ContactForm {

    private $db_handle;
    public $table_name = 'rw_contactform';
    
    function __construct(){
        global $wpdb;
        $this->db_handle = $wpdb;
        $this->create_table();
    }

    function get_all()
    {
        $SQL = "SELECT * FROM $this->table_name ORDER BY creation_ts DESC";
        $result = $this->db_handle->get_results($SQL);
        $last_error = $this->db_handle->last_error;
        $response = array('result'=>$result,'error'=>$last_error);
        return($response);

    }

    function delete_record($rw_message_id)
    {
        $SQL = "DELETE FROM $this->table_name WHERE rw_message_id='$rw_message_id'";
        $result = $this->db_handle->get_results($SQL);
        $last_error = $this->db_handle->last_error;
        $response = array('result'=>$result,'error'=>$last_error);
        return($response);
    }

    function update_read_status($rw_message_id,$read_status)
    {
        $SQL = "UPDATE $this->table_name SET 
        read_status = '$read_status'
        WHERE rw_message_id = $rw_message_id";
        $count = $this->db_handle->query($SQL);
        $last_error = $this->db_handle->last_error;
        $response = array('count'=>$count,'error'=>$last_error);
        return $response;   
    }

    function update_admin_comment($rw_message_id, $admin_comment)
    {
        $SQL = "UPDATE $this->table_name SET 
        admin_comment = '$admin_comment'
        WHERE rw_message_id = $rw_message_id";
        $count = $this->db_handle->query($SQL);
        $last_error = $this->db_handle->last_error;
        $response = array('count'=>$count,'error'=>$last_error);
        return $response;   
    }

    function create_record($contact_form_content)
    {
        $contact_name = $contact_form_content['contact_name'];
        $contact_email = $contact_form_content['contact_email'];
        $contact_message = $contact_form_content['contact_message'];

        $SQL = "INSERT INTO $this->table_name (
            contact_name,
            contact_email,
            contact_message
            ) VALUES (
            '$contact_name',
            '$contact_email',
            '$contact_message'
            )";
        $count = $this->db_handle->query($SQL);
        $last_error = $this->db_handle->last_error;
        $response = array('count'=>$count,'error'=>$last_error);
        return $response;
    }

    function create_table() {
        //* Create the zetta logs table
        $SQL = "CREATE TABLE $this->table_name (
        rw_message_id INTEGER NOT NULL AUTO_INCREMENT,
        creation_ts TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        modification_ts TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        contact_name VARCHAR(255) NOT NULL,
        contact_email VARCHAR(255) NOT NULL,
        contact_message TEXT NOT NULL,
        read_status INTEGER NOT NULL DEFAULT 0,
        admin_comment TEXT,
        PRIMARY KEY (rw_message_id)
        );";
        maybe_create_table( $this->table_name,$SQL );
    }
}


;?>