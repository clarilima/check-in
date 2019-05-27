require('../bootstrap');

import Validation from "./components/Validation";

window.validation = new Validation();

$(document).ready(function () {
    $('input, select').on('focus', function(){
        $(this).closest('.form-group').addClass('input-focus').find('.label-text').addClass('focus');
    }).on('blur', function(){
        if($(this).val() != '') {
            $(this).closest('.form-group').addClass('input-focus').find('.label-text').addClass('focus');
        } else {
            $(this).closest('.form-group').removeClass('input-focus').find('.label-text').removeClass('focus');
        }
    });

    $('input, select').each(function () {
        if($(this).val() != ''){
            $(this).closest('.form-group').addClass('input-focus').find('label').addClass('focus');
        }
    });

    // var SPMaskBehavior = function (val) {
    //         return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
    //     },
    //     spOptions = {
    //         onKeyPress: function(val, e, field, options) {
    //             field.mask(SPMaskBehavior.apply({}, arguments), options);
    //         }
    //     };
    //
    // $('.mask-phone').mask(SPMaskBehavior, spOptions);
    //
    // $('.money-mask').maskMoney({thousands:'', decimal:'.', allowZero: true});
    //
    // $('[data-card="check"]').on('click', function(){
    //     if (!$(this).hasClass('active')){
    //         $(this).closest('.group-cards-form').find('.card-elo').removeClass('active');
    //         $(this).addClass('active');
    //         $(this).closest('form').find('button').prop({disabled: false});
    //     }else {
    //         $(this).removeClass('active');
    //         $(this).closest('form').find('button').prop({ disabled: true});
    //         $('#card-selected').hide();
    //     }
    // });
    //
    // $('[data-carousel="cards"]').slick({
    //     slidesToShow: 3,
    //     slidesToScroll: 1,
    //     infinite: true,
    //     arrows: true,
    //     centerPadding: 0,
    //     responsive: [
    //         {
    //             breakpoint: 561,
    //             settings: {
    //                 slidesToShow: 1
    //             }
    //         },
    //     ]
    // });
    //
    // $('[data-input="autocomplete"]').each(function () {
    //     $(this).on('change', function () {
    //         let array = $(this).data('array');
    //         let value = $(this).val();
    //
    //         console.log(array, value)
    //     });
    // });
    //
    // function formatMoney(n, c, d, t) {
    //     var c = isNaN(c = Math.abs(c)) ? 2 : c,
    //         d = d == undefined ? "." : d,
    //         t = t == undefined ? "," : t,
    //         s = n < 0 ? "-" : "",
    //         i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))),
    //         j = (j = i.length) > 3 ? j % 3 : 0;
    //
    //     return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
    // };
    //
    // window.formatMoney = formatMoney;
    //
    // $('[data-discount="input"]').on('change', function () {
    //     let val = $(this).val();
    //     let value = val;
    //     let discount = val;
    //
    //     if((val > 0) && (val <= 500)) {
    //         value = parseFloat(val * 0.5).toFixed(2);
    //         discount = value;
    //
    //     } else if(val == 0){
    //         value = 0;
    //         discount = 0;
    //     } else {
    //         value = (parseFloat(val) - 250).toFixed(2);
    //         discount = parseFloat(250).toFixed(2);
    //     }
    //
    //     if(val == 0){
    //         $('[data-discount="table"]').hide();
    //     } else {
    //         $('[data-discount="table"]').fadeIn();
    //     }
    //
    //     $('[data-discount="discount"]').html('').html('$ ' + discount);
    //     $('[data-discount="value"]').html('').html('$ '+ value);
    // });

    $('#btn-store-meeting').on('click', function (e) {
        e.stopPropagation();
        e.preventDefault();

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
                    location.reload();
                });
        }
    });
});
