require('./bootstrap');

import Validation from "./site/components/Validation";

window.validation = new Validation();


$(document).ready(function () {

    $('#btn-store-meeting').on('click', function (e) {
        e.stopPropagation();
        e.preventDefault();
        // console.log(1);

        if ($("#form-register-meeting").valid()){
            $('#modal-loading2').modal('show');
            // console.log(111);s
            axios.post('/api/meetings', {
                day: $('#date-meeting').val(),
                description: $('#description').val(),
                // opt_in: !$('#opt_in').prop('checked')
            })
                .then(function(response){
                    $('#modal-loading2').modal('hide');
                    $('#modal-success').modal('show');
                    $('#date-meeting').val("");
                });
        }
    });
});
