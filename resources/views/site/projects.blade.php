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
    <div class="panel" id="table-check">
        <div class="panel-body">
            <div class="table-primary">
                <table class="table table-striped table-bordered" id="datatables" style="width: 100%">
                    <thead>
                    <tr>
                        <th>Encontros</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

@section('css')
    {{--<link rel="stylesheet" href="/css/admin_custom.css">--}}
@stop

@section('js')
    <script>
        // console.log('Hi!');
        $(document).ready( function () {
            $('#datatables').DataTable({
                processing: true,
                serverSide: true,
                ordering: true,
                ajax: '/meetings',
                columns: [
                    {data: 'day', day: 'day', render: function($data, $, $row){
                            return '<a href="'+$row.editUrl+'">'+$row.day+'</a>';
                        }},
                    // {data: 'day'},
                    // {data: 'slug'},
                    // {render: renderBtnBins},
                    // {render: renderBtnEdit},
                    // {render: renderBtnDelete}
                ],
            });
        } );
    </script>
@stop
