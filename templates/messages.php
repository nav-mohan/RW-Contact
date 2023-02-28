<h1>RW-Contact Plugin</h1>

<?php
require_once("/var/www/fm949.ca/wp-load.php");
require_once('/var/www/fm949.ca/wp-admin/includes/upgrade.php' );
require_once("/var/www/fm949.ca/wp-content/plugins/RW-Contact/class-ContactForm.php");
wp_enqueue_script('read_update_delete_messages',plugin_dir_url(__DIR__ ) . '/js/rw-contact-read-update-delete-messages.js','','',false);

;?>
<link rel="stylesheet" href="<?php echo plugin_dir_url(__DIR__ ) . '/css/admin_dashboard.css';?>">

<div id = 'inbox'>
    <script>
        window.addEventListener('load',()=>{
            get_all_messages();
        })
    </script>
</div>

