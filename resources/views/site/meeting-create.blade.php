{{--@extends('layouts.layout')--}}
{{--@section('content')--}}
{{--<section id="section-register-meeting" class="pb-5 pt-5">--}}
{{--<div class="container">--}}
{{--<div class="wrapper-content">--}}
{{--<div class='fieldset'>--}}
{{--<div class="legend">--}}
{{--<h2>Encontro</h2>--}}
{{--</div>--}}
{{--<form data-validate="parsley" id="form-register-meeting">--}}
{{--<div>--}}
{{--<label for='date' style="display: block;">* Data do Encontro</label>--}}
{{--<input type="date" placeholder="* Data do Encontro" name='date' id='date-meeting' value="{!! old('date') !!}" data-required="true">--}}
{{--</div>--}}
{{--<div>--}}
{{--<label for="description">Descriçã</label>--}}
{{--<input type="text" placeholder="Descrição do Encontro" name='description' id="description" data-required="true" data-error-message="Your E-mail must correspond">--}}
{{--</div>--}}
{{--<button type="button" id="btn-store-meeting" class="btn btn-form">--}}
{{--Criar Encontro--}}
{{--</button>--}}
{{--</form>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</section>--}}
{{--<a href="#" data-toggle="modal" data-target="#modal-no-success">aaaaa</a>--}}
{{--@include('site._.modal')--}}
{{--<script>--}}
{{--_init.push(function () {--}}
{{--validation.formRegisterMeeting();--}}
{{--});--}}
{{--</script>--}}
{{--@endsection--}}



@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content')
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
                            {{--<label for="description">Descriçã</label>--}}
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
    @include('site._.modal')
    <script>
        // console.log('Hi!');
        _init.push(function () {
            validation.formRegisterMeeting();
        });
    </script>
@stop

@section('css')
    {{--<link rel="stylesheet" href="/css/admin_custom.css">--}}
@stop

@section('js')
    {{--<script>--}}
    {{--// console.log('Hi!');--}}
    {{--_init.push(function () {--}}
    {{--validation.formRegisterMeeting();--}}
    {{--});--}}
    {{--</script>--}}
@stop
