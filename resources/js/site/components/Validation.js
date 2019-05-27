export default class Validation {
    constructor(){
        this.idRegisterMeeting = '#form-register-meeting';
    }

    methodsValidation()
    {
        var isValidBin = true;
        String.prototype.replaceAll = function(search, replacement) {
            var target = this;
            return target.split(search).join(replacement);
        };

        jQuery.validator.addMethod("validateName", function(value, element) {
            return this.optional( element ) || /^[a-z A-Z\u00C0-\u00FF]+$/.test( value );
        }, 'Entre com um nome válido!');

        jQuery.validator.addMethod("laxEmail", function(value, element) {
            return this.optional( element ) || /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,99}(?:\.[a-z]{2})?)$/i.test( value );
        }, 'Entre com um e-mail válido!');

        jQuery.validator.addMethod("isValidCreditCard", function(value, element) {
            return this.optional( element ) || value.replaceAll('_', '').length == 19;
        }, 'Número de cartão Elo incompleto.');

        jQuery.validator.addMethod("isCreditCard", function(value, element) {
            function validCreditCard(value) {
                // accept only digits, dashes or spaces
                if (/[^0-9-\s]+/.test(value)) return false;

                // The Luhn Algorithm. It's so pretty.
                var nCheck = 0, nDigit = 0, bEven = false;
                value = value.replace(/\D/g, "");

                for (var n = value.length - 1; n >= 0; n--) {
                    var cDigit = value.charAt(n),
                        nDigit = parseInt(cDigit, 10);

                    if (bEven) {
                        if ((nDigit *= 2) > 9) nDigit -= 9;
                    }

                    nCheck += nDigit;
                    bEven = !bEven;
                }

                return (nCheck % 10) == 0;
            }

            return this.optional( element ) || validCreditCard( value );
        }, 'Número de cartão Elo inválido.');

        jQuery.validator.addMethod("validateCPF", function(value, element) {

            function validateCPF(cpf) {
                cpf = cpf.replace(/[^\d]+/g,'');
                let Soma;
                let Resto;
                Soma = 0;
                if (cpf.length != 11 ||
                    cpf == "00000000000" ||
                    cpf == "11111111111" ||
                    cpf == "22222222222" ||
                    cpf == "33333333333" ||
                    cpf == "44444444444" ||
                    cpf == "55555555555" ||
                    cpf == "66666666666" ||
                    cpf == "77777777777" ||
                    cpf == "88888888888" ||
                    cpf == "99999999999") return false;

                for (let i=1; i<=9; i++) Soma = Soma + parseInt(cpf.substring(i-1, i)) * (11 - i);
                Resto = (Soma * 10) % 11;

                if ((Resto == 10) || (Resto == 11))  Resto = 0;
                if (Resto != parseInt(cpf.substring(9, 10)) ) return false;

                Soma = 0;
                for (let i = 1; i <= 10; i++) Soma = Soma + parseInt(cpf.substring(i-1, i)) * (12 - i);
                Resto = (Soma * 10) % 11;

                if ((Resto == 10) || (Resto == 11))  Resto = 0;
                if (Resto != parseInt(cpf.substring(10, 11) ) ) return false;
                return true;
            }

            return this.optional( element ) || validateCPF( value );
        }, 'Insira um CPF válido!');

        jQuery.validator.addMethod('validatePhone', function (value, element) {
            value = value.replace("(","");
            value = value.replace(")", "");
            value = value.replace("-", "");
            value = value.replace(" ", "").trim();
            if (value == '0000000000') {
                return (this.optional(element) || false);
            } else if (value == '00000000000') {
                return (this.optional(element) || false);
            }
            if (["00", "01", "02", "03", , "04", , "05", , "06", , "07", , "08", "09", "10"].indexOf(value.substring(0, 2)) != -1) {
                return (this.optional(element) || false);
            }
            if (value.length < 10 || value.length > 11) {
                return (this.optional(element) || false);
            }
            // if (["6", "7", "8", "9"].indexOf(value.substring(2, 3)) == -1) {
            //     return (this.optional(element) || false);
            // }
            return (this.optional(element) || true);
        }, 'Informe um telefone válido!');

        $.validator.addMethod("diffNameAndLastName", function (value, element) {
            function verifyValue(val) {
                if($('#full_name').val() != '') {
                    if(val.toLowerCase().indexOf($('#name').val().toLowerCase()) != -1) return false;
                }

                if($('#last_name').val() != '') {
                    if(val.toLowerCase().indexOf($('#lastname').val().toLowerCase()) != -1) return false;
                }

                return true;
            }

            return this.optional(element) || verifyValue(value);
        }, "Não pode ter nome ou sobrenome");

        $.validator.addMethod("atLeastOneLetter", function (value, element) {
            return this.optional(element) || /[A-Za-z]+/.test(value);
        }, "Pelo menos uma letra");

        $.validator.addMethod("atLeastOneLowercatter", function (value, element) {
            return this.optional(element) || /[a-z]+/.test(value);
        }, "Pelo menos uma letra minúscula");

        /**
         * Custom validator for contains at least one upper-case letter.
         */
        $.validator.addMethod("atLeastOneUppercaseLetter", function (value, element) {
            return this.optional(element) || /[A-Z]+/.test(value);
        }, "Pelo menos uma letra maiúscula");

        /**
         * Custom validator for contains at least one number.
         */
        $.validator.addMethod("atLeastOneNumber", function (value, element) {
            return this.optional(element) || /[0-9]+/.test(value);
        }, "Pelo menos um número");

        /**
         * Custom validator for contains at least one symbol.
         */
        $.validator.addMethod("atLeastOneSymbol", function (value, element) {
            return this.optional(element) || /[!@#$%^&*()]+/.test(value);
        }, "Pelo menos um símbolo");

        jQuery.validator.addMethod("greaterThanZero", function(value, element) {
            return this.optional(element) || (parseFloat(value) > 0);
        }, "Campo obrigatório");

        jQuery.extend(jQuery.validator.messages, {
            required: "Campo obrigatório",
            email: "E-mail inválido",
            equalTo: "Entre com o mesmo valor novamente.",
            maxlength: jQuery.validator.format("Insira não mais que {0} caráteres."),
            minlength: jQuery.validator.format("Insira pelo menos {0} caráteres."),
            max: jQuery.validator.format("Insira um valor menor ou igual a {0}."),
            min: jQuery.validator.format("Insira um valor maior ou igual a {0}."),
            accept: "Entre com um arquivo válido.",
        });
    }

    formRegisterMeeting() {
        const SELF = this;
        $(SELF.idRegisterMeeting).validate({
            rules: {
                'date': {
                    required: true,
                }
            },
            submitHandler: function (form) {
                form.submit();

                // let data = $(form).serializeArray();
                // console.log(data);
            }
        });
    }
}
