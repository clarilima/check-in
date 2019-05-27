@extends('layouts.layout')
@section('content')
    {{--<section id="section-register-meeting" class="pb-5 pt-5">--}}
    {{--<div class="container">--}}
    {{--<div class="wrapper-content">--}}
    {{--<div class="py-1 py-sm-4 form-register">--}}
    {{--<form id="form-register-meeting">--}}
    {{--<div class="control">--}}
    {{--<div class="form-group">--}}
    {{--<input type="date" class="form-control" id="date" name="date" value="{!! old('date') !!}" placeholder="">--}}
    {{--<label for="date" class="label-text">* Data do Encontro</label>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="control">--}}
    {{--<div class="form-group">--}}
    {{--<input type="text" class="form-control" id="description" name="description" value="{!! old('description') !!}">--}}
    {{--<label for="description" class="label-text">Descrição</label>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="w-100 text-center">--}}
    {{--<button type="button" id="btn-store-meeting" class="btn btn-form">--}}
    {{--Criar Encontro--}}
    {{--</button>--}}
    {{--</div>--}}
    {{--</form>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</section>--}}
    <section id="section-register-meeting" class="pb-5 pt-5">
        <div class="container">
            <div class="wrapper-content">
                <div class='fieldset'>
                    <div class="legend">
                        <h2>Encontro</h2>
                    </div>
                    <form data-validate="parsley" id="form-register-meeting">
                        <div>
                            <label for='date' style="display: block;">* Data do Encontro</label>
                            <input type="date" placeholder="* Data do Encontro" name='date' id='date-meeting' value="{!! old('date') !!}" data-required="true">
                        </div>
                        <div>
                            <label for="description">Confirm your E-mail</label>
                            <input type="text" placeholder="Descrição do Encontro" name='description' id="description" data-required="true" data-error-message="Your E-mail must correspond">
                        </div>
                        <button type="button" id="btn-store-meeting" class="btn btn-form">
                            Criar Encontro
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <a href="#" data-toggle="modal" data-target="#modal-loading2">aaaaa</a>
    @include('site._.modal')
    <script>
        _init.push(function () {
            function placeholderIsSupported() {
                test = document.createElement('input');
                return ('placeholder' in test);
            }

            $(document).ready(function(){
                placeholderSupport = placeholderIsSupported() ? 'placeholder' : 'no-placeholder';
                $('html').addClass(placeholderSupport);
                // const picker = datepicker('#date-meeting', {
                //     customMonths: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre']
                // })

                // function iniDatePicker() {
                //     return picker;
                // }
                // $("").datepicker({ dateFormat:'dd-mm-yy'});
            });

            validation.formRegisterMeeting();
        });
    </script>
@endsection

