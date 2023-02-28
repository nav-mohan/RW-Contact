console.log("Loading plugin RW-Contact rw-contact-read-update-delete-messages.js",RW_URLS['wp_ajax']);
function get_all_messages(){
    const FORM_GET_MESSAGES = new FormData();
    FORM_GET_MESSAGES.set('action','rw_contact_read_update_delete_messages');
    FORM_GET_MESSAGES.set('task','read');
    return fetch(RW_URLS['wp_ajax'],
        {
            method:"POST",
            body:FORM_GET_MESSAGES
        }
    )
    .then(function(res){
        if(res.ok)
            return res.json();
        else
            throw new Error("Failed to fetch contact-body from wp-admin-ajax API endpoint");
    })
    .catch((err)=>{
        console.log(err);
    })
    .then((res_json)=>{
        res_json.result.forEach((message)=>draw_messages(message))
    })
}


function draw_messages(message)
{
    const message_id = message.rw_message_id;

    const message_box = document.createElement('div');
    message_box.classList.add('message-box');
    message_box.setAttribute("id","message-"+message.rw_message_id)

    const message_date_box = document.createElement('div');
    message_date_box.classList.add('message-date-box');
    message_date_box.innerText = message.creation_ts;

    const message_author_name_box = document.createElement('div');
    message_author_name_box.classList.add('message-author-name-box');
    message_author_name_box.innerText = message.contact_name;

    const message_author_email_box = document.createElement('div');
    message_author_email_box.classList.add('message-author-email-box');
    message_author_email_box.innerText = message.contact_email;


    const message_content_box = document.createElement('div');
    message_content_box.classList.add('message-content-box');
    message_content_box.innerText = message.contact_message;

    const message_delete_button = document.createElement('button');
    message_delete_button.classList.add('message-delete-button');
    message_delete_button.innerText = 'Delete';
    message_delete_button.addEventListener('click' , ()=>{
        console.log('clicking');
        delete_message(message.rw_message_id,message.contact_name);
    })



    message_box.appendChild(message_date_box);
    message_box.appendChild(message_author_name_box);
    message_box.appendChild(message_author_email_box);
    message_box.appendChild(message_content_box);
    message_box.appendChild(message_delete_button);

    document.getElementById('inbox').appendChild(message_box)
}


function delete_message(rw_message_id,contact_name)
{
    FORM_DELETE_MESSAGE = new FormData();
    FORM_DELETE_MESSAGE.set('action',RW_WP_ACTIONS['rw_contact_read_update_delete_messages']);
    FORM_DELETE_MESSAGE.set('task','delete');
    FORM_DELETE_MESSAGE.set('rw_message_id',rw_message_id);
    const confirmation_message = "This is permanent!\n Are you sure you want to delete this message from " + contact_name;
    if(confirm(confirmation_message)){
        return fetch(RW_URLS['wp_ajax'],
        {
            method:"POST",
            body:FORM_DELETE_MESSAGE
        })
        .then((res)=>{
            if(res.ok)
                return res.json()
            else
                alert("Error in deleing messaage " + rw_message_id + " from " + contact_name);
        })
        .then((res_json)=>{
            if(res_json.error=="")
            {
                alert("Deleted messaage " + rw_message_id + " from " + contact_name);
                document.getElementById("message-"+rw_message_id).remove();
            }
            else
                alert("Error in deleing messaage " + rw_message_id + " from " + contact_name + "\nDetails: " + res_json.error);

        })

    }
}
