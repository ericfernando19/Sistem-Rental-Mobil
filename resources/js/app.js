import './bootstrap';
import Alpine from 'alpinejs';
import Swal from 'sweetalert2';

window.Alpine = Alpine;
window.Swal = Swal;

Alpine.start();

document.addEventListener('DOMContentLoaded', function () {
    let sessionSuccess = document.querySelector('meta[name="session-success"]');
    if (sessionSuccess) {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: sessionSuccess.content,
            timer: 3000,
            showConfirmButton: false
        });
    }
});
