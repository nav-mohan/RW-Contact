console.log("Loading plugin RW-Contact submit-form.js",RW_URLS['wp_ajax']);

function rw_contact_submit_form(){

    const FORM_RW_CONTACT_SUBMIT_FORM = new FormData();
    FORM_RW_CONTACT_SUBMIT_FORM.set('action','rw_contact_submit_form');
    FORM_RW_CONTACT_SUBMIT_FORM.set('name',document.getElementById('contact-name').value);
    FORM_RW_CONTACT_SUBMIT_FORM.set('email',document.getElementById('contact-email').value);
    FORM_RW_CONTACT_SUBMIT_FORM.set('message',document.getElementById('contact-message').value);

    return fetch(RW_URLS['wp_ajax'],
        {
            method:"POST",
            body:FORM_RW_CONTACT_SUBMIT_FORM
        }
    )
    .then(function(res){
        if(res.ok)
            return res.json()
        else
            alert("There was error while submitting your form...")
    })
    .then((res_json)=>{
        console.log(res_json)
        if(res_json.success==true)
            alert(`Thank you ${res_json.data.name}! Your message was well received! Someone on our team will get back to you soon at ${res_json.data.email}!`);
        else
            alert(`${res_json.data.error}`);
    })
}
