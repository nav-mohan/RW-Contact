# Documentation of RW-Contact Plugin



## A function to override `contact.php` with `index.php` as the template to use
- I used to use this overriding function but now that I have removed `contact.php` from the `template_direcotry` I 
dont need this overriding function bbecause wordpress will always the `index.php` as the default template.
- This overriding is triggered only when someone visits the `/contact` url directly. It's not triggred when going from home-page to contact by clicking on the `Contact` menu
```
add_filter('template_include','assign_contact_page_template');
function assign_contact_page_template($template){
    global $wp;
    $request = explode( '/', $wp->request );
      if ( is_page( 'RW-Contact' ) || current( $request ) == "contact" ) {
        return (get_template_directory() . "/index.php");
    }
    return $template;
}
```