// resources/js/app.js
import './bootstrap';

window.modalAction = function(url) {
    $('#myModal').modal('show');
    $.ajax({
        url: url,
        type: 'GET',
        success: function(response) {
            $('#myModal').html(response);
        },
        error: function() {
            $('#myModal').html('<p>Terjadi kesalahan saat memuat data.</p>');
        }
    });
};
