console.log("Loading plugin RW-Contact get-contact-body.js",RW_URLS['wp_ajax']);
function get_contact_body(){
    const FORM_GET_BODY = new FormData();
    FORM_GET_BODY.set('action','rw_contact_get_body');

    return fetch(RW_URLS['wp_ajax'],
        {
            method:"POST",
            body:FORM_GET_BODY
        }
    )
    .then(function(res){
        console.log(res)
        if(res.ok)
            return res.text();
        else
            throw new Error("Failed to fetch contact-body from wp-admin-ajax API endpoint");
    })
    .catch((err)=>{
        console.log(err);
    })
    .then((res_html)=>{
        document.getElementById('main-body').innerHTML = res_html
    })
}
