import Swal from "sweetalert2";


function messageDialogue(type, message, confirmButtonText) {
    
    Swal.fire({
        title: type.toUpperCase(),
        text: message,
        icon: type,
        confirmButtonText: confirmButtonText,
        
    })
}

function infoDialogue(message, confirmButtonText) {
    
    Swal.fire({
        title: "info",
        text: message,
        icon: "success",
        confirmButtonText: confirmButtonText,
        
    })
}

function deleteDialogue(message, confirmButtonText, cancelButtonText, form) {
    event.preventDefault();
    Swal.fire({
        title: "Error!",
        text: message,
        icon: "error",
        showCancelButton: true,
        confirmButtonText: confirmButtonText,
        cancelButtonText: cancelButtonText,
    }).then((result) => {
        if (result.isConfirmed) form.submit();
    });
}

window.deleteDialogue = deleteDialogue;
window.messageDialogue = messageDialogue;
