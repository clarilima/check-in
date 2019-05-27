{{--@extends('layouts.layout')--}}
{{--@section('content')--}}
{{--<div class="container">--}}
{{--<h2 class="py-4">--}}
{{--Encontros--}}
{{--</h2>--}}
{{--<div class="meetings">--}}
{{--@foreach($meetings as $meeting)--}}
{{--<div class="alert alert-primary" role="alert">--}}
{{--<a href="">--}}
{{--{{ $meeting->day }}--}}
{{--</a>--}}
{{--@if($meeting->description)--}}
{{--<p>--}}
{{--{{ $meeting->description }}--}}
{{--</p>--}}
{{--@endif--}}
{{--</div>--}}
{{--@endforeach--}}
{{--</div>--}}
{{--</div>--}}
{{--@endsection--}}
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>ENCONTROS</h1>
@stop

@section('content')
    {{--<div class="container">--}}
        {{--<div class="meetings">--}}
            {{--@foreach($meetings as $meeting)--}}
                {{--<div class="alert alert-success" role="alert">--}}
                    {{--<a href="">--}}
                        {{--{{ $meeting->day }}--}}
                    {{--</a>--}}
                    {{--@if($meeting->description)--}}
                        {{--<p>--}}
                            {{--{{ $meeting->description }}--}}
                        {{--</p>--}}
                    {{--@endif--}}
                {{--</div>--}}
            {{--@endforeach--}}
        {{--</div>--}}
    {{--</div>--}}
    <table id="table_id" class="display">
        <thead>
        <tr>
            <th>Column 1</th>
            <th>Column 2</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>Row 1 Data 1</td>
            <td>Row 1 Data 2</td>
        </tr>
        <tr>
            <td>Row 2 Data 1</td>
            <td>Row 2 Data 2</td>
        </tr>
        </tbody>
    </table>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        // console.log('Hi!');
        $(document).ready( function () {
            $('#table_id').DataTable();
        } );
    </script>
@stop
