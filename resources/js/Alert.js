import Swal from 'sweetalert2';

document.addEventListener('DOMContentLoaded', () => {
    if (window.laravelErrors && Array.isArray(window.laravelErrors)) {
        const errorMessages = window.laravelErrors.join('<br>');

        Swal.fire({
            title: 'Whoops...',
            html: errorMessages,
            icon: 'error',
            showConfirmButton: false,
            timer: 1000,
        });
    }
    
    if (window.laravelSuccess) {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: window.laravelSuccess,
            showConfirmButton: false,
            timer: 1000,
        });
    }
});