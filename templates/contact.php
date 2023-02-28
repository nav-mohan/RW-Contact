<?php 
/**
 * Template Name: Contact
 */
;?>
This is the contact.php from the pluhin
<?php wp_head();?>

<link rel="stylesheet" href = "<?php echo get_template_directory_uri() . '/css/contact.css';?>">
<div class="contact-image">
    <?php 
    if ( has_post_thumbnail() )
        the_post_thumbnail('size-large');
    else 
        echo "<img src =" . get_template_directory_uri() . "/DefaultImages/default_featured_image_800.jpeg>";
    ?>
</div>
<div class = "contact-details">
    <div class = "contact-description">
        <?php the_content();?>
    </div>
</div>
This is the contact.php from the pluhin

<div id="contact-form">
    <input type="text" id = "contact-name" placeholder="name" >
    <input type="email" id = "contact-email" placeholder="email" >
    <textarea placeholder="Your Message" id = "contact-message" rows="10" cols="150" >
    </textarea>
    <button onclick="rw_contact_submit_form()">Send Message </button>
</div>
<br>
<br>


<!-- 
    This file contains only the html for the Contact body. Not the Header. Nor the footer. 
    The stuff in here will be plugged into <div id = 'main-body'> of index.php 
-->